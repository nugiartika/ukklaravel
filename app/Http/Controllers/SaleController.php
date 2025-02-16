<?php

namespace App\Http\Controllers;

use App\Models\sale;
use App\Http\Requests\StoresaleRequest;
use App\Http\Requests\UpdatesaleRequest;
use App\Models\Product;
use App\Models\SaleDetail;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request; // Ini yang benar!
use Illuminate\Support\Str;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sales = Sale::with('sale_detail.product')->get();
        $products = Product::all();
        $users = User::where('role','Member')->get();

        return view('cashier.sale', compact('sales', 'products','users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sales = Sale::with('sale_detail.product')->get();
        $products = Product::all();
        $users = User::where('role','Member')->get();
        return view('cashier.create', compact('sales', 'products','users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'products' => 'required|array',
            'products.*.id_barang' => 'required|exists:products,id',
            'products.*.jumlah_jual' => 'required|integer|min:1',
        ]);

        do {
            $nomorResi = 'HT-' . now()->format('Ymd') . '-' . strtoupper(Str::random(5));
        } while (Sale::where('no_resi', $nomorResi)->exists());


        // Buat transaksi penjualan baru
        $sale = Sale::create([
            'user_id' => $request->user_id,
            'waktu' => now(),
            'total' => 0,
            'batas_waktu' => now()->addDays(3), // Tambahkan default 3 hari
            'no_resi' => $nomorResi,
        ]);

        $total = 0;

        foreach ($request->products as $product) {
            $barang = Product::findOrFail($product['id_barang']);

            // Pastikan stok cukup sebelum melakukan transaksi
            if ($barang->stock < $product['jumlah_jual']) {
                return back()->with('error', "Stok barang '{$barang->name}' tidak mencukupi!");
            }

            $subTotal = $product['jumlah_jual'] * $barang->price;

            // Simpan detail penjualan
            $saleDetail = new SaleDetail();
            $saleDetail->sale_id = $sale->id;
            $saleDetail->product_id = $barang->id;
            $saleDetail->jumlah_jual = $product['jumlah_jual'];
            $saleDetail->sub_total = $subTotal;
            // $saleDetail->uang_dibayar = $product['uang_dibayar'];
            $saleDetail->save(); // Simpan ke database

            // Kurangi stok barang
            $barang->stock -= $product['jumlah_jual'];
            $barang->save();

            // Tambahkan total transaksi
            $total += $subTotal;
        }

        // Update total harga di transaksi penjualan
        $sale->total = $total;
        $sale->save();

        return redirect()->route('kasir.index')->with('success', 'Penjualan berhasil!');
        }


    /**
     * Display the specified resource.
     */
    public function show(sale $sale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatesaleRequest $request, sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(sale $sale)
    {
        //
    }
}
