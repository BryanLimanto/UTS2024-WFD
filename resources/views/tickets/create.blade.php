<!-- resources/views/tickets/create.blade.php -->
<!-- resources/views/tickets/create.blade.php -->
@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto bg-white rounded-lg shadow-md overflow-hidden">
    <div class="bg-blue-600 text-white px-6 py-4">
        <h1 class="text-xl font-bold">Book Ticket for {{ $flight->flight_code }}</h1>
        <p class="text-sm">{{ $flight->origin }} → {{ $flight->destination }}</p>
    </div>
    
    <div class="p-6">
        <div class="mb-4">
            <p class="font-medium">Flight Details:</p>
            <p>Departure: {{ optional($flight->departure_time)->format('l, d F Y, H:i') ?? 'N/A' }}</p>
            <p>Arrival: {{ optional($flight->arrival_time)->format('l, d F Y, H:i') ?? 'N/A' }}</p>
        </div>

        <!-- Rest of your form remains the same -->
        <form action="{{ route('tickets.store') }}" method="POST">
            @csrf
            <input type="hidden" name="flight_id" value="{{ $flight->id }}">

            <div class="mb-4">
                <label for="passenger_name" class="block text-gray-700 font-medium mb-2">Passenger Name</label>
                <input type="text" name="passenger_name" id="passenger_name" 
                       class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                       required autofocus>
                @error('passenger_name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="passenger_phone" class="block text-gray-700 font-medium mb-2">Passenger Phone</label>
                <input type="text" name="passenger_phone" id="passenger_phone" 
                       class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                       required placeholder="081234567890">
                @error('passenger_phone')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="seat_number" class="block text-gray-700 font-medium mb-2">Seat Number</label>
                <select name="seat_number" id="seat_number" 
                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="">Select a seat</option>
                    @foreach($availableSeats as $seat)
                        <option value="{{ $seat }}">{{ $seat }}</option>
                    @endforeach
                </select>
                @error('seat_number')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ route('flights.index') }}" 
                   class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition">
                   Cancel
                </a>
                <button type="submit" 
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                    Book Ticket
                </button>
            </div>
        </form>
    </div>
</div>
@endsection