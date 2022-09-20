<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'image', 'mobile', 'line1',
        'line2', 'city', 'province', 'country', 'zipcode'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

}
