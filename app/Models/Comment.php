<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Product;

class Comment extends Model
{
  protected $fillable = [
    'content',
    ];

    public $timestamp = true;

    
  public function product(){
    return $this->belongsTo(Product::class);
  }

  public function user(){
    return $this->belongsTo(User::class);
  }
}
