<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Http\Request;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    /**
    * Create a new AuthController instance.
    *
    * @return void
    */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register','logout']]);
    }

    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|between:2,100',
            'email' => 'required|email|unique:users|max:50',
            'password' => 'required|string|min:6',
            'phone' => 'string|min:6',
            'address' => 'string',
            'facebook' => 'string',
            'birthdate' => 'date',
        ]);

        $user = User::create(array_merge(
            $validator->validated(),
            ['password' => bcrypt($request->password)]
        ));

        return response()->json([
            'message' => 'Successfully registered',
            'user' => $user
        ], 201);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if (! $token = auth()->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->createNewToken($token);
    }

    
    // public function profile()
    // {
    //     return response()->json(auth()->user());
    // }

    
    public function logout(Request $request)
    {
        $token = $request -> header('auth-token');
        

        if ($token) {
            try {
                JWTAuth::setToken($token)->invalidate(); //logout
            } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
              return response()->json([
                'msg' => 'some thing went wrongs'
            ],401);
            }
            return response()->json([
              'msg' => 'Logged out successfully'
          ],201);
        } else {
          return response()->json([
            'msg' => 'some thing went wrongs'
        ],401);
        }




        // auth()->logout();

        // return response()->json(['message' => 'Successfully logged out']);
    }

    
    // public function refresh()
    // {
    //     return $this->createNewToken(auth()->refresh());
    // }

    
    protected function createNewToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
