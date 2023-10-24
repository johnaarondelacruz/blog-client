<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Auth - Public Routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/posts', [PostController::class, 'index']);
Route::get('/posts/{id}', [PostController::class, 'show']);

// Protected Routes
Route::group(['middleware' => ['auth:sanctum']], function() {

// Category
    Route::post('/category/{post_id}', [PostController::class, 'category']);
    Route::put('/category/{post_id}', [PostController::class, 'categoryUpdate']);
    Route::delete('/category/{post_id}', [PostController::class, 'categoryDelete']);

// Posts
    
    Route::post('/posts', [PostController::class, 'store']);
    Route::put('/posts/{id}', [PostController::class, 'update']);
    Route::delete('/posts/{id}', [PostController::class, 'destroy']);

// Like
    Route::post('/posts/like/{post_id}', [PostController::class, 'like']);

// Comment
    Route::post('/comment/{post_id}', [PostController::class, 'comment']);

// Logout
    Route::post('/logout', [AuthController::class, 'logout']);

});

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
