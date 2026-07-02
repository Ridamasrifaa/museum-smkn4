<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Siswa\DashboardController;
use App\Http\Controllers\Siswa\ProjectController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminProjectController;
use App\Http\Controllers\Admin\AdminSiswaController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\Admin\AdminManagementController;
use App\Http\Controllers\KaryaController;



Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);


Route::get('/', [PublicController::class,'index']);
Route::get('/karya', [KaryaController::class, 'index']);
Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

Route::middleware('auth')->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class,'index']);

    Route::get('/siswa/dashboard', [DashboardController::class, 'index']);
    Route::get('/siswa/karya', [ProjectController::class, 'index']);
    Route::get('/siswa/karya/detail/{project}', [ProjectController::class, 'show']);
    Route::get('/siswa/upload', [ProjectController::class, 'upload']);
    Route::post('/siswa/upload', [ProjectController::class, 'store']);

    Route::get('/admin/karya', [AdminProjectController::class,'index']);
    Route::get('/admin/karya/{project}', [AdminProjectController::class,'show']);
    Route::put('/admin/karya/{project}/update-status', [AdminProjectController::class,'updateStatus']);

    Route::get('/admin/siswa', [AdminSiswaController::class,'index']);
    Route::put('/admin/siswa/{user}/update', [AdminSiswaController::class,'update']);

    Route::get('/admin/kategori', [AdminCategoryController::class,'index']);
    Route::post('/admin/kategori/store', [AdminCategoryController::class,'store']);
    Route::put('/admin/kategori/{category}/update', [AdminCategoryController::class,'update']);
    Route::delete('/admin/kategori/{category}', [AdminCategoryController::class,'destroy']);

    Route::get('/admin/manajemen-admin',[AdminManagementController::class,'index']);
    Route::post('/admin/manajemen-admin',[AdminManagementController::class,'store']);
    Route::put('/admin/manajemen-admin/{user}',[AdminManagementController::class,'update']);
    Route::delete('/admin/manajemen-admin/{user}',[AdminManagementController::class,'destroy']);
});
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');