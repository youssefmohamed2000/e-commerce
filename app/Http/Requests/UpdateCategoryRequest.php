<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
                'name' => ['required', 'max:255', 'string', Rule::unique('subcategories', 'name')->ignore($this->slug, 'slug')],
                'parent_category_id' => 'required|exists:categories,id'
            ];
        } else {
            return [
                'name' => ['required', 'max:255', 'string', Rule::unique('categories', 'name')->ignore($this->slug, 'slug')],
            ];
        }
    }
}
