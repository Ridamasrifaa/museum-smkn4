<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Siswa\DashboardController;
use App\Http\Controllers\Siswa\ProjectController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\controllers\Admin\AdminProjectController;
use App\Http\Controllers\Admin\AdminSiswaController;
use App\Http\Controllers\Admin\AdminCategoryController;


Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/', function () {
    return view('index');
});
Route::get('/karya', function () {
    return view('karya');
});
Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);
Route::middleware('auth')->group(function () {

    Route::get('/admin/dashboard', [AdminDashboardController::class,'index']);

});
Route::get('/admin/karya', function () {
    return view('admin.karya');
});
Route::get('/admin/kategori', function () {
    return view('admin.kategori');
});
Route::get('/admin/manajemen-admin', function () {
    return view('admin.admin');
});

Route::get('/siswa/karya/detail', function () {
    return view('siswa.detail');
});

Route::middleware('auth')->group(function () {
    Route::get('/siswa/dashboard', [DashboardController::class, 'index']);
});
Route::get('/siswa/karya', [ProjectController::class, 'index'])
    ->middleware('auth');

    Route::middleware('auth')->group(function () {
    Route::get('/siswa/karya/detail/{project}', [ProjectController::class, 'show']);
});
Route::middleware('auth')->group(function () {

    Route::get('/admin/karya',
        [AdminProjectController::class,'index']);

    Route::put(
        '/admin/karya/{project}/update-status',
        [AdminProjectController::class,'updateStatus']
    );

});

Route::middleware('auth')->group(function () {

    Route::get('/admin/siswa',
        [AdminSiswaController::class,'index']);

    Route::put('/admin/siswa/{user}/update',
        [AdminSiswaController::class,'update']);

   
    Route::get('/siswa/upload', [ProjectController::class, 'upload']);

    Route::post('/siswa/upload', [ProjectController::class, 'store']);

});

Route::middleware('auth')->group(function () {

    Route::get('/admin/kategori',
        [AdminCategoryController::class,'index']);

    Route::post('/admin/kategori/store',
        [AdminCategoryController::class,'store']);

    Route::put('/admin/kategori/{category}/update',
        [AdminCategoryController::class,'update']);

    Route::delete('/admin/kategori/{category}',
        [AdminCategoryController::class,'destroy']);

});
Route::middleware('auth')->group(function () {

    Route::get('/siswa/dashboard', [DashboardController::class, 'index']);

    Route::get('/siswa/karya', [ProjectController::class, 'index']);

    Route::get('/siswa/karya/detail/{project}', [ProjectController::class, 'show']);

    Route::post('/siswa/upload', [ProjectController::class, 'store']);

});
Route::middleware('auth')->group(function () {

    Route::get('/admin/karya', [AdminProjectController::class,'index']);

    Route::get('/admin/karya/{project}', [AdminProjectController::class,'show']);

    Route::put('/admin/karya/{project}/update-status',
        [AdminProjectController::class,'updateStatus']);

});
Route::middleware('auth')->group(function () {
    Route::get('/siswa/karya/detail/{project}', [ProjectController::class, 'show']);
});
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');