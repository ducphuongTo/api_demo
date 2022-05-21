<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = [
    	'product_name', 
        'product_thumbnail',
    	'product_image',
        'product_price',
        'category_id',
        'brand_id',
        'user_id',
    	'desc'
    ];
}
