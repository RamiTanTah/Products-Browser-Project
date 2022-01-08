<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Comment;
use App\Models\Product;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDelete;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'name',
      'email',
      'phone',
      'address',
      'facebook',
      'birthdate',
      'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public $timestamp = true;

    public function product(){
      return $this->hasMany(Product::class);
    }

    public function comments(){
      return $this->hasMany(Comment::class);
    }

}
