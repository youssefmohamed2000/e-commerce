<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255|string',
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'sometimes|exists:subcategories,id',
            'short_description' => 'required|string',
            'description' => 'required|string',
            'regular_price' => 'required|numeric',
            'sale_price' => 'sometimes',
            'SKU' => 'required',
            'stock_status' => 'required',
            'featured' => 'sometimes',
            'quantity' => 'required|numeric',
            'image' => 'required|image|mimes:png,jpg|max:1024',
            'images' => 'sometimes',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
    public function messages()
    {
        return [
            'category_id.*' => 'The category field is required ',
        ];
    }
}
