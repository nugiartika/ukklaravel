<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorepurchaseRequest extends FormRequest
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
            'products.*.sub_total' => 'required|integer|min:0',
        ];
    }
}
