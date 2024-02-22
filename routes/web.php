<?php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LikeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SadController;

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

Route::get('/', function () {
    return view('home');
});

Route::get('/home', function () {
    return view('home');
})->name('home');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/post/index', [PostController::class, 'index'])->name('post.index');
    Route::get('/post/create', [PostController::class, 'create'])->name('post.create');
    Route::post('/post/store', [PostController::class, 'store'])->name('post.store');
    Route::get('/post/{id}', [PostController::class, 'edit'])->name('post.edit');
    Route::patch('/post/{id}', [PostController::class, 'update'])->name('post.update');
    Route::delete('/post/{id}', [PostController::class, 'destroy'])->name('post.destroy');

    Route::get('/post/{id}/like', [LikeController::class, 'like'])->name('post.like');
    Route::get('/post/{id}/unlike', [LikeController::class, 'unlike'])->name('post.unlike');
    Route::get('/post/{id}/sad', [SadController::class, 'sad'])->name('post.sad');
    Route::get('/post/{id}/unsad', [SadController::class, 'unsad'])->name('post.unsad');

    Route::get('/myposts', [PostController::class, 'myPosts'])->name('myposts');

    Route::get('/freeposts', [PostController::class, 'freePosts'])->name('freeposts');
    Route::get('/sportsposts', [PostController::class, 'sportsPosts'])->name('sportsposts');
    Route::get('/animeposts', [PostController::class, 'animePosts'])->name('animeposts');
    Route::get('/gameposts', [PostController::class, 'gamePosts'])->name('gameposts');
    Route::get('/movieposts', [PostController::class, 'moviePosts'])->name('movieposts');

    Route::get('/likeSort', [PostController::class, 'likeSort'])->name('likeSort');
});

require __DIR__.'/auth.php';

