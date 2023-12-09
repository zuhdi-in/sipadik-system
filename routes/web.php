<?php

use App\Http\Controllers\DashboardController;
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




Auth::routes();
    
Route::middleware(['auth'])->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->middleware('user-access:admin,staff')->name('dashboard');
    Route::prefix('dashboard/surat-masuk')->group(function () {
        Route::get('/', [SuratMasukController::class, 'index'])->middleware('user-access:admin,staff')->name('surat-masuk.index');;
        Route::get('/create', [SuratMasukController::class, 'create'])->middleware('user-access:admin');
        Route::post('/', [SuratMasukController::class, 'store'])->middleware('user-access:admin')->name('surat-masuk.store');;
        Route::get('/{id}/edit', [SuratMasukController::class, 'edit'])->middleware('user-access:admin')->name('surat-masuk.edit');;
        Route::put('/{id}', [SuratMasukController::class, 'update'])->middleware('user-access:admin')->name('surat-masuk.update');;
        Route::delete('/{id}', [SuratMasukController::class, 'destroy'])->middleware('user-access:admin')->name('surat-masuk.destroy');;
        Route::get('export-pdf', [SuratMasukController::class, 'exportPDF'])->middleware('user-access:admin,staff')->name('export-pdf');
        Route::get('export-excel', [SuratMasukController::class, 'exportExcel'])->middleware('user-access:admin,staff')->name('export-excel');
        Route::get('unduh/{id}', [SuratMasukController::class, 'downloadFile'])->middleware('user-access:admin,staff');
        Route::get('preview/{id}', [SuratMasukController::class, 'previewFile'])->middleware('user-access:admin,staff');
    });

    Route::prefix('dashboard/surat-keluar')->group(function () {
        Route::get('/', [SuratKeluarController::class, 'index'])->middleware('user-access:admin,staff')->name('surat-keluar.index');;
        Route::get('/create', [SuratKeluarController::class, 'create'])->middleware('user-access:admin');
        Route::post('/', [SuratKeluarController::class, 'store'])->middleware('user-access:admin')->name('surat-keluar.store');;
        Route::get('/{id}/edit', [SuratKeluarController::class, 'edit'])->middleware('user-access:admin')->name('surat-keluar.edit');;
        Route::put('/{id}', [SuratKeluarController::class, 'update'])->middleware('user-access:admin')->name('surat-keluar.update');;
        Route::delete('/{id}', [SuratKeluarController::class, 'destroy'])->middleware('user-access:admin')->name('surat-keluar.destroy');;
        Route::get('export-pdf', [SuratKeluarController::class, 'exportPDF'])->middleware('user-access:admin,staff')->name('export-pdf');
        Route::get('export-excel', [SuratKeluarController::class, 'exportExcel'])->middleware('user-access:admin,staff')->name('export-excel');
        Route::get('unduh/{id}', [SuratKeluarController::class, 'downloadFile'])->middleware('user-access:admin,staff');
        Route::get('preview/{id}', [SuratKeluarController::class, 'previewFile'])->middleware('user-access:admin,staff');
    });

    Route::get('dashboard/user/{id}/edit', [UserController::class, 'edit'])->middleware('user-access:admin,staff')->name('user.edit');;
    Route::put('dashboard/user/{id}', [UserController::class, 'update'])->middleware('user-access:admin,staff')->name('user.update');;

});
