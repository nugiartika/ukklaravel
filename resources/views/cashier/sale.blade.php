@extends('layout.app')

@section('content')
<div id="main">
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Product</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Product</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>


        <!-- Bordered table start -->
        <section class="section">
            <div class="row" id="table-bordered">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-content">
                                <div class="card-body">
                                    {{-- <a href="{{ route('admin.product.create') }}" type="button"
                                        class="btn btn-primary waves-effect waves-light mb-3">tambah</a> --}}
                                </div>

                            </div>
                            <!-- table bordered -->
                            <div class="table-responsive">
                                <table class="table table-bordered mb-0">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>MEMBER</th>
                                            <th>WAKTU</th>
                                            <th>PRODUCT</th>
                                            <th>NO RESI</th>
                                            <th>HARGA</th>
                                            <th>TOTAL</th>
                                            <th>UANG DIBAYAR</th>
                                            <th>KEMBALIAN</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($sales as $sale)
                                        @foreach ($sale->sale_detail as $p)
                                            <tr>
                                                <td>{{ $loop->parent->iteration }}</td>
                                                <td>{{ $sale->user->name }}</td>
                                                <td>{{ $sale->created_at->format('d-m-Y H:i') }}</td>
                                                <td>{{ $p->product->name }}</td>
                                                <td>{{ $sale->no_resi }}</td>
                                                <td>Rp {{ number_format($p->product->price, 0, ',', '.') }}</td>
                                                <td>Rp {{ number_format($sale->total, 0, ',', '.') }}</td>
                                                <td>Rp {{ number_format($sale->paid, 0, ',', '.') }}</td>
                                                <td>Rp {{ number_format($sale->change, 0, ',', '.') }}</td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
