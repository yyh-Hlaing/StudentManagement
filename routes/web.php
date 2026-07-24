<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

use App\Http\Controllers\AttendanceController;

Route::get('/', function () { return redirect()->route('students.index'); });

Route::get('/students', [StudentController::class, 'index'])->name('students.index');
Route::get('/students/create', [StudentController::class, 'create'])->name('students.create');
Route::post('/students', [StudentController::class, 'store'])->name('students.store');
Route::get('/students/{id}/edit', [StudentController::class, 'edit'])->name('students.edit');
Route::put('/students/{id}', [StudentController::class, 'update'])->name('students.update');
Route::delete('/students/{id}', [StudentController::class, 'destroy'])->name('students.destroy');
Route::get('/attendance', [AttendanceController::class, 'create'])->name('attendance.create');
Route::post('/attendance', [AttendanceController::class, 'store'])->name('attendance.store');

Route::prefix('students')->name('students.')->group(function () {
    Route::get('/trash', [StudentController::class, 'trash'])->name('trash');
    Route::post('/{id}/restore', [StudentController::class, 'restore'])->name('restore');
    Route::delete('/{id}/force-delete', [StudentController::class, 'forceDelete'])->name('forceDelete');
});

Route::resource('students', StudentController::class);