@extends('layout.app')
@section('link')
{{-- <link rel="stylesheet" href="{{ public_path('css/pdf-style.css') }}"> --}}
<style>
    @media print {
        body {
            visibility: hidden;
        }
        table {
            visibility: visible;
            position: absolute;
            top: 0;
            left: 0;
        }
    }
</style>

<style>
    body {
        font-family: Arial, sans-serif;
    }
    table {
        width: 100%;
        border-collapse: collapse;
    }
    th, td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }
    th {
        background-color: #f2f2f2;
    }
</style>
@endsection
@section('content')



<div class="container">
    <h2 class="mb-4">Laporan Penjualan</h2>

    <!-- Filter Tanggal -->
    {{-- <form method="GET" action="{{ route('pimpinan.laporan') }}" class="mb-4">
        <div class="row">
            <div class="col-md-4">
                <label for="start_date" class="form-label">Dari Tanggal:</label>
                <input type="date" name="start_date" id="start_date" class="form-control" value="{{ request('start_date') }}">
            </div>
            <div class="col-md-4">
                <label for="end_date" class="form-label">Sampai Tanggal:</label>
                <input type="date" name="end_date" id="end_date" class="form-control" value="{{ request('end_date') }}">
            </div>
            <div class="col-md-4 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100">Filter</button>
            </div>
        </div>
    </form> --}}
    <a href="{{ route('laporan.pdf') }}" class="btn btn-danger mb-3">Cetak PDF</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No Resi</th>
                <th>Waktu</th>
                <th>Member</th>
                <th>Total</th>
                <th>Uang Dibayar</th>
                <th>Kembalian</th>
                <th>Detail</th>
            </tr>
        </thead>
        <tbody>
            @forelse($sales as $sale)
            <tr>
                <td>{{ $sale->no_resi }}</td>
                <td>{{ $sale->waktu }}</td>
                <td>{{ $sale->user->name ?? 'Non Member' }}</td>
                <td>Rp {{ number_format($sale->total, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($sale->uang_dibayar, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($sale->kembalian, 0, ',', '.') }}</td>
                <td>
                    <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#detailModal{{ $sale->id }}">
                        Detail
                    </button>
                </td>
            </tr>

            <!-- Modal Detail Transaksi -->
            <div class="modal fade" id="detailModal{{ $sale->id }}" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Detail Transaksi {{ $sale->no_resi }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <ul>
                                @foreach($sale->sale_detail as $detail)
                                <li>
                                    {{ $detail->product->name }} - {{ $detail->jumlah_jual }} x Rp {{ number_format($detail->product->price, 0, ',', '.') }} =
                                    <strong>Rp {{ number_format($detail->sub_total, 0, ',', '.') }}</strong>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            @empty
            <tr>
                <td colspan="7" class="text-center">Tidak ada transaksi</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
