<?php

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
    return view('login');
})->name('login');

Route::post('/postlogin','\App\Http\Controllers\LoginController@postlogin')->name('postlogin');
Route::get('/logout','\App\Http\Controllers\LoginController@logout')->name('logout');

Route::group(['middleware' => ['auth','cekrole:Admin']],function(){
    Route::get('/dashboard/admin','\App\Http\Controllers\AdminController@index')->name('dashboard.admin');
    Route::get('/pegawai/admin','\App\Http\Controllers\AdminController@pegawai')->name('pegawai.admin');
    Route::get('/tambahpegawai/admin', '\App\Http\Controllers\AdminController@tambahpegawai')->name('tambahpegawai');
    Route::get('/detailpegawai/admin/{id}', '\App\Http\Controllers\AdminController@detailpegawai')->name('detailpegawai');
    Route::post('/simpanpegawai', '\App\Http\Controllers\AdminController@simpanpegawai')->name('simpanpegawai');
    Route::get('/hapuspegawai/{id}', '\App\Http\Controllers\AdminController@hapuspegawai')->name('hapuspegawai');
    Route::get('/jabatan/admin','\App\Http\Controllers\AdminController@jabatan')->name('jabatan.admin');
    Route::post('/simpanjabatan', '\App\Http\Controllers\AdminController@simpanjabatan')->name('simpanjabatan');
    Route::post('/updatejabatan/{id}', '\App\Http\Controllers\AdminController@updatejabatan')->name('update.jabatan');
    Route::get('/hapusjabatan/{id}', '\App\Http\Controllers\AdminController@hapusjabatan')->name('hapus.jabatan');
    Route::get('/absensi/admin','\App\Http\Controllers\AdminController@absensi')->name('absensi.admin');
    Route::get('/cuti/admin','\App\Http\Controllers\AdminController@cuti')->name('cuti.admin');
    Route::post('/updatecuti/{id}', '\App\Http\Controllers\AdminController@updatestatuscuti')->name('cuti.validasi');
    Route::get('/payroll/admin','\App\Http\Controllers\AdminController@payroll')->name('payroll.admin');
    Route::get('/tambahpayroll/admin','\App\Http\Controllers\AdminController@tambahpayroll')->name('tambahpayroll');
    Route::get('/autocomplete', '\App\Http\Controllers\AdminController@autocomplete')->name('autocomplete');
    Route::post('/simpanpayroll', '\App\Http\Controllers\AdminController@simpanpayroll')->name('simpanpayroll');
    Route::get('/slippayroll/admin/{id}','\App\Http\Controllers\AdminController@slippayroll')->name('slippayroll');
    Route::get('/laporanabsen/admin','\App\Http\Controllers\AdminController@laporanabsen')->name('laporanabsen');
    Route::get('/laporancuti/admin','\App\Http\Controllers\AdminController@laporancuti')->name('laporancuti');
    Route::get('/laporangaji/admin','\App\Http\Controllers\AdminController@laporangaji')->name('laporangaji');

});

Route::group(['middleware' => ['auth','cekrole:Pegawai']],function(){
    Route::get('/dashboard/karyawan','\App\Http\Controllers\KaryawanController@index')->name('dashboard.karyawan');
    Route::post('/absen', '\App\Http\Controllers\KaryawanController@absen')->name('absen');
    Route::get('/daftarabsen/karyawan', '\App\Http\Controllers\KaryawanController@daftarabsen')->name('daftarabsen.karyawan');
    Route::get('/daftarcuti/karyawan', '\App\Http\Controllers\KaryawanController@daftarcuti')->name('daftarcuti.karyawan');
    Route::post('/simpancuti', '\App\Http\Controllers\KaryawanController@simpancuti')->name('simpancuti');
    Route::get('/daftarpayroll/karyawan', '\App\Http\Controllers\KaryawanController@daftarpayroll')->name('daftarpayroll.karyawan');

});