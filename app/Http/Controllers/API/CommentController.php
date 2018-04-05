<?php

namespace App\Http\Controllers\API;

use App\Comment;
use App\Http\Requests\CommentCreateRequest;
use App\Http\Requests\CommentDeleteRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
  /**
   * Create a comment
   *
   * @param App\Http\Requests\CommentCreateRequest $request
   *
   * @return \Illuminate\Http\JsonResponse
   **/
   public function create(CommentCreateRequest $request) {
     try {
       Comment::create([
         'post_id'  => $request->input('post_id'),
         'author'   => $request->input('author'),
         'comment'  => $request->input('comment')
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
       'message'=> 'Comment created'
     ], 201);
   }

  /**
   * Delete a comment
   *
   * @param App\Http\Requests\CommentDeleteRequest $request
   *
   * @return \Illuminate\Http\JsonResponse
   **/
   public function delete(CommentDeleteRequest $request) {
     try {
       Comment::destroy($request->input('id'));
     }
     catch (\Exception $e) {
       return response()->json([
         'code'   => 500,
         'message'=> $e->getMessage()
       ], 500);
     }

     return response()->json([
       'code'     => 200,
       'message'  => 'Comment deleted'
     ], 200);
   }
}
