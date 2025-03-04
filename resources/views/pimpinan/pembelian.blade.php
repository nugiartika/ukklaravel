@extends('layout.app')
@section('content')
<div class="container">
    <h2>Purchase List</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>nama supplier</th>
                <th>tanggal pembelian</th>
                <th>Total</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($purchases as $purchase)
                <tr>
                    <td>{{ $purchase->id }}</td>
                    <td>{{ $purchase->supplier->name }}</td>
                    {{-- <td>{{ $purchase->purchase_date }}</td> --}}
                    <td>{{ \Carbon\Carbon::parse($purchase->puechase_date)->format('d F Y') }}</td>

                    <td>Rp{{ number_format($purchase->total, 2) }}</td>
                    <td>
                        <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#detailModal{{ $purchase->id }}">
                            Lihat Detail
                        </button>
                    <!-- Modal untuk Detail Pembelian -->
                <div class="modal fade" id="detailModal{{ $purchase->id }}" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Purchase Details (ID: {{ $purchase->id }})</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>produk</th>
                                            <th>jumlah</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($purchase->purchase_detail as $detail)
                                            <tr>
                                                <td>{{ $detail->product->name }}</td>
                                                <td>{{ $detail->amount }}</td>
                                                <td>Rp{{ number_format($detail->sub_total, 2) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <a href="{{ route('admin.purchases.edit', $purchase->id) }}" class="btn-edit btn btn-label-warning waves-effect">Edit</a>
                </td>
                </tr>


            @endforeach
        </tbody>
    </table>
</div>
@endsection
