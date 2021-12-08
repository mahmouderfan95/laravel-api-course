<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class postController extends Controller
{
    public function createPost(Request $request){
        try{
            $postCreate = Post::create([
               'title' => $request->title,
               'desc' => $request->desc
            ]);
            return response()->json([
               'message' => 'post created',
               'status' => true
            ]);
        }catch (\Exception $ex){
            return response()->json([
               'message' => $ex->getMessage()
            ]);
        }
    }

    public function updatePost(Request $request){
        try{
            $post = Post::where('id',$request->id)->first();
            if($post){
                $post->title = $request->title;
                $post->desc = $request->desc;
                $post->save();
                return response()->json([
                   'message' => 'post updated',
                   'status' => true
                ]);
            }

            return response()->json([
               'message' => 'post not found',
               'status' => false
            ],404);
        }catch (\Exception $ex){
            return response()->json([
               'message' => $ex->getMessage()
            ]);
        }
    }

    public function deletePost(Request $request){
        try{
            $post = Post::where('id',$request->id)->first();
            if($post){
                $post->delete();
                return response()->json([
                   'message' => 'post deleted',
                   'status' => true
                ]);
            }
            return response()->json([
               'message' => 'post not found',
               'status' => false
            ],400);
        }catch (\Exception $ex){
            return response()->json([
               'message' => $ex->getMessage(),
               'status' => false
            ],500);
        }
    }

}
