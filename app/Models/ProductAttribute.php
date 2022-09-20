<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug'];

    public function attributeValues()
    {
        return $this->hasMany(AttributeValue::class, 'product_attribute_id');
    }
}
