<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_attribute_id', 'value', 'product_id',
    ];

    public function products()
    {
        return $this->belongsTo(Product::class , 'product_id');
    }
    public function productAttributes()
    {
        return $this->belongsTo(ProductAttribute::class , 'product_attribute_id');
    }
}
