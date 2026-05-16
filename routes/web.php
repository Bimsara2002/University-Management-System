<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentExportController;

use App\Livewire\Student\Table as StudentTable;
use App\Livewire\Student\Create as StudentCreate;
use App\Livewire\Student\Show as StudentShow;
use App\Livewire\Student\Edit as StudentEdit;

use App\Livewire\Course\Table as CourseTable;
use App\Livewire\Course\Create as CourseCreate;
use App\Livewire\Course\Edit as CourseEdit;
use App\Livewire\Course\Show as CourseShow;

use App\Livewire\Instructor\Table as InstructorTable;
use App\Livewire\Instructor\Create as InstructorCreate;
use App\Livewire\Instructor\Edit as InstructorEdit;

use App\Livewire\Enrollment\Table as EnrollmentTable;
use App\Livewire\Enrollment\Create as EnrollmentCreate;

use App\Livewire\Attendance\Table as AttendanceTable;
use App\Livewire\Attendance\Create as AttendanceCreate;

use App\Livewire\Payment\Table as PaymentTable;
use App\Livewire\Payment\Create as PaymentCreate;

use App\Livewire\Result\Table as ResultTable;
use App\Livewire\Result\Create as ResultCreate;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Student Routes
    Route::get('/students', StudentTable::class)->name('students.index');
    Route::get('/students/create', StudentCreate::class)->name('students.create');
    Route::get('/students/{id}', StudentShow::class)->name('students.show');
    Route::get('/students/{id}/edit', StudentEdit::class)->name('students.edit');
    Route::get('/export-students', [StudentExportController::class, 'export'])->middleware(['auth'])->name('students.export');

    // Courses Route
    Route::get('/courses', CourseTable::class)->name('courses.index');
    Route::get('/courses/create', CourseCreate::class)->name('courses.create');
    Route::get('/courses/{id}/edit', CourseEdit::class)->name('courses.edit');
    Route::get('/courses/{id}', CourseShow::class)->name('courses.show');
    
    // Instructors Route
    Route::get('/instructors', InstructorTable::class)->name('instructors.index');
    Route::get('/instructors/create', InstructorCreate::class)->name('instructors.create');
    Route::get('/instructors/{id}/edit', InstructorEdit::class)->name('instructors.edit');

    // Enrollments
    Route::get('/enrollments', EnrollmentTable::class)->name('enrollments.index');
    Route::get('/enrollments/create', EnrollmentCreate::class)->name('enrollments.create');
    Route::get('/enrollments/{id}/edit', \App\Livewire\Enrollment\Edit::class)->name('enrollments.edit');

    // Attendance
    Route::get('/attendances', AttendanceTable::class)->name('attendances.index');
    Route::get('/attendances/create', AttendanceCreate::class)->name('attendances.create');
    Route::get('/attendances/{id}/edit', \App\Livewire\Attendance\Edit::class)->name('attendances.edit');

    // Payments
    Route::get('/payments', PaymentTable::class)->name('payments.index');
    Route::get('/payments/create', PaymentCreate::class)->name('payments.create');
    Route::get('/payments/{id}/edit', \App\Livewire\Payment\Edit::class)->name('payments.edit');

    // Results (Grades)
    Route::get('/results', ResultTable::class)->name('results.index');
    Route::get('/results/create', ResultCreate::class)->name('results.create');
    Route::get('/results/{id}/edit', \App\Livewire\Result\Edit::class)->name('results.edit');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';