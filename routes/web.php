<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\AppointmentController;

Route::get('/', function () {
    return redirect()->route('patients.index');
});

// Rotas de recursos para pacientes e compromissos
Route::resource('patients', PatientController::class);
Route::resource('appointments', AppointmentController::class);
Route::get('/patients', [PatientController::class, 'index'])->name('patients.index');


// Rotas adicionais para exportação de CSV e PDF
Route::get('/patients/export/csv', [PatientController::class, 'exportCsv'])->name('patients.export.csv');
Route::get('/patients/export/pdf', [PatientController::class, 'exportPdf'])->name('patients.export.pdf');
