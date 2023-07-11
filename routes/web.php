<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [PostController::class, 'index'])->name('posts');
Route::get('/my-posts', [PostController::class, 'myposts'])->name('myposts');
Route::get('/post/{id}/detail', [PostController::class,  'show'])->name('posts.detail');
Route::get('/post/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/post/store', [PostController::class, 'store'])->name('posts.store');

Route::post('/comment/store', [CommentController::class, 'store'])->name('comment.store');

Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
Route::post('/categories/store', [CategoryController::class, 'store'])->name('categories.store');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
