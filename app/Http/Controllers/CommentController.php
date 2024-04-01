<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
 
    public function index($article_id)
    {
        $comments = Comment::where('articleID', $article_id)->get();
        return response()->json($comments, 200);
    }

   
    public function store(Request $request, $article_id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'content' => 'required|string',
            'status' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $comment = Comment::create([
            'name' => $request->name,
            'email' => $request->email,
            'content' => $request->content,
            'status' => $request->status,
            'articleID' => $article_id
        ]);

        return response()->json($comment, 201);
    }

   
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();
        return response()->json(null, 204);
    }
}
