<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'vendor_id',
        'name',
        'description',
        'price',
        'stock',
        'is_active',
        'image',
        'category_id',
    ];

    public function vendor()
    {
        return $this->belongsTo(User::class, 'vendor_id');
    }
    public function category()
{
    return $this->belongsTo(Category::class);
}

}
