<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->ignore(auth()->user()->id)],
            'mobile' => 'nullable|numeric',
            'line1' => 'nullable|string',
            'line2' => 'nullable|string',
            'country' => 'nullable|string',
            'province' => 'nullable|string',
            'city' => 'nullable|string',
            'zipcode' => 'nullable|numeric',
            'image' => 'nullable|image|mimes:png,jpg|max:1024',
        ];
    }
}
