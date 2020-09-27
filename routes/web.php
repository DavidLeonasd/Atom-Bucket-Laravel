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
    return redirect('/dompet');
});


Route::get('/dompet/{id}/changestatus/{isactive?}', 'dompetController@updateStatus');
Route::resource('/dompet', 'dompetController');
Route::get('/kategori/{id}/changestatus/{isactive?}', 'kategoriController@updateStatus');
Route::resource('/kategori', 'kategoriController');
Route::pattern('inout', '^(masuk|keluar)$');
Route::resource('/transaksi/{inout}/a', 'transaksiController');

Route::get('/laporan/transaksi', 'laporanController@formLaporanTransaksi');
Route::post('/laporan/transaksi/output', 'laporanController@generateLaporanTransaksi');
// Route::get('/transaksi/keluar', function () {
//     return 'keluar';
// });

