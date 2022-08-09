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

Route::get('/', function () {
    return view('login');
});

Route::post('login',[TrelloController::class,'login'])->name('login');

Route::get('/organizations',[TrelloController::class,'organizations'])->name('organizations');
Route::get('/board/{id}',[TrelloController::class,'boards'])->name('board');

Route::resource('boards',BoardController::class);


//api key -> dc05ec2ef5337f946a7a68d28eb9a639
//api token = eb88e4eef82bd811fd3c04d1fef4432449e0448d9a341374bd9646db1f702930
