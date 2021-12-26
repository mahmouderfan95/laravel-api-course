<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
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

    public function getProducts(Request $request){
        try{
            $products = Product::where('category_id',$request->category_id)->get(['id','name','description','price']);
            if($products->count() > 0 ){
                return response()->json([
                    'data' => $products,
                    'message' => 'success message',
                    'status' => true
                ]);
            }

            return response()->json([
               'message' => 'products not found',
               'status' => false
            ],400);
        }catch (\Exception $exception){
            return response()->json([
               'message' => $exception->getMessage(),
               'status' => false
            ],500);
        }
    }

    public function productDetails(Request $request){
        try{
            $product = Product::where('id',$request->product_id)
                ->select(['id','name','description','price','image','color','size'])
                ->first();
            if($product){
                return response()->json([
                   'data' => $product,
                   'message' => 'success message',
                   'status' => true
                ]);
            }
            return response()->json([
                'message' => 'product not found',
                'status' => false
            ],400);

        }catch (\Exception $exception){
            return response()->json([
               'message' => $exception->getMessage(),
               'status' => false,
            ],500);
        }
    }
}
