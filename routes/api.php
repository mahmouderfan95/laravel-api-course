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
Route::post('user/register',function(Request $request){
   $userCreate = User::create([
       'name' => $request->name,
       'email' => $request->email,
       'password' => bcrypt($request->password)
   ]);
   $success['token'] = $userCreate->createToken('MyApp')->accessToken;
   return response()->json([
      'message' => 'user created',
      'status' => true,
      'token' => $success['token'],
   ]);
});
Route::post('create/post','postController@createPost');
Route::put('edit/post','postController@updatePost');
Route::delete('delete/post','postController@deletePost');
//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
