<?php

namespace App\Models;

use App\Models\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id' , 'order_id', 'mode', 'status'
    ];

    public function order()
    {
        return $this->hasOne(Order::class);
    }
}
