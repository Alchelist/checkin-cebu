<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\StaffController;
use Illuminate\Support\Facades\Route;

Route::get('/', [EventController::class, 'index'])->name('events.index');
Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');
Route::get('/events/{event}/register', [EventController::class, 'create'])->name('registrations.create');
Route::post('/events/{event}/register', [EventController::class, 'store'])->name('registrations.store');
Route::get('/ticket/{code}', [EventController::class, 'ticket'])->name('tickets.show');
Route::get('/find-ticket', [EventController::class, 'lookupForm'])->name('tickets.lookup');
Route::post('/find-ticket', [EventController::class, 'lookup'])->middleware('throttle:12,1')->name('tickets.lookup.submit');
Route::post('/ticket/{code}/cancel', [EventController::class, 'cancel'])->middleware('throttle:8,1')->name('tickets.cancel');
Route::get('/staff/login', [StaffController::class, 'loginForm'])->name('staff.login');
Route::post('/staff/login', [StaffController::class, 'login'])->name('staff.login.submit');
Route::post('/staff/logout', [StaffController::class, 'logout'])->name('staff.logout');
Route::middleware('staff')->prefix('staff')->name('staff.')->group(function () {
    Route::get('/', [StaffController::class, 'dashboard'])->name('dashboard');
    Route::get('/events/{event}/attendees', [StaffController::class, 'attendees'])->name('attendees');
    Route::get('/events/{event}/check-in', [StaffController::class, 'checkinForm'])->name('checkin');
    Route::post('/events/{event}/check-in', [StaffController::class, 'checkin'])->middleware('throttle:30,1')->name('checkin.submit');
    Route::post('/events/{event}/undo/{registration}', [StaffController::class, 'undoCheckin'])->name('checkin.undo');
    Route::post('/events/{event}/registrations/{registration}/cancel', [StaffController::class, 'cancelRegistration'])->name('registrations.cancel');
    Route::post('/events/{event}/promote', [StaffController::class, 'promote'])->name('registrations.promote');
    Route::get('/events/{event}/export', [StaffController::class, 'export'])->name('attendees.export');
    Route::middleware('organizer')->group(function () {
        Route::get('/events/create', [StaffController::class, 'createEvent'])->name('events.create');
        Route::post('/events', [StaffController::class, 'storeEvent'])->name('events.store');
        Route::get('/events/{event}/edit', [StaffController::class, 'editEvent'])->name('events.edit');
        Route::put('/events/{event}', [StaffController::class, 'updateEvent'])->name('events.update');
    });
});
