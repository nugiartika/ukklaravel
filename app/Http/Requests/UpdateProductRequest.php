<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'name' => 'required',
            'price' => 'required|numeric|min:1|gte:harga_beli',
            'harga_beli' => 'required|numeric|min:1|lte:price',
            'weight' => 'required|numeric|min:1',
            'product_detail' => 'required',
            'photo' => 'nullable|mimes:jpg,jpeg,png,gif',
            'category_id' => 'required|exists:categories,id',
            // 'stock' => 'required|integer',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Tên sản phẩm không được để trống',
            'price.required' => 'Giá sản phẩm không được để trống',
            'weight.required' => 'Trọng lượng sản phẩm không được để trống',
            'weight.min' => 'Trọng lượng sản phẩm phải lớn hơn 0',
            'product_detail.required' => 'Chi tiết sản phẩm không được để trống',
            'photo.mimes' => 'Ảnh sản phẩm phải là file ảnh',
            'category_id.required' => 'Danh mục sản phẩm không được để trống',
            'category_id.exists' => 'Danh mục sản phẩm không tồn tại',
            // 'stock.required' => 'Số lượng sản phẩm không được để trống',
            // 'stock.integer' => 'Số lượng sản phẩm phải là số nguyên',
        ];
    }
}
