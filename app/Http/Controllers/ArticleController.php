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
        $article = Article::where('slug', $slug)->firstOrFail();
        return response()->json($article);
    }

    public function store(Request $request)
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
        // Fetch articles by joining the articles, categories, and authors tables
        $articles = Article::select('articles.*')
            ->join('categories', 'articles.categoryID', '=', 'categories.id')
            ->where('categories.name', $category)
            ->get();

        return response()->json($articles, 200);
    }
}
