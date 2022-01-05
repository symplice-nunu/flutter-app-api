<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{

    public function getAllPosts() {
      $posts = Post::get()->toJson(JSON_PRETTY_PRINT);
      return response($posts, 200);
    }

     public function getPost($id) {
      if (Post::where('id', $id)->exists()) {
        $post = Post::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
        return response($post, 200);
      } else {
        return response()->json([
          "message" => "Post not found"
        ], 404);
      }
    }

     public function createPost(Request $request) {
      $post = new Post;
      $post->name = $request->name;
      $post->email = $request->email;
      $post->content = $request->content;
      $post->yn = $request->yn;
      $post->save();

      return response()->json([
        "message" => "Post created"
      ], 201);
    }

    public function updatePost(Request $request, $id) {
      if (Post::where('id', $request->id)->exists()) {
        $post = Post::find($request->id);

        $post->name = is_null($request->name) ? $post->name : $request->name;
        $post->email = is_null($request->email) ? $post->email : $request->email;
        $post->content = is_null($request->content) ? $post->content : $request->content;
        $post->yn = is_null($request->yn) ? $post->yn : $request->yn;
        $post->save();

        return response()->json([
          "message" => "Post updated successfully"
        ], 200);
      } else {
        return response()->json([
          "message" => "Post not found"
        ], 404);
      }
    }

    public function deletePost ($id) {
      if(Post::where('id', $id)->exists()) {
        $post = Post::find($id);
        $post->delete();

        return response()->json([
          "message" => "Post deleted"
        ], 202);
      } else {
        return response()->json([
          "message" => "Post not found"
        ], 404);
      }
    }
}
