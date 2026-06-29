<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
// use App\Http\Controllers\PublicController;

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/', function () {
    return view('index');
});

// Route::middleware('guest')->group(function () {
//     Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
//     Route::post('/login', [AuthController::class, 'login']);
// });

// // Route ini hanya bisa diakses oleh user yang SUDAH login (auth)
// Route::middleware('auth')->group(function () {
//     Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
//     Route::get('/admin', function () {
//         return view('admin.dashboard');
//     })->name('admin.dashboard');
// });

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
});
Route::get('/admin/karya', function () {
    return view('admin.karya');
});
Route::get('/admin/kategori', function () {
    return view('admin.kategori');
});
Route::get('/admin/siswa', function () {
    return view('admin.siswa');
});
