<?php

namespace App\Http\Requests;

use App\Models\Coupon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCouponRequest extends FormRequest
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
            'code'        => 'required|unique:coupons,code,' . request()->id,
            'type'        => 'required',
            'value'       => 'required|numeric',
            'cart_value'  => 'required|numeric',
            'expiry_date' => 'required' 
        ];
    }
}
