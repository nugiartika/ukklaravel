<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoresaleRequest extends FormRequest
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
            'products' => 'required|array|min:1',
            'products.*.id_barang' => 'required|exists:barang,id_barang',
            'products.*.jumlah_jual' => 'required|integer|min:1',

        ];
    }
    public function messages()
    {
        return [
            'products.required' => 'Produk harus dipilih.',
            'products.*.id_barang.required' => 'ID barang tidak boleh kosong.',
            'products.*.id_barang.exists' => 'Produk yang dipilih tidak valid.',
            'products.*.jumlah_jual.required' => 'Jumlah jual harus diisi.',
            'products.*.jumlah_jual.integer' => 'Jumlah jual harus berupa angka.',
            'products.*.jumlah_jual.min' => 'Minimal jumlah jual adalah 1.'
        ];
    }
}
