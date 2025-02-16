<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatepurchaseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'supplier_id' => 'required|exists:suppliers,id',
            'purchase_date' => 'required|date',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.amount' => 'required|integer|min:1',
            'products.*.sub_total' => 'required|numeric|min:0',
        ];
    }
    public function messages()
    {
        return [
            'supplier_id.required' => 'Supplier is required',
            'supplier_id.exists' => 'Supplier not found',
            'purchase_date.required' => 'Purchase date is required',
            'purchase_date.date' => 'Purchase date is invalid',
            'products.*.product_id.required' => 'Product is required',
            'products.*.product_id.exists' => 'Product not found',
            'products.*.amount.required' => 'Amount is required',
            'products.*.amount.integer' => 'Amount must be an integer',
            'products.*.amount.min' => 'Amount must be greater than 0',
            'products.*.sub_total.required' => 'Sub total is required',
            'products.*.sub_total.numeric' => 'Sub total must be a number',
            'products.*.sub_total.min' => 'Sub total must be greater than 0',
        ];
    }
}
