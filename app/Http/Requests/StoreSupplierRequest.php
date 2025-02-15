<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSupplierRequest extends FormRequest
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
            'address' => 'required',
            'phone' => 'required|numeric|min:0'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Name is required',
            'name.unique' => 'Name is already exist',
            'address.required' => 'Address is required',
            'phone.required' => 'phone is required',
            'phone.numeric' => 'Phone must be a number',
        ];
    }
}
