@extends('layout.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Penjualan Kasir</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('kasir.store') }}" method="POST">
        @csrf

        <!-- Pilih Member -->
        <div class="mb-3">
            <label for="user_id" class="form-label">Pilih Member</label>
            <select name="user_id" id="user_id" class="form-control" required>
                <option value="">- Pilih Member -</option>
                @foreach($users as $member)
                    <option value="{{ $member->id }}">{{ $member->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Produk -->
        <div id="product-container">
            <div class="product-row mb-3">
                <label for="products[0][id_barang]" class="form-label">Pilih Produk</label>
                <select name="products[0][id_barang]" class="form-control product-select" required>
                    <option value="">- Pilih Produk -</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}" data-price="{{ $product->price }}">
                            {{ $product->name }} - Rp {{ number_format($product->price, 0, ',', '.') }}
                        </option>
                    @endforeach
                </select>

                <label class="form-label mt-2">Jumlah</label>
                <input type="number" name="products[0][jumlah_jual]" class="form-control jumlah-input" min="1" value="1" required>

                <label class="form-label mt-2">Subtotal</label>
                <input type="text" class="form-control subtotal" readonly value="0">

                <button type="button" class="btn btn-danger mt-3 remove-product">Hapus</button>
            </div>
        </div>

        <button type="button" id="add-product" class="btn btn-secondary mt-2">Tambah Produk</button>

        <!-- Total Harga -->
        <div class="mt-4">
            <h4>Total: Rp <span id="total-display">0</span></h4>
            <input type="hidden" name="total" id="total" value="0">
        </div>

        <!-- Uang Dibayar -->
        <div class="mt-3">
            <label for="uang_dibayar" class="form-label">Uang Dibayar</label>
            <input type="number" name="uang_dibayar" id="uang_dibayar" class="form-control @error('uang_dibayar') is-invalid @enderror" min="0" required>
            @error('uang_dibayar')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <!-- Kembalian -->

        <div class="mt-3">
            <h4>Kembalian: Rp <span id="kembalian-display">0</span></h4>
            <input type="hidden" name="kembalian" id="kembalian" value="0">
        </div>

        <button type="submit" class="btn btn-primary mt-4">Proses Penjualan</button>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let productIndex = 1;

    document.getElementById('add-product').addEventListener('click', function() {
        let container = document.getElementById('product-container');
        let newRow = document.createElement('div');
        newRow.classList.add('product-row', 'mb-3');
        newRow.innerHTML = `
            <label class="form-label">Pilih Produk</label>
            <select name="products[${productIndex}][id_barang]" class="form-control product-select">
                <option value="">- Pilih Produk -</option>
                @foreach($products as $product)
                    <option value="{{ $product->id }}" data-price="{{ $product->price }}">
                        {{ $product->name }} - Rp {{ number_format($product->price, 0, ',', '.') }}
                    </option>
                @endforeach
            </select>

            <label class="form-label mt-2">Jumlah</label>
            <input type="number" name="products[${productIndex}][jumlah_jual]" class="form-control jumlah-input" min="1" value="1">

            <label class="form-label mt-2">Subtotal</label>
            <input type="text" class="form-control subtotal" readonly value="0">

            <button type="button" class="btn btn-danger mt-3 remove-product">Hapus</button>
        `;
        container.appendChild(newRow);
        productIndex++;
    });


//     document.getElementById("sales-form").addEventListener("submit", function(event) {
//     let total = parseFloat(document.getElementById("total").value) || 0;
//     let uangDibayar = parseFloat(document.getElementById("uang_dibayar").value) || 0;

//     if (uangDibayar < total) {
//         alert("Uang yang dibayarkan tidak boleh kurang dari total harga!");
//         event.preventDefault(); // Mencegah form dikirim
//     }
// });
    document.getElementById('product-container').addEventListener('input', function(event) {
        if (event.target.classList.contains('jumlah-input') || event.target.classList.contains('product-select')) {
            updateTotals();
        }
    });

    document.getElementById('product-container').addEventListener('click', function(event) {
        if (event.target.classList.contains('remove-product')) {
            event.target.parentElement.remove();
            updateTotals();
        }
    });

    document.getElementById('uang_dibayar').addEventListener('input', function() {
        updateChange();
    });
    function updateChange() {
    let total = parseInt(document.getElementById('total').value) || 0;
    let uangDibayar = parseInt(document.getElementById('uang_dibayar').value) || 0;
    let kembalian = uangDibayar - total;

    document.getElementById('kembalian-display').textContent = new Intl.NumberFormat('id-ID').format(kembalian > 0 ? kembalian : 0);

    // Set nilai kembalian di input form
    document.getElementById('kembalian').value = kembalian > 0 ? kembalian : 0;
}


    function updateTotals() {
        let total = 0;
        document.querySelectorAll('.product-row').forEach(row => {
            let select = row.querySelector('.product-select');
            let jumlah = row.querySelector('.jumlah-input').value;
            let harga = select.options[select.selectedIndex]?.getAttribute('data-price') || 0;
            let subtotal = jumlah * harga;

            row.querySelector('.subtotal').value = subtotal;
            total += subtotal;
        });

        document.getElementById('total').value = total;
        document.getElementById('total-display').textContent = new Intl.NumberFormat('id-ID').format(total);
        updateChange();
    }

    function updateChange() {
        let total = parseInt(document.getElementById('total').value) || 0;
        let uangDibayar = parseInt(document.getElementById('uang_dibayar').value) || 0;
        let kembalian = uangDibayar - total;
        document.getElementById('kembalian-display').textContent = new Intl.NumberFormat('id-ID').format(kembalian > 0 ? kembalian : 0);
    }
});
document.getElementById("sales-form").addEventListener("submit", function(event) {
    let total = parseFloat(document.getElementById("total").value) || 0;
    let uangDibayar = parseFloat(document.getElementById("uang_dibayar").value) || 0;

    if (uangDibayar < total) {
        alert("Uang yang dibayarkan tidak boleh kurang dari total harga!");
        event.preventDefault(); // Mencegah form dikirim
    }
});
</script>
@endsection
