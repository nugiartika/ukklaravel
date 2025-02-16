@extends('layout.app')

@section('content')
<div class="container">
    <h2>Add New Purchase</h2>

    <form action="{{ route('admin.purchases.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="supplier_id" class="form-label">Supplier</label>
            <select name="supplier_id" id="supplier_id" class="form-control" required>
                <option value="">Select Supplier</option>
                @foreach($suppliers as $supplier)
                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="purchase_date" class="form-label">Purchase Date</label>
            <input type="date" name="purchase_date" id="purchase_date" class="form-control" required>
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
                <tr>
                    <td>
                        <select name="products[0][product_id]" class="form-control product-select" required>
                            <option value="">Select Product</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}" data-price="{{ $product->price }}">{{ $product->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input type="number" name="products[0][amount]" class="form-control amount-input" min="1" required>
                    </td>
                    <td>
                        <input type="text" name="products[0][sub_total]" class="form-control sub-total" readonly>
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger remove-row">X</button>
                    </td>
                </tr>
            </tbody>
        </table>

        <button type="button" class="btn btn-primary" id="addRow">Add Product</button>
        <button type="submit" class="btn btn-success">Save Purchase</button>
    </form>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        let index = 1;

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
