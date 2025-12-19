<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'product_id';
    protected $incrementing = 'true';
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = ['name', 'slug', 'description', 'price', 'mrp', 'stock', 'status', 'is_deleted'];
}
