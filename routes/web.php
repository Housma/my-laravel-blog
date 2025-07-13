<?php
require __DIR__.'/auth.php';
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\Admin\AuthController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/about', [PageController::class, 'about']);
Route::get('/post-list', [PostController::class, 'list']);
Route::get('/posts/trashed', [PostController::class, 'trashed'])->name('posts.trashed');
Route::post('/posts/{id}/restore', [PostController::class, 'restore'])->name('posts.restore');
Route::delete('/posts/{id}/force-delete', [PostController::class, 'forceDelete'])->name('posts.forceDelete');
Route::resource('posts', PostController::class);


Route::resource('categories', CategoryController::class);
Route::resource('tags', TagController::class);
Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/debug-session', function () {
    return session()->all();
});
Route::prefix('admin')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');

    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard',function(){
            return view('admin.dashboard');
        } )->name('admin.dashboard');
        Route::middleware(['auth:admin', 'check.admin.role'])->group(function () {
            Route::resource('/admins', \App\Http\Controllers\Admin\AdminManagementController::class)->names('admin.admins');
        });
    });
    
});