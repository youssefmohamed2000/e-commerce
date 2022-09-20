<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'phone2' => 'required|numeric',
            'address' => 'required',
            'map' => 'required',
            'twitter' => 'required',
            'facebook' => 'required',
            'pinterest' => 'required',
            'instagram' => 'required',
            'youtube' => 'required'
        ];
    }
}
