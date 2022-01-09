<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::group(['middleware' => ['api']],function(){
  
// put your api route here 

Route::post('register', 'AuthController@register');
Route::post('login', 'AuthController@login');
Route::get('logout', 'AuthController@logout');

});



// ProductController Api's
Route::resource('products','ProductController');
Route::post('/products/update/{id}', 'ProductController@update');
Route::get('/products/searchByName/{name}', 'ProductController@searchByName');