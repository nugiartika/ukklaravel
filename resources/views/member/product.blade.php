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
                        <h3>Produk</h3>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Produk</li>
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
                                                <th>NAMA</th>
                                                <th>DETAIL PRODUK</th>
                                                <th>BERAT</th>
                                                <th>HARGA</th>
                                                <th>KATEGORI</th>
                                                <th>PHOTO</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($products as $p)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $p->name }}</td>
                                                    <td>{{ $p->product_detail }}</td>
                                                    <td>{{ $p->weight }}</td>
                                                    <td>{{ $p->price }}</td>
                                                    <td>{{ $p->category->name }}</td>
                                                    <td>
                                                        @empty($p->photo)
                                                            <img src="{{ url('image/nophoto.jpg') }}" alt="project-image"
                                                                class="rounded"
                                                                style="width: 100%; max-width: 100px; height: auto;">
                                                        @else
                                                            <img src="{{ asset('storage/' . $p->photo) }}" alt="project-image"
                                                                class="rounded"
                                                                style="width: 100%; max-width: 100px; height: auto;">
                                                        @endempty
                                                    </td>
                                                </tr>
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
