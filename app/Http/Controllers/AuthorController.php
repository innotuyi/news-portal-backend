<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Stmt\TryCatch;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authors = Author::all();
        return response()->json($authors, 200);
    }


    public function SingleAuthor($id)
    {
        try {
            $author = Author::findOrFail($id);

            return response()->json($author, 200);
        } catch (\Exception $e) {
            return response()->json("Author not found", 404);
        }
    }



    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:authors',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $author = Author::create($request->only([
            'name', 'email', 'password'
        ]));

        return response()->json($author, 201);
    }

    public function update(Request $request, $id)
    {
        try {
            $author = Author::findOrFail($id);

            $validator = Validator::make($request->all(), [
                'name' => 'string|max:255',
                'email' => 'email|unique:authors,email,' . $author->id,
                'password' => 'string|min:8',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }

            $author->update($request->only([
                'name', 'email', 'password'
            ]));

            return response()->json($author, 200);
        } catch (\Exception $e) {
            // Handle any exceptions
            return response()->json(['message' => 'Error occurred while updating author'], 500);
        }
    }


    public function destroy($id)
    {
        try {
            $author = Author::findOrFail($id);
        $author->delete();
        return response()->json(null, 204);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error occurred while deleting author'], 500);

        }
    }
}
