<?php

namespace App\Http\Controllers;
use App\post;
use Illuminate\Http\Request;
class PostController extends Controller
{
    public function showAllPost()
    {
        return response()->json(Post::all());
    }

    public function showOnePost($post_id)
    {
       return response()->json(post::find($post_id));
    }

    public function create(Request $request)
    {
        $post = post::create($request->all());
        return response()->json($post, 201);    
    }

    public function update($post_id, Request $request )
    {
        $post = post::findorfail($post_id);
        $post->update($request->all());
        return response()->json($post,200);
    }

    public function delete($post_id)
    {
        post::findorfail($post_id)->delete();
        return response('deleted successfully', 200);
    }

    public function listByUser(user_id)
    {
        return response()->json(post::find($post_id));

    }
}