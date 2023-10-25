<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

use App\Models\User;

use Carbon\Carbon;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $data['allData'] = User::all();
    return view('dashboard', $data);
})->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Student
    Route::get('/student/add', [StudentController::class, 'StudentAdd'])->name('student.add');
    Route::post('/student/store', [StudentController::class, 'StudentStore'])->name('student.store');
    Route::get('student/edit/{id}', [StudentController::class, 'StudentEdit'])->name('student.edit');
    Route::post('student/update/{id}', [StudentController::class, 'StudentUpdate'])->name('student.update');
    Route::get('student/delete/{id}', [StudentController::class, 'StudentDelete'])->name('student.delete');

    // Generate PDF
    Route::get('/generate-pdf/{id}', [StudentController::class, 'GeneratePDF'])->name('generate.pdf');
});

Route::get('/student/logout', [StudentController::class, 'Logout'])->name('student.logout');

require __DIR__ . '/auth.php';
