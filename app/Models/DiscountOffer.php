<?php

namespace App\Models;
use App\Models\Product;

use Illuminate\Database\Eloquent\Model;


class DiscountOffer extends Model
{
  protected $fillable = [
    'date',
    'ratio',
    'product_id'
    ];
    

    public $timestamp = true;

  
    public function product()
    {
      return $this->belongsTo(Product::class);
    }
}
