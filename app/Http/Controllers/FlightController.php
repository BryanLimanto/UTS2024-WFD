<?php

// app/Http/Controllers/FlightController.php
namespace App\Http\Controllers;

use App\Models\Flight;

class FlightController extends Controller
{
    public function index()
    {
        $flights = Flight::all()->map(function ($flight) {
            $flight->formatted_departure = \Carbon\Carbon::parse($flight->departure_time)
                ->format('l, d F Y, H:i');
            $flight->formatted_arrival = \Carbon\Carbon::parse($flight->arrival_time)
                ->format('l, d F Y, H:i');
            return $flight;
        });
        
        return view('flights.index', compact('flights'));
    }

    public function showTickets(Flight $flight)
    {
        // Ensure dates are Carbon instances
        $flight->departure_time = \Carbon\Carbon::parse($flight->departure_time);
        $flight->arrival_time = \Carbon\Carbon::parse($flight->arrival_time);
    
        $tickets = $flight->tickets()
            ->orderBy('is_boarding', 'desc')
            ->orderBy('created_at', 'asc')
            ->get();
    
        return view('tickets.index', [
            'flight' => $flight,
            'tickets' => $tickets,
            'passengerCount' => $tickets->count(),
            'boardingCount' => $tickets->where('is_boarding', true)->count()
        ]);
    }

    public function showBookingForm(Flight $flight)
    {
        return view('tickets.create', compact('flight'));
    }
}