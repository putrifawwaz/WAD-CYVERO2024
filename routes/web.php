<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubEventController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\ParticipantsController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\NewsController;

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/email/verify', [VerificationController::class, 'show'])->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');
    Route::post('/email/verification-notification', [VerificationController::class, 'send'])->name('verification.send');
});

Route::middleware(['auth'])->group(function ()
{
    Route::resource('subevents', SubEventController::class);
    Route::get('/subevents/{id}/rules', [SubEventController::class, 'downloadRules'])->name('subevents.rules');
});

Route::post('/subevents', [SubEventController::class, 'store'])->name('subevents.store');

Route::get('subevents/{id}/register', [RegistrationController::class, 'register'])->name('registrations.register');
Route::post('/registration/{id}/register', [RegistrationController::class, 'storeRegistration'])->name('registrations.storeRegistration');
Route::get('/registrations/proof/{id}', [RegistrationController::class, 'showProof'])->name('registrations.proof');

Route::middleware(['auth'])->group(function () {
    Route::get('/participants', [ParticipantsController::class, 'index'])->name('participants.index');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('schedules', ScheduleController::class);
});
Route::resource('documents', DocumentController::class);

Route::resource('news', NewsController::class);
