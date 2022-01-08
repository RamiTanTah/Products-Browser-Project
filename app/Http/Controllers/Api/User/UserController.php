<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
  public function register(Request $request)
  {
      $newUser = new User;

      $newUser ->Fill($request->all());
      $newUser->save(); 
      
      // return response()->json(["msg" => "totototo"]);
      // $val=$this->validator($request->all())->validate();
      // event(new Registered($user = $this->create($request->all())));
      
      // return redirect()->back()->with('success','A new user account has been added successfully'); 
  }
}
// 'name',
// 'email',
// 'phone',
// 'address',
// 'facebook',
// 'birthdate',
// 'password',