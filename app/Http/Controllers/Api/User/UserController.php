<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Http\Traits\HandleResponse;

class UserController extends Controller
{
  use HandleResponse;
  
  public function register(UserRequest $request)
  {
      $newUser = new User;

      $newUser ->Fill($request->all());
      $newUser->save(); 

      return $this -> returnSuccessMessage("Registration Success" , "S000"); 
  }
}
