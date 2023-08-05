<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\ReviewController;

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

/*Route::get('/', function () {
    return view('posts.index');
});
*/
Route::controller(PostController::class)->group(function(){
    Route::get('/', 'index')->name('index');
    Route::post('/posts', 'store')->name('store');
    Route::get('/posts/create', 'create')->name('create');
    Route::get('/posts/{post}', 'show')->name('show');
    Route::put('/posts/{post}', 'messageToPost')->name('message');
    Route::delete('/posts/{post}', 'delete')->name('delete');
    Route::get('/posts/{post}/edit', 'edit')->name('edit');
    Route::post('/users/reviews', 'review')->name('review');
   
});
Route::get('/users/reviews', [ReviewController::class,'indexReviews'])->name('index.reviews');

Route::controller(ProposalController::class)->group(function(){
    Route::get('/users/requests',  'indexRequests')->name('index.requests');
    Route::get('/posts/requests/{proposal}', 'showRequest')->name('show.request');
    Route::get('/users/deals', 'indexDealing')->name('index.deals'); 
    Route::get('/posts/{proposal}/deal', 'showDealing')->name('dealing');
    Route::post('/posts/{proposal}/deal', 'startDeal')->name('start.deal');
    Route::put('/posts/{proposal}/deal', 'messageToDeal')->name('deal.message');
    Route::post('/users/requests', 'storeRequest')->name('store.request');
});
    
Route::get('/users/{user}',  [UserController::class,'showUser'])->name('user_page');




Route::get('/dashboard', function () {
    return view('/dashbord');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
