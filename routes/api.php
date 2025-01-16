<?php

use App\Http\Controllers\StudentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('students', [StudentController::class, 'index']);
Route::get('student/{id}', [StudentController::class, 'show']);
