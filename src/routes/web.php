<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ReseController;
use App\Http\Controllers\LikeController;


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
Route::get('/thanks', [ShopController::class, 'thanks']);
/*ここからバリデーションかけるルート*/
Route::get('/link/user', [ShopController::class, 'linkUser'])->name('linkUser');
Route::post('/reservation', [ReseController::class, 'create']);
Route::post('/reservation/delete', [ReseController::class, 'delete']);
Route::post('/favorite', [LikeController::class, 'likeCreate']);
Route::post('/favorite/delete', [LikeController::class, 'likeDelete']);

/*コーディング用ルート。コーディング終了後消去*/
Route::get('/test', [ShopController::class, 'test']);