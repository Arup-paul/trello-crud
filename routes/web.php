<?php

use App\Http\Controllers\BoardController;
use App\Http\Controllers\TrelloController;
use Illuminate\Support\Facades\Route;

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
Route::get('/test',function (){
   return view('test');
});
Route::get('/', function () {
    return view('login');
})->name('login.home');

Route::post('login',[TrelloController::class,'login'])->name('login');

Route::middleware(['authorize'])->group(function () {
Route::get('/organizations',[TrelloController::class,'organizations'])->name('organizations');
Route::get('/board/{id}',[TrelloController::class,'boards'])->name('board');
Route::post('/store-list',[TrelloController::class,'StoreList'])->name('list.store');
Route::get('/list-show/{id}',[TrelloController::class,'showList'])->name('list.show');
Route::post('/store-card',[TrelloController::class,'StoreCard'])->name('card.store');
Route::get('/card-show/{id}',[TrelloController::class,'showCard'])->name('card.show');

Route::resource('boards',BoardController::class);


Route::get('logout',[TrelloController::class,'logout'])->name('logout');

});
