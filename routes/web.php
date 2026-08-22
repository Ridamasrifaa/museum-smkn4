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
use App\Http\Controllers\Admin\AdminInvitationCodeController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\Admin\AdminManagementController;
use App\Http\Controllers\KaryaController;
use App\Http\Controllers\Siswa\ProfilController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\ArticlePageController;



Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);


Route::get('/', [PublicController::class,'index']);

Route::get('/karya', [KaryaController::class, 'index']);
Route::post('/karya/{project}/like', [KaryaController::class, 'like']);
Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

Route::middleware('auth')->group(function () {
    // dashboard admin
    Route::get('/admin/dashboard', [AdminDashboardController::class,'index']);
    Route::resource('/admin/kode-undangan', AdminInvitationCodeController::class)
    ->parameters(['kode-undangan' => 'kodeUndangan'])
    ->names('admin.kode-undangan');
    // dashboard siswa
    Route::get('/siswa/dashboard', [DashboardController::class, 'index']);
    Route::get('/siswa/karya', [ProjectController::class, 'index']);
    Route::get('/siswa/karya/detail/{project}', [ProjectController::class, 'show']);
    Route::delete('/siswa/karya/{project}', [ProjectController::class, 'destroy']);
    Route::get('/siswa/upload', [ProjectController::class, 'upload']);
    Route::post('/siswa/upload', [ProjectController::class, 'store']);
    Route::get('/siswa/profil', [ProfilController::class, 'index'])->name('siswa.profil');
    Route::get('/siswa/profil/edit', [ProfilController::class, 'edit'])->name('siswa.profil.edit');
    Route::put('/siswa/profil', [ProfilController::class, 'update'])->name('siswa.profil.update');
    // manajemen karya siswa
    Route::get('/admin/karya', [AdminProjectController::class,'index']);
    Route::get('/admin/karya/{project}', [AdminProjectController::class,'show']);
    Route::put('/admin/karya/{project}/update-status', [AdminProjectController::class,'updateStatus']);
    Route::delete('/admin/karya/{project}', [AdminProjectController::class,'destroy']);
    // manajemen siswa
    Route::get('/admin/siswa', [AdminSiswaController::class,'index']);
    Route::put('/admin/siswa/{user}/update', [AdminSiswaController::class,'update']);
    Route::delete('/admin/siswa/{user}', [AdminSiswaController::class, 'destroy']);
    // manajemen kategori
    Route::get('/admin/kategori', [AdminCategoryController::class,'index']);
    Route::post('/admin/kategori/store', [AdminCategoryController::class,'store']);
    Route::put('/admin/kategori/{category}/update', [AdminCategoryController::class,'update']);
    Route::delete('/admin/kategori/{category}', [AdminCategoryController::class,'destroy']);
    // manajemen admin
    Route::get('/admin/manajemen-admin',[AdminManagementController::class,'index']);
    Route::post('/admin/manajemen-admin',[AdminManagementController::class,'store']);
    Route::put('/admin/manajemen-admin/{user}',[AdminManagementController::class,'update']);
    Route::delete('/admin/manajemen-admin/{user}',[AdminManagementController::class,'destroy']);

    // bagian artikel
   
});
Route::get('/admin/artikel', [ArticleController::class,'index']);
Route::resource('admin/articles', ArticleController::class);
Route::get('/auth/kode-undangan', [AuthController::class, 'showKodeUndangan'])->name('auth.kode-undangan');
Route::post('/auth/kode-undangan', [AuthController::class, 'submitKodeUndangan'])->name('auth.kode-undangan.submit');
Route::get('/artikel', [ArticlePageController::class, 'index'])
    ->name('artikel.index');

Route::get('/artikel/{slug}', [ArticlePageController::class, 'show'])
    ->name('artikel.show');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
// ==================== SUPER ADMIN ONLY ====================
// ==================== SUPER ADMIN ====================
Route::middleware(['auth', 'superadmin'])->prefix('superadmin')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\SuperAdmin\DashboardController::class, 'index']);
    
    Route::get('/manajemen-admin', [\App\Http\Controllers\SuperAdmin\AdminManagementController::class, 'index']);
    Route::post('/manajemen-admin', [\App\Http\Controllers\SuperAdmin\AdminManagementController::class, 'store']);
    Route::put('/manajemen-admin/{user}', [\App\Http\Controllers\SuperAdmin\AdminManagementController::class, 'update']);
    Route::delete('/manajemen-admin/{user}', [\App\Http\Controllers\SuperAdmin\AdminManagementController::class, 'destroy']);
});