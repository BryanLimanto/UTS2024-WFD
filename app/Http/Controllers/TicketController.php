<?php

// app/Http/Controllers/TicketController.php
namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Flight;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Show the form for creating a new ticket
     */
    public function create(Flight $flight)
    {
        return view('tickets.create', [
            'flight' => $flight,
            'availableSeats' => $this->getAvailableSeats($flight)
        ]);
    }

    /**
     * Store a newly created ticket
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'flight_id' => 'required|exists:flights,id',
            'passenger_name' => 'required|string|max:255',
            'passenger_phone' => 'required|string|max:14|regex:/^[0-9]+$/',
            'seat_number' => [
                'required',
                'string',
                'max:3',
                'regex:/^[A-Z][0-9]{2}$/',
                function ($attribute, $value, $fail) use ($request) {
                    $exists = Ticket::where('flight_id', $request->flight_id)
                        ->where('seat_number', $value)
                        ->exists();
                    
                    if ($exists) {
                        $fail('This seat is already taken for this flight.');
                    }
                }
            ],
        ], [
            'seat_number.regex' => 'Seat number must be in format A01 (letter followed by two digits)',
            'passenger_phone.regex' => 'Phone number must contain only numbers'
        ]);

        $ticket = Ticket::create($validated);

        return redirect()
            ->route('flights.tickets', $ticket->flight_id)
            ->with('success', "Ticket for {$ticket->passenger_name} created successfully!");
    }

    /**
     * Get available seats for a flight
     */
    private function getAvailableSeats(Flight $flight): array
    {
        $takenSeats = $flight->tickets->pluck('seat_number')->toArray();
        $allSeats = [];
        
        // Generate all possible seats (A01 to Z99)
        foreach (range('A', 'Z') as $row) {
            foreach (range(1, 99) as $num) {
                $allSeats[] = $row . str_pad($num, 2, '0', STR_PAD_LEFT);
            }
        }
        
        return array_diff($allSeats, $takenSeats);
    }
}