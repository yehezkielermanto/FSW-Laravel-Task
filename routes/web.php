<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\mahasiswaController;
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

Route::get('/', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout']);

Route::group(['middleware' => ['role:admin']], function () {
    // dashboard admin
    Route::get('/admin', [AdminController::class, 'index']);

    // mahasiswa
    Route::get('/admin/mahasiswa', [AdminController::class, 'mahasiswa']);
    Route::post('/admin/tambah_mahasiswa', [
        AdminController::class,
        'tambah_mahasiswa',
    ]);

    Route::post('/admin/edit_mahasiswa/{id}', [
        AdminController::class,
        'edit_mahasiswa',
    ]);

    Route::get('/admin/delete_mahasiswa/{id}', [
        AdminController::class,
        'delete_mahasiswa',
    ]);

    // matkul
    Route::get('/admin/matakuliah', [AdminController::class, 'matakuliah']);
    Route::post('/admin/tambah_matkul', [AdminController::class, 'add_matkul']);
    Route::post('/admin/edit_matkul/{id}', [
        AdminController::class,
        'edit_matkul',
    ]);
    Route::get('/admin/delete_matkul/{id}', [
        AdminController::class,
        'delete_matkul',
    ]);

    // jadwal
    Route::get('/admin/jadwal', [AdminController::class, 'jadwal']);
    Route::post('/admin/tambah_jadwal', [AdminController::class, 'add_jadwal']);
    Route::post('/admin/edit_jadwal/{id}', [
        AdminController::class,
        'edit_jadwal',
    ]);
    Route::get('/admin/delete_jadwal/{id}', [
        AdminController::class,
        'delete_jadwal',
    ]);
    Route::get('/admin/cetak/{id}', [AdminController::class, 'cetak']);
    Route::get('/admin/print', [AdminController::class, 'printJadwal']);
});

Route::group(['middleware' => ['role:mahasiswa']], function () {
    // mahasiswa
    Route::get('/mahasiswa', [mahasiswaController::class, 'index']);
});
