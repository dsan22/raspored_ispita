<?php

use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ExamChangeRequestController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\ExaminationPeriodController;
use App\Http\Controllers\ExaminationPeriodNameController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\UserController;
use App\Models\Classroom;
use App\Models\Department;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
})->name("home");

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Routes for Classrooms
Route::prefix('classrooms')->controller(ClassroomController::class)->group(function () {
    Route::get('/', 'index')->name('classrooms.index');
    Route::post('/', 'store')->name('classrooms.store');
    Route::get('create', 'create')->name('classrooms.create');
    Route::get('deleted', 'deleted')->withTrashed()->name('classrooms.deleted');
    Route::patch('{classroom}', 'update')->name('classrooms.update');
    Route::delete('{classroom}', 'destroy')->name('classrooms.destroy');
    Route::delete('{classroom}/delete_permanently', 'deletePermanently')->withTrashed()->name('classrooms.delete_permanently');
    Route::get('{classroom}/edit', 'edit')->name('classrooms.edit');
    Route::patch('{classroom}/restore', 'restore')->withTrashed()->name('classrooms.restore');
});

// Routes for Departments
Route::prefix('departments')->controller(DepartmentController::class)->group(function () {
    Route::get('/', 'index')->name('departments.index');
    Route::post('/', 'store')->name('departments.store');
    Route::get('create', 'create')->name('departments.create');
    Route::get('deleted', 'deleted')->name('departments.deleted');
    Route::patch('{department}', 'update')->name('departments.update');
    Route::delete('{department}', 'destroy')->name('departments.destroy');
    Route::delete('{department}/delete_permanently', 'deletePermanently')->withTrashed()->name('departments.delete_permanently');
    Route::get('{department}/edit', 'edit')->name('departments.edit');
    Route::patch('{department}/restore', 'restore')->withTrashed()->name('departments.restore');
});

// Routes for Exam Change Requests
Route::prefix('exam_change_requests')->controller(ExamChangeRequestController::class)->group(function () {
    Route::get('/', 'index')->name('exam_change_requests.index');
    Route::post('/', 'store')->name('exam_change_requests.store');
    Route::get('open_requests', 'openRequests')->name('exam_change_requests.open_requests');
    Route::patch('{examChangeRequest}/approve', 'approveRequest')->name('exam_change_requests.approve');
    Route::patch('{examChangeRequest}/denie', 'denieRequest')->name('exam_change_requests.denie');
    Route::get('{exam_change_request}', 'show')->name('exam_change_requests.show');
    Route::patch('{exam_change_request}', 'update')->name('exam_change_requests.update');
    Route::delete('{exam_change_request}', 'destroy')->name('exam_change_requests.destroy');
    Route::get('{exam_change_request}/edit', 'edit')->name('exam_change_requests.edit');
});

// Routes for Examination Period Names
Route::prefix('examination_period_names')->controller(ExaminationPeriodNameController::class)->group(function () {
    Route::get('/', 'index')->name('examination_period_names.index');
    Route::post('/', 'store')->name('examination_period_names.store');
    Route::get('create', 'create')->name('examination_period_names.create');
    Route::get('deleted', 'deleted')->withTrashed()->name('examination_period_names.deleted');
    Route::patch('{examination_period_name}/restore', 'restore')->withTrashed()->name("examination_period_names.restore");
    Route::patch('{examination_period_name}', 'update')->name('examination_period_names.update');
    Route::delete('{examination_period_name}', 'destroy')->name('examination_period_names.destroy');
    Route::delete('{examination_period_name}/delete_permanently', 'deletePermanently')->withTrashed()->name('examination_period_names.delete_permanently');
    Route::get('{examination_period_name}/edit', 'edit')->name('examination_period_names.edit');
    
});
// Routes for Examination Periods
Route::prefix('examination_periods')->controller(ExaminationPeriodController::class)->group(function () {
    Route::get('/', 'index')->name('examination_periods.index');
    Route::post('/', 'store')->name('examination_periods.store');
    Route::get('create', 'create')->name('examination_periods.create');
    Route::get('deleted', 'deleted')->name('examination_periods.deleted')->withTrashed();
    Route::delete('{examinationPeriod}/delete_permanently', 'deletePermanently')->withTrashed()->name('examination_periods.delete_permanently');
    Route::patch('{examinationPeriod}/restore', 'restore')->withTrashed()->name('examination_periods.restore');
    Route::get('{examination_period}', 'show')->name('examination_periods.show');
    Route::patch('{examination_period}', 'update')->name('examination_periods.update');
    Route::delete('{examination_period}', 'destroy')->name('examination_periods.destroy');
    Route::get('{examination_period}/edit', 'edit')->name('examination_periods.edit');
    Route::get('{examination_period}/schedule_exams', [ExamController::class, 'scheduleExams'])->name('exams.schedule_exams');
    Route::get('{examinationPeriod}/exams/deleted',[ExamController::class, 'deleted'])->name("exams.deleted");
});

// Routes for Exams
Route::prefix('exams')->controller(ExamController::class)->group(function () {
    Route::post('/', 'store')->name('exams.store');
    Route::patch('{exam}', 'update')->name('exams.update');
    Route::delete('{exam}', 'destroy')->name('exams.destroy');
    Route::delete('{exam}/delete_permanently', 'deletePermanently')->withTrashed()->name('exams.delete_permanently');
    Route::get('{exam}/edit', 'edit')->name('exams.edit');
    Route::patch('{exam}/restore', 'restore')->withTrashed()->name('exams.restore');
    Route::get('{exam}/exam_change_requests/create', [ExamChangeRequestController::class, 'create'])->name('exam_change_requests.create');
});

// Routes for Users
Route::prefix('users')->controller(UserController::class)->group(function () {
    Route::get('/', 'index')->name('users.index');
    Route::post('/', 'store')->name('users.store');
    Route::get('create', 'create')->name('users.create');
    Route::get('deleted', 'deleted')->withTrashed()->name('users.deleted');
    Route::delete('{user}', 'destroy')->name('users.destroy');
    Route::delete('{user}/delete_permanently', 'deletePermanently')->withTrashed()->name('users.delete_permanently');
    Route::patch('{user}/restore', 'restore')->withTrashed()->name('users.restore');
    Route::get('{user}/exams',  [ExamController::class, 'usersExams'])->name("users.exams");
    Route::get('{user}/change_requests', [ExamChangeRequestController::class, 'usersExamChangeRequests'])->name("users.requests");
   

});

// Routes for Subjects
Route::prefix('subjects')->controller(SubjectController::class)->group(function () {
    Route::get('/', 'index')->name('subjects.index');
    Route::post('/', 'store')->name('subjects.store');
    Route::get('create', 'create')->name('subjects.create');
    Route::get('deleted', 'deleted')->withTrashed()->name('subjects.deleted');
    Route::patch('{subject}', 'update')->name('subjects.update');
    Route::delete('{subject}', 'destroy')->name('subjects.destroy');
    Route::delete('{subject}/delete_permanently', 'deletePermanently')->withTrashed()->name('subjects.delete_permanently');
    Route::get('{subject}/edit', 'edit')->name('subjects.edit');
    Route::patch('{subject}/restore', 'restore')->withTrashed()->name('subjects.restore');
});
require __DIR__.'/auth.php';
