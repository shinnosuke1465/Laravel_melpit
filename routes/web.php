<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MyPage\ProfileController;
use App\Http\Controllers\SellController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MyPage\SoldItemsController;
use App\Http\Controllers\MyPage\BoughtItemsController;
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

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('items/{item}', [ItemsController::class,'showItemDetail'])->name('item');

Route::middleware('auth')
->group(function () {
    Route::get('items/{item}/buy', [ItemsController::class,'showBuyItemForm'])->name('item.buy');
    Route::post('items/{item}/buy', [ItemsController::class,'buyItem'])->name('item.buy');
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
        Route::get('bought-items', [BoughtItemsController::class,'showBoughtItems'])->name('mypage.bought-items');
    });
