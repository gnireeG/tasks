<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MailController;
use App\Http\Controllers\OauthController;
use Inertia\Inertia;

Route::get('auth/google', [OauthController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [OauthController::class, 'handleGoogleCallback']);

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::group(['prefix' => 'tasks'], function(){
        Route::get('/', [App\Http\Controllers\TaskController::class, 'index'])->name('tasks');
    });

    Route::group(['prefix' => 'settings'], function(){
        Route::get('/', [App\Http\Controllers\SettingsController::class, 'index'])->name('settings');
    });

    Route::get('/gmail', [App\Http\Controllers\GmailController::class, 'getMails'])->name('gmail');
    Route::get('/mail', [App\Http\Controllers\MailController::class, 'fetchEmails'])->name('mail');
});
