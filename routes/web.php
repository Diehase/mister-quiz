<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuizController;
use Illuminate\Support\Facades\Route;

// Home
Route::get('/', fn() => view('home'))->name('home');

// Auth
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Quiz (auth required — handled in controller constructor)
Route::get('/quiz/start', [QuizController::class, 'start'])->name('quiz.start');
Route::get('/quiz/{quizSession}', [QuizController::class, 'show'])->name('quiz.show');
Route::post('/quiz/{quizSession}/submit', [QuizController::class, 'submit'])->name('quiz.submit');
Route::get('/quiz/{quizSession}/results', [QuizController::class, 'results'])->name('quiz.results');

// Profile (auth required — handled in controller constructor)
Route::get('/profile', [ProfileController::class, 'show'])->name('profile');

// Leaderboard
Route::get('/leaderboard', [LeaderboardController::class, 'index'])->name('leaderboard');