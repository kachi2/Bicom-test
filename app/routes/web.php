<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\HomeController as Home;
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


Auth::routes();

Route::get('/', [Home::class, 'index'])->name('home');
Route::get('/list/lga/',[Home::class, 'getLga'])->name('getLga');
Route::get('/lga/polls/{id}',[Home::class, 'getLgaPolls'])->name('getLgaPolls');
Route::get('/polls/results/{id}',[Home::class, 'getPollsResult'])->name('polls-result');
Route::get('/lga/results', [Home::class, 'LgaResults'])->name('lgaResults');
Route::get('/lgas/results/{id}', [Home::class, 'LgaPollsResult'])->name('lga-polls-result');
Route::get('/lgas/create/', [Home::class, 'CreatePolls'])->name('create-polls');
Route::post('/polls/store', [Home::class, 'PollsStore'])->name('PollsStore');