<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class favoriteController extends Controller
{
    public function addProduct(Request $request){
        try{
            $favoriteRequest = $request->all();
            // validation
            $validator = Validator::make($request->all(),[
                'user_id' => 'required|exists:users,id',
                'product_id' => 'required|exists:products,id'
            ]);

            if($validator->fails()){
                return response()->json([
                    'message' => $validator->errors()->all(),
                    'status' => false
                ],400);
            }

            $favoriteCreate = Favorite::create([
               'user_id' => $request->user_id,
               'product_id' => $request->product_id
            ]);

            return response()->json([
               'message' => 'success message',
               'status' => true
            ]);
        }catch (\Exception $ex){
            return response()->json([
               'message' => $ex->getMessage(),
               'status' => false
            ],500);
        }
    }

    public function getProducts(Request $request){
        try{
            $products = Favorite::where('user_id',$request->user_id)
                ->with('product')
                ->get();
            if($products->count() > 0){
                return response()->json([
                   'data' => $products,
                   'message' => 'success message',
                   'status' => true
                ]);
            }
            return response()->json([
                'message' => 'faild message',
                'status' => false
            ],400);
        }catch (\Exception $exception){
            return response()->json([
               'message' => $exception->getMessage(),
               'status' => false
            ],500);
        }
    }
}
