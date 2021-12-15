<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class userController extends Controller
{
    public function register(Request $request){
        $userRequest = $request->all();
        // validation
        $validator = Validator::make($request->all(),[
           'name' => 'required',
           'email' => 'required',
           'phoneNumber' => 'required',
           'password' => 'required',
           'address' => 'nullable'
        ]);

        if($validator->fails()){
            return response()->json([
               'message' => $validator->errors()->all(),
               'status' => false
            ],400);
        }

        // user create
        $userCreate = User::create([
           'name' => $request->name,
           'email' => $request->email,
            'password' => bcrypt($request->password),
            'phoneNumber' => $request->phoneNumber,
           'address' => $request->address
        ]);

        // create token
        $success['token'] = $userCreate->createToken('myApp')->accessToken;

        return response()->json([
            'data' => $userCreate,
           'message' => 'success message',
           'token' => $success['token'],
           'status' => true
        ]);
    }
}
