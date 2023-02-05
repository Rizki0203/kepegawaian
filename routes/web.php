<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\CutiController as AdminCutiController;
use App\Http\Controllers\Admin\KontrakController as AdminKontrakController;
use App\Http\Controllers\Admin\KaryawanController as AdminKaryawanController;
use App\Http\Controllers\Admin\KinerjaController as AdminKinerjaController;
use App\Http\Controllers\Admin\TugasController as AdminTugasController;
use App\Http\Controllers\Admin\DinasController as AdminDinasController;

use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\KontrakController as UserKontrakController;
use App\Http\Controllers\User\TugasController as UserTugasController;
use App\Http\Controllers\User\KinerjaController as UserKinerjaController;
use App\Http\Controllers\User\CutiController as UserCutiController;
use App\Http\Controllers\User\DinasController as UserDinasController;

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

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/', function () {
        return view('auth/login');
    });

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile/{id}', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/password', [ProfileController::class, 'password'])->name('profile.password');
    Route::post('/profile-admin/password/update', [ProfileController::class, 'updatePassword'])->name('profile.password.update');

    // middleware Admin
    Route::prefix('admin')->group(function () {
        Route::name('admin.')->group(function () {
            Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard.index');
            Route::get('dashboard/export', [AdminDashboardController::class, 'exportPDF'])->name('dashboard.export');

            Route::get('cuti/exportlist', [AdminCutiController::class, 'exportPDFList'])->name('cuti.exportlist');
            Route::resource('cuti', AdminCutiController::class);
            Route::put('cuti/approve/{id}', [AdminCutiController::class, 'approve'])->name('cuti.approve');
            Route::get('cuti/reject/{id}', [AdminCutiController::class, 'rejectCuti'])->name('cuti.reject');
            Route::put('cuti/reject/{id}', [AdminCutiController::class, 'rejectUpdateCuti'])->name('cuti.reject.update');
            Route::get('cuti/export/{id}', [AdminCutiController::class, 'exportPDF'])->name('cuti.export');
            Route::get('cuti/{id}/alasan-reject', [AdminCutiController::class, 'alasanReject'])->name('cuti.alasan-reject');

            Route::resource('kontrak', AdminKontrakController::class);
            Route::get('kontrak/export/{id}', [AdminKontrakController::class, 'exportPDF'])->name('kontrak.export');

            Route::resource('users', AdminKaryawanController::class);

            Route::get('kinerja/exportlist', [AdminKinerjaController::class, 'exportPDFList'])->name('kinerja.exportlist');
            Route::resource('kinerja', AdminKinerjaController::class);

            Route::get('tugas/exportlist', [AdminTugasController::class, 'exportPDFList'])->name('tugas.exportlist');
            Route::resource('tugas', AdminTugasController::class);

            Route::get('dinas/exportlist', [AdminDinasController::class, 'exportPDFList'])->name('dinas.exportlist');
            Route::resource('dinas', AdminDinasController::class);
            Route::put('dinas/approve/{id}', [AdminDinasController::class, 'approve'])->name('dinas.approve');
            Route::get('dinas/reject/{id}', [AdminDinasController::class, 'rejectDinas'])->name('dinas.reject');
            Route::put('dinas/reject/{id}', [AdminDinasController::class, 'rejectUpdateDinas'])->name('dinas.reject.update');
            Route::get('dinas/export/{id}', [AdminDinasController::class, 'exportPDF'])->name('dinas.export');
            Route::get('dinas/{id}/alasan-reject', [AdminDinasController::class, 'alasanReject'])->name('dinas.alasan-reject');
        });
    });
    // End middleware Admin

    // middleware User
    Route::prefix('user')->group(function () {
        Route::name('user.')->group(function () {
            Route::get('dashboard', [UserDashboardController::class, 'index'])->name('dashboard.index');
            Route::get('kontrak/export/{id}', [UserKontrakController::class, 'exportPDF'])->name('kontrak.export');
            Route::resource('kontrak', UserKontrakController::class);

            Route::get('tugas/export', [UserTugasController::class, 'exportPDF'])->name('tugas.export');
            Route::resource('tugas', UserTugasController::class);
            Route::put('tugas/selesai/{id}', [UserTugasController::class, 'selesai'])->name('tugas.selesai');

            Route::get('kinerja/export', [UserKinerjaController::class, 'exportPDF'])->name('kinerja.export');
            Route::resource('kinerja', UserKinerjaController::class);
            Route::resource('cuti', UserCutiController::class);
            Route::resource('dinas', UserDinasController::class);
        });
    });
    // End middleware User
});
