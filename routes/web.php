<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\TodoController;

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
Route::get('/', [MainController::class,'index']);
Route::post('/checklogin', [MainController::class,'checklogin']);
Route::get('/logout', [MainController::class,'logout']);
Route::get('/main', [ToDoController::class,'index']);
Route::post('/create', [ToDoController::class,'create']);
Route::post('/completed', [ToDoController::class,'completed']);
 


