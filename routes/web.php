<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\GoogleLoginController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\MygoodsController;

Route::get('/', [PostController::class, 'index'])->name('index');

Route::controller(PostController::class)->middleware(['auth'])->group(function(){
    Route::post('/posts', 'store')->name('store');
    Route::post('/posts/like', 'like')->name('post.like');
    Route::get('/posts/create', 'create')->name('create');
    Route::put('/posts/{post}', 'update')->name('update');
    Route::get('/posts/{post}/edit', 'edit')->name('edit');
    Route::post('/users/reviews', 'review')->name('review');
});
Route::get('/posts/{post}', [PostController::class, 'show'])->name('show');

Route::post('/posts/{proposal}/deal/chat', [ChatController::class, 'messagetoProposal'])->name('send.message.proposal');
Route::post('/posts/{post}/chat', [ChatController::class, 'sendMessage'])->name('send.message.post');

Route::get('/users/reviews', [ReviewController::class,'indexReviews'])->middleware(['auth'])->name('index.reviews');

Route::get('/users/likes', [LikeController::class,'indexLikes'])->middleware(['auth'])->name('index.likes');

Route::controller(ProposalController::class)->middleware(['auth'])->group(function(){
    Route::get('/users/requests',  'indexRequests')->name('index.requests');
    Route::get('/posts/requests/{proposal}', 'showRequest')->name('show.request');
    Route::get('/users/deals', 'indexDealing')->name('index.deals'); 
    Route::get('/posts/{proposal}/deal', 'showDealing')->name('dealing');
    Route::delete('/posts/{proposal}/deal', 'deleteProposal')->name('delete.proposal');
    Route::put('/posts/{proposal}/deal', 'updateDeal')->name('update.deal');
    Route::post('/users/requests', 'storeRequest')->name('store.request');
});
    
Route::get('/users/{user}/mygoods',  [UserController::class,'showMygoods'])->name('user.mygoods');
Route::get('/users/{user}',  [UserController::class,'showUser'])->name('user_page');

Route::controller(MygoodsController::class)->middleware(['auth'])->group(function(){
    Route::post('user/mygoods', 'addMygoods');
    Route::delete('user/mygoods', 'deleteMygoods');
    Route::get('user/mygoods', 'getMygoods');
});

Route::get('/dashboard', function () {
    return view('/dashbord');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// googleへのリダイレクト
Route::get('/auth/google', [GoogleLoginController::class, 'redirectToGoogle']);
// 認証後の処理
Route::get('/auth/google/callback', [GoogleLoginController::class, 'handleGoogleCallback']);

require __DIR__.'/auth.php';