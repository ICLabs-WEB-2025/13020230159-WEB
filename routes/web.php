<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AttendanceScanController;
use App\Http\Controllers\AttendanceExportController;


Route::get('/', function () {
    return redirect('admin/login');
});

Route::get('/presensi/scan/{token}', [AttendanceScanController::class, 'scanForm'])->name('presensi.scan');
Route::post('/presensi/submit', [AttendanceScanController::class, 'submit'])->name('presensi.submit');

// routes/web.php
// routes/web.php
Route::get('attendances/export', [AttendanceExportController::class, 'export'])->name('attendances.export');
// Route::get('/presensi/scan', [PresensiQrController::class, 'showScan'])->name('presensi.qr.scan');
// Route::post('/presensi/submit', [PresensiQrController::class, 'submit'])->name('presensi.qr.submit');

Route::get('/dashboard/export-excel', [AttendanceExportController::class, 'exportExcel'])->name('dashboard.export-excel');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


