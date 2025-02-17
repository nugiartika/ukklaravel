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
            'uang_dibayar' => 'required|integer|min:0', // Validasi uang dibayar
        ]);

        do {
            $nomorResi = 'HT-' . now()->format('Ymd') . '-' . strtoupper(Str::random(5));
        } while (Sale::where('no_resi', $nomorResi)->exists());

        $total = 0;

        // Buat transaksi penjualan baru
        $sale = Sale::create([
            'user_id' => $request->user_id,
            'waktu' => now(),
            'total' => 0, // Akan diperbarui nanti
            'batas_waktu' => now()->addDays(3),
            'no_resi' => $nomorResi,
            'uang_dibayar' => 0, // Akan diperbarui nanti
            'kembalian' => 0, // Akan diperbarui nanti
        ]);

        foreach ($request->products as $product) {
            $barang = Product::findOrFail($product['id_barang']);

            // Pastikan stok cukup sebelum melakukan transaksi
            if ($barang->stock < $product['jumlah_jual']) {
                return back()->with('error', "Stok barang '{$barang->name}' tidak mencukupi!");
            }

            $subTotal = $product['jumlah_jual'] * $barang->price;

            // Simpan detail penjualan
            SaleDetail::create([
                'sale_id' => $sale->id,
                'product_id' => $barang->id,
                'jumlah_jual' => $product['jumlah_jual'],
                'sub_total' => $subTotal,
            ]);

            // Kurangi stok barang
            $barang->stock -= $product['jumlah_jual'];
            $barang->save();

            // Tambahkan total transaksi
            $total += $subTotal;
        }

        // Hitung kembalian
        $uangDibayar = $request->uang_dibayar;
        $kembalian = max(0, $uangDibayar - $total); // Jika uang dibayar kurang dari total, kembalian 0

        // Update total harga, uang dibayar, dan kembalian
        $sale->update([
            'total' => $total,
            'uang_dibayar' => $uangDibayar,
            'kembalian' => $kembalian,
        ]);

        return redirect()->route('kasir.index')->with('success', 'Penjualan berhasil ditambahkan!');
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
