@extends('layout.app')
@section('link')
<link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/core.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/theme-default.css') }}">
@endsection

@section('content')

    <div id="main">
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>

        <div class="card mb-6">
            <h5 class="card-header">Update Product</h5>
            <form action="{{ route('admin.product.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="card-body">
                @csrf
                @method('put')
                <div class="row g-6">

                    <div class="col-md-6">
                        <label for="name" class="form-label">Name Product</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $product->name) }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price', $product->price) }}">
                        @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="harga_beli" class="form-label">harga beli</label>
                        <input type="number" class="form-control @error('harga_beli') is-invalid @enderror" name="harga_beli" value="{{ old('harga_beli', $product->price) }}">
                        @error('harga_beli')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    {{-- <div class="col-md-6">
                        <label for="stock" class="form-label">Stock</label>
                        <input type="number" class="form-control @error('stock') is-invalid @enderror" name="stock" value="{{ old('stock', $product->stock) }}">
                        @error('stock')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div> --}}
                    <div class="col-md-6">
                        <label for="weight" class="form-label">Weight</label>
                            <input type="number" class="form-control @error('weight') is-invalid @enderror" name="weight" value="{{ old('weight', $product->weight) }}">
                            @error('weight')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="category" class="form-label">Category</label>
                        <select class="form-select select2 @error('category_id') is-invalid @enderror" id="category"
                            name="category_id" >
                            {{-- <option value="" {{ old('category_id') ? '' : 'selected' }}>- Select Category -</option> --}}
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ in_array($category->id, isset($is_edit) ? $product->categories->pluck('id')->toArray() : old('category_id', [])) ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    {{-- <div class="col-md-6 mb-3">
                        <label for="supplier" class="form-label">supplier</label>
                        <select class="form-select select2 @error('supplier_id') is-invalid @enderror" id="supplier"
                            name="supplier_id" >
                            <option value="" {{ old('supplier_id') ? '' : 'selected' }}>- Select supplier -</option>
                            @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->id }}"
                                    {{ in_array($supplier->id, isset($is_edit) ? $product->suppliers->pluck('id')->toArray() : old('supplier_id', [])) ? 'selected' : '' }}>
                                    {{ $supplier->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('supplier_id')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div> --}}
                    <div class="col-md-6">
                        <label for="photo" class="form-label">Product Photo</label>
                        @if(isset($product) && $product->photo)
                        <div>
                            <img src="{{ asset('storage/' . $product->photo) }}" alt="Product Image" class="img-thumbnail" style="max-width: 150px;">
                        </div>
                    @endif

                    <input type="file" class="form-control @error('photo') is-invalid @enderror" name="photo">

                    @error('photo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                    <div class="col-md-6">
                        <label for="product_detail" class="form-label">Product Details</label>
                        <textarea class="form-control @error('product_detail') is-invalid @enderror" name="product_detail">{{ old('product_detail', $product->product_detail) }}</textarea>
                        @error('product_detail')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="pt-6">
                    <button type="submit" class="btn btn-primary me-4">Submit</button>
                    <button type="reset" class="btn btn-label-secondary">Cancel</button>
                </div>
            </form>
        </div>
    </div>
@endsection
