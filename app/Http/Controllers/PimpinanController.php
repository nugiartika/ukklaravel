<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\sale;
use Illuminate\Http\Request;

class PimpinanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function product()
    {
        $products = Product::all();
        return view('pimpinan.product', compact('products'));
    }
    public function laporan(Request $request)
    {
        $query = sale::with(['user', 'sale_detail.product']);

        // Filter berdasarkan rentang tanggal jika ada
        if ($request->has(['start_date', 'end_date'])) {
            $query->whereBetween('waktu', [$request->start_date, $request->end_date]);
        }

        // Ambil data transaksi
        $sales = $query->orderBy('waktu', 'desc')->get();

         return view('pimpinan.laporan', compact('sales'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
