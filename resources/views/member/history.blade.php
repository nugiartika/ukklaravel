@extends('layout.app')

@section('content')
<div id="main">
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6">
                    <h3>Riwayat Pesanan</h3>
                </div>
                <div class="col-12 col-md-6">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">Riwayat Pesanan</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Riwayat Pesanan Anda</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>No Resi</th>
                                            <th>Tanggal</th>
                                            {{-- <th>Status</th> --}}
                                            <th>Total</th>
                                            <th>Detail Pesanan</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($history as $index => $sale)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $sale->no_resi }}</td>
                                                <td>{{ $sale->created_at->format('d M Y H:i') }}</td>
                                                {{-- <td>
                                                    @if ($sale->status == 'Dipesan')
                                                        <span class="badge bg-warning">Dipesan</span>
                                                    @elseif ($sale->status == 'Dikirim')
                                                        <span class="badge bg-primary">Dikirim</span>
                                                    @elseif ($sale->status == 'Selesai')
                                                        <span class="badge bg-success">Selesai</span>
                                                    @else
                                                        <span class="badge bg-secondary">{{ $sale->status }}</span>
                                                    @endif
                                                </td> --}}
                                                <td>Rp {{ number_format($sale->total, 0, ',', '.') }}</td>
                                                <td>
                                                    <button class="btn btn-info btn-sm" data-bs-toggle="collapse" data-bs-target="#detail-{{ $sale->id }}">
                                                        Lihat Detail
                                                    </button>
                                                </td>
                                            </tr>

                                            <!-- Detail Pesanan -->
                                            <tr class="collapse" id="detail-{{ $sale->id }}">
                                                <td colspan="6">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>Produk</th>
                                                                <th>Jumlah</th>
                                                                <th>Harga Satuan</th>
                                                                <th>Subtotal</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($sale->sale_detail as $detail)
                                                                <tr>
                                                                    <td>{{ $detail->product->name }}</td>
                                                                    <td>{{ $detail->jumlah_jual }}</td>
                                                                    <td>Rp {{ number_format($detail->product->price, 0, ',', '.') }}</td>
                                                                    <td>Rp {{ number_format($detail->sub_total, 0, ',', '.') }}</td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        @endforeach

                                        @if ($history->isEmpty())
                                            <tr>
                                                <td colspan="6" class="text-center">Belum ada riwayat pesanan.</td>
                                            </tr>
                                        @endif
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
