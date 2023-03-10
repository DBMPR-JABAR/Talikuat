<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CurvaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataUmumController;
use App\Http\Controllers\DataUtamaController;
use App\Http\Controllers\JadualController;
use App\Http\Controllers\LaporanBulananKonsultanController;
use App\Http\Controllers\LaporanBulananUptd;
use App\Http\Controllers\LaporanBulananUptdController;
use App\Http\Controllers\LaporanKeuangan;
use App\Http\Controllers\LaporanMingguanController;
use App\Http\Controllers\LaporanKonsultan;
use App\Http\Controllers\ProgressController;
use App\Http\Controllers\UserManajemen;

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


Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');

Route::middleware(['auth'])->group(function () {
    Route::post('/user-manajement/set-role', [UserManajemen::class, 'setRole'])->name('user-manajement.set-role');
    Route::get('/user-manajement/set-role', [UserManajemen::class, 'pageSetRole'])->name('user-manajement.set-role-page');
});

Route::middleware(['auth', 'userVerified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::resource('/user-manajement', UserManajemen::class);
    Route::post('/user-manajement/create-admin-uptd', [UserManajemen::class, 'createAdminUptd'])->name('user-manajement.create-admin-uptd');
    Route::post('/user-manajement/update-admin-uptd/{id}', [UserManajemen::class, 'updateAdminUptd'])->name('user-manajement.update-admin-uptd');
    Route::post('/user-manajement/create-admin-konsultan', [UserManajemen::class, 'createUserKonsultan'])->name('user-manajement.create-admin-konsultan');
    Route::post('/user-manajement/update-admin-konsultan/{id}', [UserManajemen::class, 'updateUserKonsultan'])->name('user-manajement.update-admin-konsultan');
    Route::get('/user-manajement/delete-admin-konsultan/{id}', [UserManajemen::class, 'deleteUserKonsultan'])->name('user-manajement.delete-admin-konsultan');
    Route::post('/user-manajement/create-admin-ppk', [UserManajemen::class, 'createUserPpk'])->name('user-manajement.create-admin-ppk');
    Route::post('/user-manajement/update-admin-ppk/{id}', [UserManajemen::class, 'updateUserPpk'])->name('user-manajement.update-admin-ppk');



    Route::resource('data-utama', DataUtamaController::class);
    Route::post('/data-utama/edit-nmp/{id}', [DataUtamaController::class, 'editNmp'])->name('data-utama.edit-nmp');
    Route::get('/data-utama/delete-nmp/{id}', [DataUtamaController::class, 'deleteNmp'])->name('data-utama.delete-nmp');
    Route::post('/data-utama/create-nmp', [DataUtamaController::class, 'createNmp'])->name('data-utama.create-nmp');
    Route::post('/data-utama/edit-kontraktor/{id}', [DataUtamaController::class, 'editKontraktor'])->name('data-utama.edit-kontraktor');
    Route::get('/data-utama/delete-kontraktor/{id}', [DataUtamaController::class, 'deleteKontraktor'])->name('data-utama.delete-kontraktor');
    Route::post('/data-utama/create-kontraktor', [DataUtamaController::class, 'createKontraktor'])->name('data-utama.create-kontraktor');
    Route::post('/data-utama/edit-konsultan/{id}', [DataUtamaController::class, 'editKonsultan'])->name('data-utama.edit-konsultan');
    Route::get('/data-utama/delete-konsultan/{id}', [DataUtamaController::class, 'deleteKonsultan'])->name('data-utama.delete-konsultan');
    Route::post('/data-utama/create-konsultan', [DataUtamaController::class, 'createKonsultan'])->name('data-utama.create-konsultan');

    Route::resource('data-umum', DataUmumController::class);
    Route::get('data-umum/upload/{id}', [DataUmumController::class, 'fileUpload'])->name('upload.dataumum');
    Route::post('/store_file/{id}', [DataUmumController::class, 'store_file'])->name('store.file.dataumum');
    Route::get('/file/{id}/{file}', [DataUmumController::class, 'show_file'])->name('show.file.dataumum');
    Route::put('/adendum/create/{id}', [DataUmumController::class, 'createAdendum'])->name('adendum.create');

    Route::get('/jadual', [JadualController::class, 'index'])->name('jadual.index');
    Route::get('/jadual/create/{id}}', [JadualController::class, 'create'])->name('jadual.create');
    Route::post('/jadual/store/{id}', [JadualController::class, 'store'])->name('jadual.store');
    Route::get('/jadual/edit/{id}', [JadualController::class, 'edit'])->name('jadual.edit');
    Route::put('/jadual/update/{id}', [JadualController::class, 'update'])->name('jadual.update');
    Route::get('/jadual/show/{id}', [JadualController::class, 'show'])->name('jadual.show');
    Route::post('/exceltodata', [JadualController::class, 'exceltodata'])->name('jadual.exceltodata');

    Route::get('/laporan-mingguan-uptd', [LaporanMingguanController::class, 'index'])->name('laporan-mingguan-uptd.index');
    Route::get('/laporan-mingguan-uptd/create/{id}', [LaporanMingguanController::class, 'create'])->name('laporan-mingguan-uptd.create');
    Route::post('/laporan-mingguan-uptd/store/{id}', [LaporanMingguanController::class, 'store'])->name('laporan-mingguan-uptd.store');
    Route::post('/laporan-mingguan-uptd/approval/{id}', [LaporanMingguanController::class, 'approval'])->name('laporan-mingguan-uptd.approval');
    Route::get('/laporan-mingguan-uptd/edit/{id}', [LaporanMingguanController::class, 'edit'])->name('laporan-mingguan-uptd.edit');
    Route::put('/laporan-mingguan-uptd/update/{id}', [LaporanMingguanController::class, 'update'])->name('laporan-mingguan-uptd.update');

    Route::get('/laporan-bulanan-uptd', [LaporanBulananUptdController::class, 'index'])->name('laporan-bulanan-uptd.index');
    Route::get('/laporan-bulanan-uptd/create/{id}', [LaporanBulananUptdController::class, 'create'])->name('laporan-bulanan-uptd.create');
    Route::post('/laporan-bulanan-uptd/store/{id}', [LaporanBulananUptdController::class, 'store'])->name('laporan-bulanan-uptd.store');
    Route::post('/laporan-bulanan-uptd/approval/{id}', [LaporanBulananUptdController::class, 'approval'])->name('laporan-bulanan-uptd.approval');
    Route::get('/laporan-bulanan-uptd/edit/{id}', [LaporanBulananUptdController::class, 'edit'])->name('laporan-bulanan-uptd.edit');
    Route::put('/laporan-bulanan-uptd/update/{id}', [LaporanBulananUptdController::class, 'update'])->name('laporan-bulanan-uptd.update');

    Route::get('/laporan-mingguan-konsultan', [LaporanKonsultan::class, 'index'])->name('laporan-mingguan-konsultan.index');
    Route::get('/laporan-mingguan-konsultan/create/{id}', [LaporanKonsultan::class, 'create'])->name('laporan-mingguan-konsultan.create');
    Route::post('/laporan-mingguan-konsultan/store/{id}', [LaporanKonsultan::class, 'store'])->name('laporan-mingguan-konsultan.store');

    Route::get('/laporan-bulanan-konsultan', [LaporanBulananKonsultanController::class, 'index'])->name('laporan-bulanan-konsultan.index');
    Route::get('/laporan-bulanan-konsultan/create/{id}', [LaporanBulananKonsultanController::class, 'create'])->name('laporan-bulanan-konsultan.create');
    Route::post('/laporan-bulanan-konsultan/store/{id}', [LaporanBulananKonsultanController::class, 'store'])->name('laporan-bulanan-konsultan.store');

    Route::get('laporan-keuangan}', [LaporanKeuangan::class, 'index'])->name('laporan-keuangan.index');
    Route::get('laporan-keuangan-create/{id}', [LaporanKeuangan::class, 'create'])->name('laporan-keuangan.create');

    Route::get('/progress-fisik', [ProgressController::class, 'index'])->name('progress-fisik.index');

    Route::get('/curva-s/{id}', [CurvaController::class, 'index'])->name('curva-s.index');
});
