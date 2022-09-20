<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
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
        if (request()->has('sub_id')) {
            return [
                'name' => 'required|max:255|unique:subcategories,name,' . request()->sub_id,
                'parent_category_id' => 'required|exists:categories,id'
            ];
        } else {
            return [
                'name' => 'required|max:255|unique:categories,name,' . request()->id,
            ];
        }
    }
}
