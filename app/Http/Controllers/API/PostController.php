<?php

namespace App\Http\Controllers\API;

use App\Comment;
use App\Post;
use App\Http\Requests\PostCreateRequest;
use App\Http\Requests\PostFetchRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Http\Requests\PostDeleteRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Create a new post
     *
     * @param App\Http\Requests\PostCreateRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     **/
     public function create(PostCreateRequest $request) {
       try {
         Post::create([
           'image'        => $request->file('image')->store('public/images'),
           'author'       => $request->input('author'),
           'description'  => $request->input('description'),
           'likes'        => ''
         ]);
       }
       catch (\Exception $e) {
         return response()->json([
           'code'   => 500,
           'message'=> $e->getMessage()
         ], 500);
       }

       return response()->json([
         'code'   => 201,
         'message'=> 'Post created'
       ], 201);
     }

    /**
     * Fetch a post based on given id
     *
     * @param App\Http\Requests\PostFetchRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     **/
     public function fetch(PostFetchRequest $request) {
       try {
         $post = Post::find($request->input('id'));

         // TODO etch comments associated with this post
       }
       catch (\Exception $e) {
         return response()->json([
           'code'   => 500,
           'message'=> $e->getMessage()
         ], 500);
       }

       return response()->json([
         'code' => 200,
         'data' => $post
       ], 200);
     }

    /**
     * Fetch all posts
     *
     * @return \Illuminate\Http\JsonResponse
     **/
     public function fetchAll() {
       try {
         $posts = Post::all();
       }
       catch (\Exception $e) {
         return response()->json([
           'code'   => 500,
           'message'=> $e->getMessage()
         ], 500);
       }

       return response()->json([
         'code'   => 200,
         'data'   => $posts
       ], 200);
     }

    /**
     * Update a post
     *
     * @param App\Http\Requests\PostUpdateRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     **/
     public function update(PostUpdateRequest $request) {
       try {
         $post = Post::find($request->input('id'))
          ->fill(
            ['description' => $request->input('description')]
          );

         $post->save();
       }
       catch (\Exception $e) {
         return response()->json([
           'code'   => 500,
           'message'=> $e->getMessage()
         ], 500);
       }

       return response()->json([
         'code'     => 200,
         'message'  => 'Post updated'
       ], 200);
     }

    /**
     * Delete a post
     *
     * @param App\Http\Requests\PostDeleteRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     **/
     public function delete(PostDeleteRequest $request) {
       try {
         Post::destroy($request->input('id'));
       }
       catch (\Exception $e) {
         return response()->json([
           'code'   => 500,
           'message'=> $e->getMessage()
         ], 500);
       }

       return response()->json([
         'code'     => 200,
         'message'  => 'Post deleted'
       ], 200);
     }
}
