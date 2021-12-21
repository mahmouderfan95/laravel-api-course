<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\User;

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

Route::get('get/users',function(){
   $users = User::select(['id','name','email'])->get();
   if($users->count() > 0){
       return response()->json([
          'data' => $users,
          'message' => 'success message',
          'status' => true,
       ]);
   }
   return response()->json([
        'message' => 'faild message',
       'status' => false
   ]);
});
// http methods
Route::post('create/post','postController@createPost');
Route::put('edit/post','postController@updatePost');
Route::delete('delete/post','postController@deletePost');
// end http methods
// register and login api
Route::post('user/register','userController@register');
// login api
Route::post('user/login','userController@login');
// end login and register api
Route::group(['middleware' => 'auth:api'],function(){
    Route::get('categories','categoryController@getCategories');
    Route::get('getProducts','categoryController@getProducts');
});
