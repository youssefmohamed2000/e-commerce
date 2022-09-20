<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Slider extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'slug', 'subtitle', 'price', 'link', 'image', 'status'
    ];

    public function image(): Attribute
    {
        return new Attribute(
            get: fn ($value) => asset('assets/images/sliders/' . $value),
        );
    }
}
