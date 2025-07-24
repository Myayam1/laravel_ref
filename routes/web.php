<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\MajorController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LoginController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [HomeController::class, 'index']);
Route::get('/contact', [ContactController::class, 'index']);
Route::get('/students', [StudentController::class, 'index']);
Route::get('/grades', [GradeController::class, 'index']);
Route::get('/majors', [MajorController::class, 'index']);

Route::prefix('admin')->group(function() {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/login', [LoginController::class, 'index']);

    Route::prefix('students')->group(function() {
        Route::get('/', [App\Http\Controllers\Admin\StudentDashboardController::class, 'index'])->name('admin.students.index');
        Route::get('/create', [App\Http\Controllers\Admin\StudentDashboardController::class, 'create']);
        Route::post('/store', [App\Http\Controllers\Admin\StudentDashboardController::class, 'store']);
        Route::get('/edit/{student}', [App\Http\Controllers\Admin\StudentDashboardController::class, 'edit']);
        Route::put('/update/{student}', [App\Http\Controllers\Admin\StudentDashboardController::class, 'update']);
        Route::delete('/delete/{student}', [App\Http\Controllers\Admin\StudentDashboardController::class, 'delete']);
    });

    Route::prefix('grades')->group(function() {
        Route::get('/', [App\Http\Controllers\Admin\GradeDashboardController::class, 'index'])->name('admin.grades.index');
        Route::get('/create', [App\Http\Controllers\Admin\GradeDashboardController::class, 'create']);
        Route::post('/store', [App\Http\Controllers\Admin\GradeDashboardController::class, 'store']);
        Route::get('/edit/{grade}', [App\Http\Controllers\Admin\GradeDashboardController::class, 'edit']);
        Route::put('/update/{grade}', [App\Http\Controllers\Admin\GradeDashboardController::class, 'update']);
        Route::delete('/delete/{grade}', [App\Http\Controllers\Admin\GradeDashboardController::class, 'delete']);
    });

    Route::prefix('majors')->group(function() {
        Route::get('/', [App\Http\Controllers\Admin\MajorDashboardController::class, 'index']);
        Route::get('/create', [App\Http\Controllers\Admin\MajorDashboardController::class, 'create']);
        Route::post('/store', [App\Http\Controllers\Admin\MajorDashboardController::class, 'store']);
        Route::get('/edit/{major}', [App\Http\Controllers\Admin\MajorDashboardController::class, 'edit']);
        Route::put('/update/{major}', [App\Http\Controllers\Admin\MajorDashboardController::class, 'update']);
        Route::delete('/delete/{major}', [App\Http\Controllers\Admin\MajorDashboardController::class, 'delete']);
    });
});
