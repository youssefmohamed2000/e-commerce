<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id', 'name', 'slug', 'short_description', 'description', 'regular_price',
        'sale_price', 'SKU', 'stock_status', 'featured', 'quantity', 'image', 'images', 'subcategory_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subCategory()
    {
        return $this->belongsTo(Subcategory::class, 'subcategory_id');
    }

    public function image(): Attribute
    {
        return new Attribute(
            get: fn($value) => asset('assets/images/products/' . $value),
        );
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function attributeValues()
    {
        return $this->hasMany(AttributeValue::class, 'product_id');
    }

    public function productAttributes()
    {
        return $this->hasMany(ProductAttribute::class, 'product_id');
    }
}
