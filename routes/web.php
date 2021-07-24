<?php

use App\Http\Controllers\PemeriksaanController;
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
});

require __DIR__.'/auth.php';
