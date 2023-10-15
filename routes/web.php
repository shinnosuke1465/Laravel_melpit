<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MyPage\ProfileController;
use App\Http\Controllers\SellController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\MyPage\SoldItemsController;
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

Route::get('', [ItemsController::class,'showItems'])->name('top');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('items/{item}', function () {return "商品詳細";})->name('item');

Route::middleware('auth')
->group(function () {
    Route::get('sell', [SellController::class,'showSellForm'])->name('sell');
    Route::post('sell', [SellController::class,'sellItem'])->name('sell');
    Route::get('sold-items', [SoldItemsController::class,'showSoldItems'])->name('mypage.sold-items');
});

Route::prefix('mypage')
    ->middleware('auth')
    ->namespace('MyPage')
    ->group(function () {
        Route::get('edit-profile', [ProfileController::class, 'showProfileEditForm'])->name('mypage.edit-profile');
        Route::post('edit-profile', [ProfileController::class,'editProfile'])->name('mypage.edit-profile');
    });
