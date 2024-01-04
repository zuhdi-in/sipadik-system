<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JenisSuratController;
use App\Http\Controllers\SuratKeluarController;
use App\Http\Controllers\SuratMasukController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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


Auth::routes(['register' => false]);

Route::middleware(['auth'])->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->middleware('user-access:admin,staff,kepala-sekolah')->name('dashboard');

    Route::prefix('dashboard/user')->group(function () {
        Route::get('/', [UserController::class, 'index'])->middleware('user-access:admin')->name('user.index');
        Route::delete('/{id}', [UserController::class, 'destroy'])->middleware('user-access:admin')->name('user.destroy');
        Route::get('/{id}/edit', [UserController::class, 'edit'])->middleware('user-access:admin,staff,kepala-sekolah')->name('user.edit');;
        Route::put('/{id}', [UserController::class, 'update'])->middleware('user-access:admin,staff,kepala-sekolah')->name('user.update');;
        Route::get('/create', [UserController::class, 'create'])->middleware('user-access:admin')->name('user.create');
        Route::post('/', [UserController::class, 'store'])->middleware('user-access:admin')->name('user.store');
    });

    Route::prefix('dashboard/jenis-surat')->group(function () {
        Route::get('/', [JenisSuratController::class, 'index'])->middleware('user-access:admin')->name('jenis-surat.index');
        Route::delete('/{id}', [JenisSuratController::class, 'destroy'])->middleware('user-access:admin')->name('jenis-surat.destroy');
        Route::get('/{id}/edit', [JenisSuratController::class, 'edit'])->middleware('user-access:admin')->name('jenis-surat.edit');;
        Route::put('/{id}', [JenisSuratController::class, 'update'])->middleware('user-access:admin')->name('jenis-surat.update');;
        Route::get('/create', [JenisSuratController::class, 'create'])->middleware('user-access:admin')->name('jenis-surat.create');
        Route::post('/', [JenisSuratController::class, 'store'])->middleware('user-access:admin')->name('jenis-surat.store');
        
    });

    Route::prefix('dashboard/surat-masuk')->group(function () {
        Route::get('/', [SuratMasukController::class, 'index'])->middleware('user-access:admin,staff,kepala-sekolah')->name('surat-masuk.index');;
        Route::get('/create', [SuratMasukController::class, 'create'])->middleware('user-access:admin,staff');
        Route::post('/', [SuratMasukController::class, 'store'])->middleware('user-access:admin,staff')->name('surat-masuk.store');;
        Route::get('/{id}/edit', [SuratMasukController::class, 'edit'])->middleware('user-access:admin,staff')->name('surat-masuk.edit');;
        Route::put('/{id}', [SuratMasukController::class, 'update'])->middleware('user-access:admin,staff')->name('surat-masuk.update');;
        Route::delete('/{id}', [SuratMasukController::class, 'destroy'])->middleware('user-access:admin,staff')->name('surat-masuk.destroy');;
        Route::get('export-pdf', [SuratMasukController::class, 'exportPDF'])->middleware('user-access:admin,staff,kepala-sekolah')->name('export-pdf');
        Route::get('export-excel', [SuratMasukController::class, 'exportExcel'])->middleware('user-access:admin,staff,kepala-sekolah')->name('export-excel');
        Route::get('unduh/{id}', [SuratMasukController::class, 'downloadFile'])->middleware('user-access:admin,staff,kepala-sekolah');
        Route::get('preview/{id}', [SuratMasukController::class, 'previewFile'])->middleware('user-access:admin,staff,kepala-sekolah')->name('surat-masuk.preview');;
    });

    Route::prefix('dashboard/surat-keluar')->group(function () {
        Route::get('/', [SuratKeluarController::class, 'index'])->middleware('user-access:admin,staff,kepala-sekolah')->name('surat-keluar.index');;
        Route::get('/create', [SuratKeluarController::class, 'create'])->middleware('user-access:admin,staff');
        Route::post('/', [SuratKeluarController::class, 'store'])->middleware('user-access:admin,staff')->name('surat-keluar.store');;
        Route::get('/{id}/edit', [SuratKeluarController::class, 'edit'])->middleware('user-access:admin,staff')->name('surat-keluar.edit');;
        Route::put('/{id}', [SuratKeluarController::class, 'update'])->middleware('user-access:admin,staff')->name('surat-keluar.update');;
        Route::delete('/{id}', [SuratKeluarController::class, 'destroy'])->middleware('user-access:admin,staff')->name('surat-keluar.destroy');;
        Route::get('export-pdf', [SuratKeluarController::class, 'exportPDF'])->middleware('user-access:admin,staff,kepala-sekolah')->name('export-pdf');
        Route::get('export-excel', [SuratKeluarController::class, 'exportExcel'])->middleware('user-access:admin,staff,kepala-sekolah')->name('export-excel');
        Route::get('unduh/{id}', [SuratKeluarController::class, 'downloadFile'])->middleware('user-access:admin,staff,kepala-sekolah');
        Route::get('preview/{id}', [SuratKeluarController::class, 'previewFile'])->middleware('user-access:admin,staff,kepala-sekolah');
    });
});
