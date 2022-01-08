<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Category extends Model
{

  protected $fillable = [
    'name_ar',
    'name_en',
    ];

    public $timestamp = true;

  
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
