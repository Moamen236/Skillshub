<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\web\CatController;
use App\Http\Controllers\web\ExamController;
use App\Http\Controllers\web\HomeController;
use App\Http\Controllers\web\LangController;
use App\Http\Controllers\web\SkillController;
use App\Http\Controllers\Admin\ExamsController;
use App\Http\Controllers\web\ProfileController;
use App\Http\Controllers\admin\CatController as AdminCatController;
use App\Http\Controllers\admin\HomeController as AdminHomeController;
use App\Http\Controllers\admin\SkillController as AdminSkillController;

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
// web

Route::middleware('lang')->group(function () {
    Route::get('/', [HomeController::class, 'index']);
    Route::get('/categories/show/{id}', [CatController::class, 'show']);
    Route::get('/skills/show/{id}', [SkillController::class, 'show']);
    Route::get('/exams/show/{id}', [ExamController::class, 'show']);
    Route::get('/exams/questions/{id}', [ExamController::class, 'questions'])->middleware(['auth', 'verified', 'student']);
    Route::get('/contact', [ContactController::class, 'index']);
    Route::get('/profile', [ProfileController::class, 'index'])->middleware(['auth', 'verified',  'student']);
});

Route::post('/exams/start/{id}', [ExamController::class, 'start'])->middleware(['auth', 'verified', 'student', 'can_enter_exam']);
Route::post('/exams/submit/{id}', [ExamController::class, 'submit'])->middleware(['auth', 'verified', 'student']);

Route::post('/contact/message/send', [ContactController::class, 'send']);
Route::get('/lang/set/{lang}', [LangController::class, 'set']);

//admin
Route::prefix('dashboard')->middleware(['auth', 'verified', 'can_enetr_dashboard'])->group(function () {
    Route::get('/', [AdminHomeController::class, 'index']);
    Route::get('/categories', [AdminCatController::class, 'index']);
    Route::post('/categories/store', [AdminCatController::class, 'store']);
    Route::post('/categories/update', [AdminCatController::class, 'update']);
    Route::get('/categories/delete/{cat}', [AdminCatController::class, 'delete']);
    Route::get('/categories/toggle/{cat}', [AdminCatController::class, 'toggle']);

    Route::get('/skills', [AdminSkillController::class, 'index']);
    Route::post('/skills/store', [AdminSkillController::class, 'store']);
    Route::post('/skills/update', [AdminSkillController::class, 'update']);
    Route::get('/skills/delete/{skill}', [AdminSkillController::class, 'delete']);
    Route::get('/skills/toggle/{skill}', [AdminSkillController::class, 'toggle']);

    Route::get('/exams', [ExamsController::class, 'index']);
    Route::get('/exams/show/{exam}', [ExamsController::class, 'show']);
    Route::get('/exams/show/{exam}/questions', [ExamsController::class, 'questions']);
    Route::get('/exams/create', [ExamsController::class, 'create']);
    Route::get('/exams/create-questions/{exam}', [ExamsController::class, 'createQuestions']);
    Route::post('/exams/store', [ExamsController::class, 'store']);
    Route::post('/exams/create-questions/{exam}', [ExamsController::class, 'storeQuestions']);
    Route::get('/exams/edit/{exam}', [ExamsController::class, 'edit']);
    Route::post('/exams/update/{exam}', [ExamsController::class, 'update']);
    Route::get('/exams/edit/{exam}/question/{question}', [ExamsController::class, 'editQuestion']);
    Route::post('/exams/update/question/{question}', [ExamsController::class, 'updateQuestion']);
    Route::get('/exams/delete/{exam}', [ExamsController::class, 'destroy']);
    Route::get('/exams/toggle/{exam}', [ExamsController::class, 'toggle']);
});