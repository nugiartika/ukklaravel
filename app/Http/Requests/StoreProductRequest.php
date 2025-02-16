<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'name' => 'required|unique:products,name',
            'price' => 'required|min:1',
            'weight' => 'required|min:1',
            'product_detail' => 'required',
            'photo' => 'required|image|mimes:jpg,jpeg,png,gif',
            'category_id' => 'required|exists:categories,id',
            // 'supplier_id' => 'required|exists:suppliers,id',
            // 'stock' => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Product name is required',
            'name.unique' => 'Product name is already exist',
            'price.required' => 'Product price is required',
            'price.numeric' => 'Product price must be a number',
            'price.min' => 'Product price must be at least 1000',
            'weight.required' => 'Product weight is required',
            'weight.numeric' => 'Product weight must be a number',
            'weight.min' => 'Product weight must be at least 1',
            'product_detail.required' => 'Product detail is required',
            'photo.required' => 'Product photo is required',
            'photo.mimes' => 'Product photo must be a image file',
            'category_id.required' => 'Product category is required',
            'category_id.exists' => 'Product category is not found',
            // 'supplier_id.required' => 'supplier is required',
            // 'supplier_id.exists' => 'supplier is not found',
            // 'stock.required' => 'Product stock is required',
            // 'stock.integer' => 'Product stock must be an integer',
        ];
    }
}
