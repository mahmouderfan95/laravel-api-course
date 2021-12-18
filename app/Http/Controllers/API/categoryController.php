<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class categoryController extends Controller
{
    public function getCategories(Request $request){
        try{
            $categories = Category::get(['id','title','description']);
            if($categories->count() > 0){
                return response()->json([
                    'data' => $categories,
                    'message' => 'success message',
                    'status' => true
                ]);
            }
            return response()->json([
                'message' => 'categories not found',
                'status' => false,
            ],400);
        }catch (\Exception $exception){
            return response()->json([
               'message' => $exception->getMessage(),
               'status' => false
            ],500);
        }
    }
}
