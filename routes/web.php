<?php

use App\Http\Controllers\PemeriksaanController;
use App\Http\Controllers\PemeriksaanPcrController;
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
    return view('auth.login');
});
Route::get('pemeriksaan/hasil-pemeriksaan/{id}', 'PemeriksaanController@showHasil')->name('pemeriksaan.hasil');
Route::get('pemeriksaan-pcr/hasil-pemeriksaan/{id}', 'PemeriksaanPcrController@showHasil')->name('pemeriksaan-pcr.hasil');
Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', function () {
        return view('dashboard', ['pageTitle' => 'Dashboard', 'pageIcon' => 'tachometer-alt', 'title' => 'Dashboard']);
    })->name('dashboard');
    Route::resource('user', 'UserController');
    Route::resource('pemeriksaan', 'PemeriksaanController');
    Route::resource('dokter', 'DokterController');
    Route::resource('jenis-pemeriksaan', 'JenisPemeriksaanController');
    Route::get('pemeriksaan/print/{id}', 'PemeriksaanController@print')->name('pemeriksaan.print');

    Route::post('pemeriksaan/tambahpemeriksaan', [PemeriksaanController::class, 'tambahPemeriksaan'])->name('pemeriksaan.tambah.pemeriksaan');
    Route::post('pemeriksaan/tambahdetail', [PemeriksaanController::class, 'tambahDetailPemeriksaan'])->middleware('check.detail')->name('pemeriksaan.tambah.detail');
    Route::post('pemeriksaan/store/detail/{id_pemeriksaan}', [PemeriksaanController::class, 'storeDetail'])->name('pemeriksaan.store.detail');
    Route::delete('pemeriksaan/hapusdetail/{id}', [PemeriksaanController::class, 'hapusDetailPemeriksaan'])->name('pemeriksaan.hapus.detail');
    Route::delete('pemeriksaan/destroy/detail/{detail}/{id_pemeriksaan}', [PemeriksaanController::class, 'destroyDetailPemeriksaan'])->name('pemeriksaan.detail.destroy');
    // pcr
    Route::resource('pemeriksaan-pcr', 'PemeriksaanPcrController');
    Route::resource('jenis-pemeriksaan-pcr', 'JenisPemeriksaanPcrController');
    Route::get('pemeriksaan-pcr/print/{id}', 'PemeriksaanPcrController@print')->name('pemeriksaan-pcr.print');
    
    Route::post('pemeriksaan-pcr/tambahpemeriksaan', [PemeriksaanPcrController::class, 'tambahPemeriksaan'])->name('pemeriksaan-pcr.tambah.pemeriksaan');
    
    Route::post('pemeriksaan-pcr/tambahdetail', [PemeriksaanPcrController::class, 'tambahDetailPemeriksaan'])->middleware('check.detail')->name('pemeriksaan-pcr.tambah.detail');
    
    Route::post('pemeriksaan-pcr/store/detail/{id_pemeriksaan}', [PemeriksaanPcrController::class, 'storeDetail'])->name('pemeriksaan-pcr.store.detail');
    
    Route::delete('pemeriksaan-pcr/hapusdetail/{id}', [PemeriksaanPcrController::class, 'hapusDetailPemeriksaan'])->name('pemeriksaan-pcr.hapus.detail');
    
    Route::delete('pemeriksaan-pcr/destroy/detail/{detail}/{id_pemeriksaan}', [PemeriksaanPcrController::class, 'destroyDetailPemeriksaan'])->name('pemeriksaan-pcr.detail.destroy');
});

require __DIR__.'/auth.php';
