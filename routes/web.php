<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuestController;

Route::any('/', [GuestController::class, 'interviewAssessment'])->name('interview.assessment');
