<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\CourseController;

Route::get('/courses', [CourseController::class, 'index'])->name('courses');
Route::get('/courses/create', [CourseController::class, 'create'])->name('courses.create');
Route::post('/courses', [CourseController::class, 'store'])->name('courses.store');
Route::get('/courses/{course}/pages', [CourseController::class, 'addPages'])->name('courses.pages');
Route::get('/courses/{course}/play', [CourseController::class, 'playCourse'])->name('courses.play');
Route::delete('/courses/{course}', [CourseController::class, 'destroy'])->name('courses.destroy');

// added for course pages
Route::get('/courses/{course}/pages', [CourseController::class, 'addPages'])->name('courses.pages');
Route::post('/courses/{course}/pages', [CourseController::class, 'storePage'])->name('courses.storePage');
Route::delete('/pages/{page}', [CourseController::class, 'destroyPage'])->name('courses.destroyPage');

//for play course 
Route::get('/courses/{course}/play', [CourseController::class, 'playCourse'])->name('courses.play');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
