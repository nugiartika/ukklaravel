<?php

namespace App\Http\Controllers;

use App\Models\purchase_detail;
use App\Http\Requests\Storepurchase_detailRequest;
use App\Http\Requests\Updatepurchase_detailRequest;

class PurchaseDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Storepurchase_detailRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(purchase_detail $purchase_detail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(purchase_detail $purchase_detail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Updatepurchase_detailRequest $request, purchase_detail $purchase_detail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(purchase_detail $purchase_detail)
    {
        //
    }
}
