<?php

use Illuminate\Support\Facades\Route;

// routes/web.php
use App\Http\Controllers\FlightController;
use App\Http\Controllers\TicketController;

// Flight routes
Route::get('/flights', [FlightController::class, 'index'])->name('flights.index');
Route::get('/flights/{flight}/tickets', [FlightController::class, 'showTickets'])->name('flights.tickets');

// Ticket booking route - corrected definition
Route::get('/flights/{flight}/book', [TicketController::class, 'create'])->name('flights.book');

// Ticket routes
Route::post('/tickets', [TicketController::class, 'store'])->name('tickets.store');
Route::put('/tickets/{ticket}/board', [TicketController::class, 'board'])->name('tickets.board');
Route::delete('/tickets/{ticket}', [TicketController::class, 'destroy'])->name('tickets.destroy');