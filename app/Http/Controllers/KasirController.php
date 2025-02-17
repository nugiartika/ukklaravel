<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\purchase;
use App\Models\sale;
use App\Models\Supplier;
use Illuminate\Http\Request;

class KasirController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::count();
        $suppliers = Supplier::count();
        $categories = Category::count();
        $purchase = sale::sum('total');
        return view('cashier.index' , compact('products','suppliers','categories','purchase'));

    }

    public function product()
    {
        $products = Product::all();
        return view('cashier.product', compact('products'));
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
