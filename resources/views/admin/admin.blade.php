@extends('layout.app')
@section('content')
<div class="row g-6">
   

    <!-- Statistics -->
    <div class="col-xl-12 col-md-12">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-between">
                <h5 class="card-title mb-0">Statistics</h5>
                <small class="text-muted">Updated 1 month ago</small>
            </div>
            <div class="card-body d-flex align-items-end">
                <div class="w-100">
                    <div class="row gy-3">
                        <div class="col-md-3 col-6">
                            <div class="d-flex align-items-center">
                                <div class="badge rounded bg-label-primary me-4 p-2"><i
                                        class="ti ti-chart-pie-2 ti-lg"></i></div>
                                <div class="card-info">
                                    <h5 class="mb-0">{{ $categories }}</h5>
                                    <small>Kategori</small>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="d-flex align-items-center">
                                <div class="badge rounded bg-label-info me-4 p-2"><i
                                        class="ti ti-users ti-lg"></i></div>
                                <div class="card-info">
                                    <h5 class="mb-0">{{ $suppliers }}</h5>
                                    <small>Supplier</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="d-flex align-items-center">
                                <div class="badge rounded bg-label-danger me-4 p-2"><i
                                        class="ti ti-shopping-cart ti-lg"></i></div>
                                <div class="card-info">
                                    <h5 class="mb-0">{{ $products }}</h5>
                                    <small>Produk</small>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="d-flex align-items-center">
                                <div class="badge rounded bg-label-success me-4 p-2"><i
                                        class="ti ti-currency-dollar ti-lg"></i></div>
                                <div class="card-info">
                                    <h5 class="mb-0"> Rp {{ number_format($purchase, 0, ',', '.') }} </h5>
                                    <small>pengeluaran</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ Statistics -->
    
</div>
@endsection
