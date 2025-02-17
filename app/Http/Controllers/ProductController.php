<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\purchase;
use App\Models\purchase_detail;
use App\Models\Supplier;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        $products = Product::all();
        $suppliers = Supplier::all();

        return view('admin.product.index', compact('categories', 'products','suppliers'));
    }

    public function dashboard()
    {
        $products = Product::count();
        $suppliers = Supplier::count();
        $categories = Category::count();
        $purchase = purchase::sum('total');
        return view('admin.admin', compact('products','suppliers','categories','purchase'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $products = Product::all();
        $suppliers = Supplier::all();
        return view('admin.product.create', compact('categories', 'products','suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {

        $photo = $request->file('photo');
        $path_gambar = null;
        if ($photo) {
            $path_gambar = Storage::disk('public')->put('product', $photo);
        }
        Product::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'weight' =>$request->weight,
            'product_detail' => $request->product_detail,
            'price' => $request->price,
            'harga_beli' => $request->harga_beli,
            'photo' => $path_gambar,
            'stock' => 0,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('admin.product.index')->with('success', 'Produk berhasil di tambahkan');

    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $categories = Category::all();
        $product = Product::find($id);
        $suppliers = Supplier::all();
        return view('admin.product.update', compact('categories', 'product','suppliers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request,  $id)
    {
        $product = Product::findOrFail($id);

        $photo = $request->file('photo');
        $path_gambar = $product->photo; // Simpan path gambar sebelumnya jika tidak ada gambar baru

        if ($photo) {
            $path_gambar = Storage::disk('public')->put('product', $photo);
        }

        $product->update([
            'name' => $request->name,
            'product_detail' => $request->product_detail,
            'weight' => $request->weight,
            'harga_beli' => $request->harga_beli,
            'price' => $request->price,
            'photo' => $path_gambar,
            'category_id' => $request->category_id,
            // 'supplier_id' => $request->supplier_id,
            // 'stock' => $product->stock,
        ]);



                // dd($request->all());
        return redirect()->route('admin.product.index')->with('success', 'produk berhasil di ubah');;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try {
            if ($product->photo) {
                Storage::disk('public')->delete($product->photo);
            }
            $product->delete();
            return redirect()->route('admin.product.index')->with('success', 'produk berhasi di hapus');
        } catch (\Exception $e) {
            return redirect()->route('admin.product.index')->with('error', 'gagal menghapus');
        }
    }
}
