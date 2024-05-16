<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ReseController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\MailController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [ShopController::class, 'index'])->name('index');
Route::get('/search', [ShopController::class, 'search']);
Route::get('/detail/{shop}', [ShopController::class, 'detail'])->name('detail');
Route::get('/link/register', [ShopController::class, 'linkRegister'])->name('linkRegister');
Route::get('/link/login', [ShopController::class, 'linkLogin'])->name('linkLogin');

Route::get('/indicate', [ReseController::class, 'indicate']);
Route::get('/indicate/edit', [ReseController::class, 'indicateEdit']);

Route::get('/multi/index', [AdminController::class, 'multiIndex'])->name('multiIndex');
Route::post('/multi/login', [AdminController::class, 'multiLogin']);

Route::middleware('verified')->group(function() {
    Route::get('/thanks', [ShopController::class, 'thanks']);
    Route::get('/link/user', [ShopController::class, 'linkUser'])->name('linkUser');
    Route::get('/edit/{reservation}', [ShopController::class, 'edit'])->name('edit');

    Route::post('/reservation', [ReseController::class, 'create']);
    Route::post('/reservation/edit', [ReseController::class, 'reservationEdit']);
    Route::delete('/reservation/delete', [ReseController::class, 'delete']);

    Route::post('/favorite', [LikeController::class, 'likeCreate']);
    Route::delete('/favorite/delete', [LikeController::class, 'likeDelete']);

    Route::get('/review/{shop}', [ReviewController::class, 'review'])->name('review');
    Route::post('/review/create', [ReviewController::class, 'reviewCreate']);
});

Route::prefix('admin')->middleware('auth:admin')->group(function() {
    Route::get('/index', [AdminController::class, 'adminIndex']);
    Route::post('/create', [AdminController::class, 'adminCreate']);
});

Route::prefix('manager')->middleware('auth:manager')->group(function() {
    Route::get('/index', [ManagerController::class, 'managerIndex']);
    Route::get('/reservation', [ManagerController::class, 'managerReservation'])->name('managerReservation');
    Route::get('/new', [ManagerController::class, 'managerNew'])->name('managerNew');
    Route::post('/create', [ManagerController::class, 'managerCreate']);
    Route::get('/edit', [ManagerController::class, 'managerEdit'])->name('managerEdit');
    Route::post('/update', [ManagerController::class, 'managerUpdate']);
    Route::post('/upload', [ManagerController::class, 'managerUpload']);
});

Route::post('/mail', [MailController::class, 'send'])->middleware('auth:manager');

//レイアウト確認用//
Route::get('/test', [MailController::class, 'test']);