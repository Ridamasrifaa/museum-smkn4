<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/', [HomeController::class,'index']);

Route::get('/karya',[KaryaController::class,'index']);
Route::get('/karya/{id}',[KaryaController::class,'show']);

Route::get('/artikel',[ArtikelController::class,'index']);
Route::get('/artikel/{id}',[ArtikelController::class,'show']);

Route::get('/login',[LoginController::class,'index']);
