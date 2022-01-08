<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Category;
use App\Models\User;
use App\Models\Comment;
use App\Models\DiscountOffer;

class Product extends Model
{
    use SoftDeletes;

  protected $fillable = [
    'name_ar',
    'name_en',
    'description_ar',
    'description_en',
    'quantity',
    'image',
    'price',
    'price_after_discount',
    'production_date',
    'expired_date',
    'category_id',
];

  protected $hidden = [
    "created_at",
    "updated_at",
  ];


public $timestamp = true;


  public function category(){
    return $this->belongsTo(Category::class);
  }

  public function user(){
    return $this->belongsTo(User::class);
  }

  public function comments(){
    return $this->hasMany(Comment::class);
  }

  public function discountOffers(){
    return $this->hasMany(DiscountOffer::class);
  }

  public const VALIDATION_RULES = [

    'name_ar'  => [
      'required'  ,
      'string'    ,
      'max:50'   ,
      'min:3'
    ],
    'name_en'  => [
      'required'  ,
      'string'    ,
      'max:50'   ,
      'min:3'
    ],
    'description_ar' => [
      'string'  ,
      'max:500' ,
      'nullable' 
    ],
    'description_en' => [
      'string'  ,
      'max:500' ,
      'nullable' 
    ],
    'quantity' => [
      'required'  ,
      'integer'   ,
      'min:1'
    ],
    'price' => [
      'required'  ,
      'integer'   ,
      'min:1'
    ],
    'production_date' => [
      'date',
      'before_or_equal:expired_date',
      'nullable' ,
    ],
    'expired_date' => [
      'date',
      'after_or_equal:production_date',
      'nullable' ,
    ], 
  ];
}


