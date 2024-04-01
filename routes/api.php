<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthorsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\TagController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Articles Controller
Route::get('/api/articles', [ArticleController::class, 'index']);
Route::get('/api/articles/{slug}',  [ArticleController::class, 'show']);
Route::post('/api/articles',  [ArticleController::class, 'store']);
Route::put('/api/articles/{slug}',  [ArticleController::class, 'update']);
Route::delete('/api/articles/{slug}',  [ArticleController::class, 'destroy']);

Route::get('/api/categories/{category}', [ArticleController::class, 'getArticlesByCategory']);


// Authors Controller
Route::get('/api/authors', [AuthorsController::class, 'index']);
Route::get('/api/authors/{id}', [AuthorsController::class, 'show']);
Route::post('/api/authors',  [AuthorsController::class, 'store']);
Route::put('/api/authors/{id}', [AuthorsController::class, 'update']);
Route::delete('/api/authors/{id}',  [AuthorsController::class, 'destroy']);

// Categories Controller
Route::get('/api/categories',  [CategoryController::class, 'index']);
Route::get('/api/categories/{id}',  [CategoryController::class, 'show']);
Route::post('/api/categories',  [CategoryController::class, 'store']);
Route::put('/api/categories/{id}', [CategoryController::class, 'update']);
Route::delete('/api/categories/{id}',  [CategoryController::class, 'destroy']);

// Tags Controller
Route::get('/api/tags', [TagController::class, 'index']);
Route::get('/api/tags/{id}', [TagController::class, 'show']);
Route::post('/api/tags', [TagController::class, 'store']);
Route::put('/api/tags/{id}',[TagController::class, 'update']);
Route::delete('/api/tags/{id}', [TagController::class, 'destroy']);

// Comments Controller
Route::get('/api/articles/{article_id}/comments',  [CommentController::class, 'index']);
Route::post('/api/articles/{article_id}/comments',  [CommentController::class, 'store']);
Route::delete('/api/comments/{id}',  [CommentController::class, 'destroy']);



// Advertising Stories Controller
Route::get('/api/advertising-stories', 'AdvertisingStoryController@index');
Route::get('/api/advertising-stories/{id}', 'AdvertisingStoryController@show');
Route::post('/api/advertising-stories', 'AdvertisingStoryController@store');
Route::put('/api/advertising-stories/{id}', 'AdvertisingStoryController@update');
Route::delete('/api/advertising-stories/{id}', 'AdvertisingStoryController@destroy');

// Announcements Controller
Route::get('/api/announcements', 'AnnouncementController@index');
Route::get('/api/announcements/{id}', 'AnnouncementController@show');
Route::post('/api/announcements', 'AnnouncementController@store');
Route::put('/api/announcements/{id}', 'AnnouncementController@update');
Route::delete('/api/announcements/{id}', 'AnnouncementController@destroy');
