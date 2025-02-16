<?php

namespace App\Http\Controllers;

use App\Models\purchase;
use App\Http\Requests\StorepurchaseRequest;
use App\Http\Requests\UpdatepurchaseRequest;
use App\Models\Product;
use App\Models\purchase_detail;
use App\Models\Supplier;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $purchases = purchase::with('supplier', 'purchase_detail.product')->get();
        $suppliers = Supplier::all();
        $products = Product::all();
        return view('admin..purchase.purchase', compact('purchases','suppliers','products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $suppliers = Supplier::all();
        $products = Product::all();
        return view('admin.purchase.create', compact('suppliers', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorepurchaseRequest $request)
    {
           // Simpan data pembelian
           $purchase = purchase::create([
            'supplier_id' => $request->supplier_id,
            'purchase_date' => now(),
            'total' => 0, // Akan dihitung ulang
        ]);

        $total = 0;

        // Simpan detail pembelian
         // Simpan detail pembelian dan update stok produk
        foreach ($request->products as $productData) {
            // Simpan detail pembelian
            purchase_detail::create([
                'purchase_id' => $purchase->id,
                'product_id' => $productData['product_id'],
                'amount' => $productData['amount'],
                'sub_total' => $productData['sub_total'],
            ]);

            // Cari produk berdasarkan ID
            $product = Product::find($productData['product_id']);

            if ($product) {
                // Update stok produk (stok lama + amount pembelian)
                $product->update([
                    'stock' => $product->stock + $productData['amount']
                ]);
            }
            $total += $productData['sub_total'];
        }

        // Update total pembelian
        $purchase->update(['total' => $total]);

        return redirect()->route('admin.purchases.index')->with('success', 'Purchase added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(purchase $purchase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $purchase = purchase::with('purchase_detail')->find($id);
        $suppliers = Supplier::all();
        $products = Product::all();

        return view('admin.purchase.update', compact('purchase', 'suppliers', 'products'));
    }

    /**
     * Menyimpan perubahan data pembelian.
     */
    public function update(UpdatepurchaseRequest $request, $id)
    {

        $purchase = purchase::findOrFail($id);

        $oldDetails = purchase_detail::where('purchase_id', $id)->get();

        // Perhitungan ulang stok produk sebelum update
        foreach ($oldDetails as $oldDetail) {
            $product = Product::find($oldDetail->product_id);
            if ($product) {
                $product->stock -= $oldDetail->amount; // Kembalikan stok lama
                $product->save();
            }
        }

        purchase_detail::where('purchase_id', $id)->delete();

        $purchase->update([
            'supplier_id' => $request->supplier_id,
            'purchase_date' => $request->purchase_date,
        ]);

        // Hapus detail lama
        // $purchase_detail = purchase_detail::where('purchase_id', $id);

        $total = 0;

        // Simpan detail baru
        foreach ($request->products as $productData) {
            purchase_detail::create([
                'purchase_id' => $purchase->id,
                'product_id' => $productData['product_id'],
                'amount' => $productData['amount'],
                'sub_total' => $productData['sub_total'],
            ]);

            $product = Product::find($productData['product_id']);
            if ($product) {
                $product->stock += $productData['amount']; // Tambah stok baru
                $product->save();
            }

            $total += $productData['sub_total'];
        }

        // Update total pembelian
        $purchase->update(['total' => $total]);

        return redirect()->route('admin.purchases.index')->with('success', 'Purchase updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(purchase $purchase)
    {
        //
    }
}
