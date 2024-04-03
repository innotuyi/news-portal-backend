<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\TagController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use PharIo\Manifest\AuthorCollection;

// Articles Controller
Route::get('/articles', [ArticleController::class, 'index']);
Route::get('/articles/{slug}',  [ArticleController::class, 'show']);
Route::post('/articles',  [ArticleController::class, 'store']);
Route::put('/articles/{slug}',  [ArticleController::class, 'update']);
Route::delete('/articles/{slug}',  [ArticleController::class, 'destroy']);
Route::get('/categories/{category}', [ArticleController::class, 'getArticlesByCategory']);


// Authors Controller
Route::get('/authors', [AuthorController::class, 'index']);
Route::get('/authors/{id}', [AuthorController::class, 'SingleAuthor']);
Route::post('/authors',  [AuthorController::class, 'store']);
Route::put('/authors/{id}', [AuthorController::class, 'update']);
Route::delete('/authors/{id}',  [AuthorController::class, 'destroy']);

// Categories Controller
Route::get('/categories',  [CategoryController::class, 'index']);
Route::get('/category/{id}',  [CategoryController::class, 'show']);
Route::post('/categories',  [CategoryController::class, 'store']);
Route::put('/categories/{id}', [CategoryController::class, 'update']);
Route::delete('/categories/{id}',  [CategoryController::class, 'destroy']);

// Tags Controller
Route::get('/tags', [TagController::class, 'index']);
Route::get('/tags/{id}', [TagController::class, 'show']);
Route::post('/tags', [TagController::class, 'store']);
Route::put('/tags/{id}',[TagController::class, 'update']);
Route::delete('/tags/{id}', [TagController::class, 'destroy']);

// Comments Controller
Route::get('/articles/{article_id}/comments',  [CommentController::class, 'index']);
Route::post('/articles/{article_id}/comments',  [CommentController::class, 'store']);
Route::delete('/comments/{id}',  [CommentController::class, 'destroy']);



// Advertising Stories Controller
Route::get('/advertising-stories', 'AdvertisingStoryController@index');
Route::get('/advertising-stories/{id}', 'AdvertisingStoryController@show');
Route::post('/advertising-stories', 'AdvertisingStoryController@store');
Route::put('/advertising-stories/{id}', 'AdvertisingStoryController@update');
Route::delete('/advertising-stories/{id}', 'AdvertisingStoryController@destroy');

// Announcements Controller
Route::get('/announcements', 'AnnouncementController@index');
Route::get('/announcements/{id}', 'AnnouncementController@show');
Route::post('/announcements', 'AnnouncementController@store');
Route::put('/announcements/{id}', 'AnnouncementController@update');
Route::delete('/announcements/{id}', 'AnnouncementController@destroy');


Route::get('/test', function() {
    return 'Hello world';
});