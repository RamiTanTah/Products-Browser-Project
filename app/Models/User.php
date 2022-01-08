<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

// ### use JWT for authintcation ###
use Tymon\JWTAuth\Contracts\JWTSubject;
// ### use it for softDeletes ###
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Comment;
use App\Models\Product;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    // use SoftDelete;

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


    protected $hidden = [
        'password', 'remember_token',
    ];

    // /**
    //  * The attributes that should be cast to native types.
    //  *
    //  * @var array
    //  */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];

    public $timestamp = true;

    public function product()
    {
        return $this->hasMany(Product::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    

    // ### override this functions for Authintcation
    // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    // 'name',
    // 'email',
    // 'phone',
    // 'address',
    // 'facebook',
    // 'birthdate',
    // 'password',

    public const VALIDATION_RULES = [
      'name'  => [
        'required'  ,
        'string'    ,
        'max:50'   ,
        'min:3'     ,
        'unique:users',
],
'email' => [
        'required'  ,
        'string'    ,
        'email'     ,
        'max:255'   ,
        'unique:users',
        ],
        'password' => [
          'required'  ,
          'string'    ,
          'min:8'     ,
        ],
        'phone' => [
          'required'  ,
          'string'    ,
          'max:20'   ,
          'unique:users',
        ],
        'address' => [
          'string'    ,
          'max:255'   ,
        ],
        'birthdate'     => [
                'required'    ,
                'date'        ,
        ],
        'facebook'     => [
          'string'        ,
          'unique:users',
        ],
            ];
}
