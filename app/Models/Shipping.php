<?php

namespace App\Models;

use App\Models\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Shipping extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id', 'first_name', 'last_name', 'mobile', 'email', 'line1',
        'line2', 'city', 'province', 'country', 'zipcode',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
