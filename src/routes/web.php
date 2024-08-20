<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ReseController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\NewShopController;
use App\Http\Controllers\EditShopController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\StripeController;

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
Route::get('/sort', [ShopController::class, 'sort']);
Route::get('/search', [ShopController::class, 'search']);
Route::get('/detail/{shop}', [ShopController::class, 'detail'])->name('detail');

Route::get('/link/register', function() {
    return view ('auth.register');
})->name('linkRegister');
Route::get('/link/login', function() {
    return view ('auth.login');
})->name('linkLogin');

Route::middleware('verified')->group(function() {
    Route::get('/thanks', function() {
        return view ('thanks');
    });
    Route::get('/link/user', [ShopController::class, 'linkUser'])->name('linkUser');
    Route::get('/edit/{reservation}', [ShopController::class, 'edit'])->name('edit');

    Route::post('/reservation', [ReseController::class, 'create']);
    Route::post('/reservation/edit', [ReseController::class, 'reservationEdit']);
    Route::delete('/reservation/delete', [ReseController::class, 'delete']);
    Route::get('/indicate', [ReseController::class, 'indicate']);
    Route::get('/indicate/edit', [ReseController::class, 'indicateEdit']);

    Route::post('/favorite', [LikeController::class, 'likeCreate']);
    Route::delete('/favorite/delete', [LikeController::class, 'likeDelete']);

    Route::get('/review/{shop}', [ReviewController::class, 'review'])->name('review');
    Route::post('/review/create', [ReviewController::class, 'reviewCreate']);

    Route::prefix('assessment')->group(function() {
        Route::get('/{shop}', [AssessmentController::class, 'assessment'])->name('assessment');
        Route::post('/create', [AssessmentController::class, 'assessmentCreate']);
        Route::get('/edit/{shop}', [AssessmentController::class, 'assessmentEdit'])->name('assessmentEdit');
        Route::post('/update', [AssessmentController::class, 'assessmentUpdate']);
        Route::delete('/delete', [AssessmentController::class, 'assessmentDelete']);
    });

    Route::post('/charge', [StripeController::class, 'charge'])->name('stripeCharge');

    Route::get('/multi/index', function() {
        return view ('multi.multi-login');
    })->name('multiIndex');

    Route::post('/multi/login', [AdminController::class, 'multiLogin']);
});

Route::prefix('admin')->middleware('auth:admin')->group(function() {
    Route::get('/index', [AdminController::class, 'adminIndex']);
    Route::get('/new/manager', [AdminController::class, 'adminNewManager'])->name('adminNewManager');
    Route::post('/create', [AdminController::class, 'adminCreate']);
    Route::get('/shop/assessment', [AdminController::class, 'adminShopAssessment'])->name('adminShopAssessment');
    Route::get('/assessment/{shop}', [AdminController::class, 'adminAssessment'])->name('adminAssessment');
    Route::delete('/assessment/delete', [AdminController::class, 'adminAssessmentDelete']);
});

Route::prefix('manager')->middleware('auth:manager')->group(function() {
    Route::get('/index', [ManagerController::class, 'managerIndex'])->name('managerIndex');
    Route::get('/reservation/{store}', [ManagerController::class, 'managerReservation'])->name('managerReservation');
    Route::post('/upload', [ManagerController::class, 'managerUpload']);

    Route::get('/new', [NewShopController::class, 'managerNew'])->name('managerNew');
    Route::post('/create', [NewShopController::class, 'managerCreate']);
    Route::get('/show', [NewShopController::class, 'show']);

    Route::get('/edit/{store}', [EditShopController::class, 'managerEdit'])->name('managerEdit');
    Route::post('/update', [EditShopController::class, 'managerUpdate']);
    Route::get('/show/edit', [EditShopController::class, 'showEdit']);

});

Route::post('/mail', [MailController::class, 'send'])->middleware('verified:manager');