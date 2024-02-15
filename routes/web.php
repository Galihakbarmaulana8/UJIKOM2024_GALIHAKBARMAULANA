<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\usersR;
use App\Http\Controllers\loginC;
use App\Http\Controllers\logC;
use App\Http\Controllers\dashboardC;
use App\Http\Controllers\produkR;
use App\Http\Controllers\transaksiR;
use App\Http\Controllers\laporanC;

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
    $subtitle = "Login";
    return view('login', compact('subtitle'));
})->middleware('auth');

Route::resource('dashboard', dashboardC::class)->middleware('auth');

//PDF
Route::get('produk/pdf', [produkR::class, 'pdf'])->middleware('UserAkses:admin');
Route::get('users/pdf', [usersR::class, 'pdf'])->middleware('UserAkses:admin');
Route::get('transaksi/pdf', [transaksiR::class, 'pdf'])->middleware('UserAkses:owner');
Route::get('transaksi/pdf2/{id}',  [transaksiR::class, 'pdf2'])->middleware('UserAkses:owner,kasir');
Route::get('transaksi/tgl/{id}',  [transaksiR::class, 'tgl'])->middleware('UserAkses:owner,kasir');
Route::get('pertanggal/{tgl_awal}/{tgl_akhir}', [transaksiR::class, 'pertanggal'])->name('transaksi.pertanggal');

//Laporan(Transaksi):Owner
Route::get('/laporan/filter', [laporanC::class, 'filter'])->name('laporan.filter');
Route::get('/laporan/export', [laporanC::class, 'export'])->name('laporan.export');
Route::resource('/laporan', laporanC::class)->middleware('UserAkses:owner');
// Route::get('laporan/admin', [laporanC::class, 'index'])->name('laporan.index');

//
Route::resource('/produk', produkR::class)->middleware('UserAkses:admin');

//Transaksi
Route::resource('/transaksi', transaksiR::class)->middleware('UserAkses:admin,kasir');
Route::get('transaksi/create', [transaksiR::class, 'create'])->name('transaksi.create')->middleware('UserAkses:admin,kasir');
Route::get('transaksi/{id}/edit1', [transaksiR::class, 'edit1'])->name('transaksi.edit1')->middleware('UserAkses:admin,kasir');
Route::put('transaksi/{id}/', [transaksiR::class, 'update1'])->name('transaksi.update1');

//Users
Route::resource('/users', usersR::class)->middleware('UserAkses:admin');
Route::get('users/changepassword/{id}', [UsersR::class, 'changepassword'])->name('users.changepassword')->middleware('UserAkses:admin');
Route::put('users/change/{id}', [UsersR::class, 'change'])->name('users.change')->middleware('UserAkses:admin');


//login
Route::get('login', [loginC::class, 'login'])->name('login')->middleware('guest');
Route::post('login', [loginC::class, 'login_action'])->name('login.action')->middleware('guest');

//logout
Route::get('logout', [loginC::class, 'logout'])->name('logout')->middleware('auth');

//Log
Route::get('log', [logC::class, 'index'])->name('log.index')->middleware('UserAkses:owner');
Route::get('dashboard', [dashboardC::class, 'index'])->name('dashboard.index')->middleware('auth');

