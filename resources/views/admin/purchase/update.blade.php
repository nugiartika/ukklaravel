@extends('layout.app')

@section('content')
<div class="container">
    <h2>Edit Purchase</h2>

    <form action="{{ route('admin.purchases.update', $purchase->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="supplier_id" class="form-label">Supplier</label>
            <select name="supplier_id" id="supplier_id" class="form-control" required>
                <option value="">Select Supplier</option>
                @foreach($suppliers as $supplier)
                    <option value="{{ $supplier->id }}" {{ $supplier->id == $purchase->supplier_id ? 'selected' : '' }}>
                        {{ $supplier->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="purchase_date" class="form-label">Purchase Date</label>
            <input type="date" name="purchase_date" id="purchase_date" class="form-control" value="{{ $purchase->purchase_date }}" required>
        </div>

        <h4>Purchase Details</h4>
        <table class="table" id="purchaseTable">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Amount</th>
                    <th>Subtotal</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($purchase->purchase_detail as $index => $detail)
                <tr>
                    <td>
                        <select name="products[{{ $index }}][product_id]" class="form-control product-select" required>
                            <option value="">Select Product</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}" data-price="{{ $product->price }}" {{ $product->id == $detail->product_id ? 'selected' : '' }}>
                                    {{ $product->name }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input type="number" name="products[{{ $index }}][amount]" class="form-control amount-input" min="1" value="{{ $detail->amount }}" required>
                    </td>
                    <td>
                        <input type="text" name="products[{{ $index }}][sub_total]" class="form-control sub-total" value="{{ $detail->sub_total }}" readonly>
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger remove-row">X</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <button type="button" class="btn btn-primary" id="addRow">Add Product</button>
        <button type="submit" class="btn btn-success">Update Purchase</button>
    </form>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        let index = {{ count($purchase->purchase_detail) }};

        document.getElementById("addRow").addEventListener("click", function () {
            let newRow = `
                <tr>
                    <td>
                        <select name="products[${index}][product_id]" class="form-control product-select" required>
                            <option value="">Select Product</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}" data-price="{{ $product->price }}">{{ $product->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input type="number" name="products[${index}][amount]" class="form-control amount-input" min="1" required>
                    </td>
                    <td>
                        <input type="text" name="products[${index}][sub_total]" class="form-control sub-total" readonly>
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger remove-row">X</button>
                    </td>
                </tr>
            `;
            document.querySelector("#purchaseTable tbody").insertAdjacentHTML("beforeend", newRow);
            index++;
        });

        document.addEventListener("change", function (e) {
            if (e.target.classList.contains("product-select") || e.target.classList.contains("amount-input")) {
                let row = e.target.closest("tr");
                let price = row.querySelector(".product-select").selectedOptions[0].dataset.price || 0;
                let amount = row.querySelector(".amount-input").value || 0;
                row.querySelector(".sub-total").value = price * amount;
            }
        });

        document.addEventListener("click", function (e) {
            if (e.target.classList.contains("remove-row")) {
                e.target.closest("tr").remove();
            }
        });
    });
</script>
@endsection
