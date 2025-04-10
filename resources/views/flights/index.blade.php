<!-- resources/views/flights/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach ($flights as $flight)
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-bold">{{ $flight->flight_code }} ({{ $flight->origin }} → {{ $flight->destination }})</h2>
            <p class="text-gray-600 mt-2">Departure: {{ $flight->formatted_departure }}</p>
            <p class="text-gray-600">Arrival: {{ $flight->formatted_arrival }}</p>
            
            <div class="mt-4 flex space-x-2">
                <a href="{{ route('flights.book', $flight) }}" 
                   class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                   Book Ticket
                </a>
                <a href="{{ route('flights.tickets', $flight) }}" 
                   class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                   View Tickets
                </a>
            </div>
        </div>
    @endforeach
</div>
@endsection