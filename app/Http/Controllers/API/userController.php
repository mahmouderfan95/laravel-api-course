<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    public function login(Request $request){
        try{
            $userRequest = $request->all();
            // make validation
            $validation = Validator::make($userRequest,[
               'email' => 'required',
               'password' => 'required'
            ]);
            // validation error
            if($validation->fails()){
                return response()->json([
                   'message' => $validation->errors()->all(),
                   'status' => false,
                ],400);
            }
            // check user auth [ email and password ]
            if(Auth::guard('web')->attempt([
                'email' => $request->email,
                'password' => $request->password
            ])){
                $user = Auth::guard('web')->user();
                $success['token'] = $user->createToken('my App')->accessToken;
                return response()->json([
                   'data' => $user,
                    'token' => $success['token'],
                    'message' => 'success message',
                    'status' => true
                ]);
            }else{
                return response()->json([
                   'message' => 'email or password not correct',
                   'status' => false
                ],401);
            }
        }catch (\Exception $exception){
            return response()->json([
               'message' => $exception->getMessage(),
               'status' => false
            ],500);
        }
    }
}
