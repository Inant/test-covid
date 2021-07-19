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

Route::get('dashboard', function () {
    return view('dashboard', ['pageTitle' => 'Dashboard', 'pageIcon' => 'tachometer-alt', 'title' => 'Dashboard']);
})->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::resource('user', 'UserController');
    Route::resource('pemeriksaan', 'PemeriksaanController');
    Route::resource('dokter', 'DokterController');
    Route::post('pemeriksaan/tambahpemeriksaan', [PemeriksaanController::class, 'tambahPemeriksaan'])->name('pemeriksaan.tambah.pemeriksaan');
    Route::post('pemeriksaan/tambahdetail', [PemeriksaanController::class, 'tambahDetailPemeriksaan'])->middleware('check.detail')->name('pemeriksaan.tambah.detail');
    Route::delete('pemeriksaan/hapusdetail/{id}', [PemeriksaanController::class, 'hapusDetailPemeriksaan'])->name('pemeriksaan.hapus.detail');
});

require __DIR__.'/auth.php';
