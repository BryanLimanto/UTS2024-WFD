<!-- resources/views/tickets/create.blade.php -->
@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto bg-white rounded-lg shadow p-6">
    <h2 class="text-xl font-bold mb-4">Book Ticket for {{ $flight->flight_code }}</h2>
    
    <form action="{{ route('tickets.store') }}" method="POST">
        @csrf
        <input type="hidden" name="flight_id" value="{{ $flight->id }}">

        <div class="mb-4">
            <label class="block text-gray-700 mb-2">Passenger Name</label>
            <input type="text" name="passenger_name" class="w-full p-2 border rounded" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 mb-2">Passenger Phone</label>
            <input type="text" name="passenger_phone" class="w-full p-2 border rounded" required maxlength="14">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 mb-2">Seat Number</label>
            <input type="text" name="seat_number" class="w-full p-2 border rounded" required maxlength="3">
        </div>

        <div class="flex justify-end space-x-2">
            <a href="{{ route('flights.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Cancel</a>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Book Ticket</button>
        </div>
    </form>
</div>
@endsection