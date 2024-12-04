<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// routes for teacher
Route::get('/dashboard', [\App\Http\Controllers\DisplayClassesController::class, 'showUserClasses'])->middleware(['auth', 'verified'])->name('dashboard'); // for teacher dashboard
Route::get('/dashboard/classes/create', [\App\Http\Controllers\ClassController::class, 'create'])->name('classes.create');
Route::post('/classes',[\App\Http\Controllers\ClassController::class,'store'])->name('classes.store');

// routes for student
Route::get('/studentDashboard', [\App\Http\Controllers\DisplayClassesController::class, 'showStudentEnrolledClasses'])
    ->middleware(['auth', 'verified'])
    ->name('student.dashboard'); // for student dashboard
Route::get('/studentDashboard/classes/displayClasses', [\App\Http\Controllers\ClassController::class, 'DisplayAllClasses'])->name('classes.DisplayAllClasses');
Route::get('/studentDashboard/classes/enroll/{classid}', [\App\Http\Controllers\ClassController::class, 'enroll'])->name('classes.enroll');

// we are not handling these routes right now
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
