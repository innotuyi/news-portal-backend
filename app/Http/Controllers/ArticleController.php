<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str; // Import the Str facade


class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::all();
        return response()->json($articles);
    }

    public function show($slug)
    {
        try {
            $article = Article::join('categories', 'categories.id', '=', 'articles.categoryID')
                   ->join('authors', 'authors.id', '=', 'articles.authorID')
                   ->select('articles.*', 'categories.name as category_name', 'authors.name as author_name')
                   ->where('articles.slug', $slug)
                   ->firstOrFail();

            return response()->json($article);
        } catch (\Exception $e) {
            return response()->json("Article not found", 404);
        }
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            // 'status' => 'required|boolean',
            'categoryID' => 'required|exists:categories,id',
            'authorID' => 'required|exists:authors,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $slug = Str::slug($request->title);

        $article = Article::create(array_merge($request->all(), ['slug' => $slug]));

        return response()->json($article, 201);
    }

    public function update(Request $request, $slug)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'status' => 'required|boolean',
            'category_id' => 'required|exists:categories,id',
            'author_id' => 'required|exists:authors,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $article = Article::where('slug', $slug)->firstOrFail();
        $article->update($request->all());
        return response()->json($article, 200);
    }

    public function destroy($slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();
        $article->delete();
        return response()->json(null, 204);
    }


    public function getArticlesByCategory($category)
    {
        try {
            $article = Article::join('categories', 'categories.id', '=', 'articles.categoryID')
                   ->join('authors', 'authors.id', '=', 'articles.authorID')
                   ->select('articles.*', 'categories.name as category_name', 'authors.name as author_name')
                   ->where('articles.categoryID', $category)
                   ->firstOrFail();

                   return response()->json($article);

        } catch (\Throwable $th) {
                              return response()->json("article not found");

        }

    }
}
