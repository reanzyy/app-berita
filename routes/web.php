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
Route::get('/post/{id}/detail', [PostController::class,  'show'])->name('posts.detail');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/my-posts', [PostController::class, 'myposts'])->name('myposts');
    Route::get('/post/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/post/store', [PostController::class, 'store'])->name('posts.store');
    Route::get('/post/{id}/edit', [PostController::class, 'edit'])->name('posts.edit')->middleware('post.owner');
    Route::patch('/post/{id}/update', [PostController::class, 'update'])->name('posts.update')->middleware('post.owner');
    Route::delete('/post/{id}/delete', [PostController::class, 'destroy'])->name('posts.delete')->middleware('post.owner');

    Route::post('/comment/store', [CommentController::class, 'store'])->name('comment.store');

    Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories/store', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::patch('/categories/{id}/update', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{id}/delete', [CategoryController::class, 'destroy'])->name('categories.delete');
});




require __DIR__ . '/auth.php';
