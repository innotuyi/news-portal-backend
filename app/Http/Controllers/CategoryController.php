<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::all();
        return response()->json($categories, 200);
    }


    public function show($id)
    {
        try {
            $category = Category::findOrFail($id);
            return response()->json($category, 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'no category found'], 500);
        }
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $category = Category::create($request->only([
            'name'
        ]));

        return response()->json($category, 201);
    }

    public function update(Request $request, $id)
    {
        try {
            $category = Category::findOrFail($id);

            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }

            $category->update($request->only([
                'name'
            ]));

            return response()->json($category, 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'error occured during update'], 404);
        }
    }

    public function destroy($id)
    {

        try {
            $category = Category::findOrFail($id);
            $category->delete();
            return response()->json(null, 204);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'error occured during deletion'], 404);
        }
    }
}
