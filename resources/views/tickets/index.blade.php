<!-- resources/views/tickets/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <div class="bg-blue-600 text-white px-6 py-4">
        <h1 class="text-xl font-bold">Ticket Details for {{ $flight->flight_code }}</h1>
        <p class="text-sm">{{ $passengerCount }} passengers • {{ $boardingCount }} boardings</p>
    </div>

    <div class="p-6">
    <div class="mb-6">
        <p class="font-medium">Flight Details:</p>
        <p>{{ $flight->origin }} → {{ $flight->destination }}</p>
        <p>Departure: {{ $flight->departure_time ? $flight->departure_time->format('l, d F Y, H:i') : 'N/A' }}</p>
        <p>Arrival: {{ $flight->arrival_time ? $flight->arrival_time->format('l, d F Y, H:i') : 'N/A' }}</p>
    </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Passenger</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Phone</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Seat</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Boarding</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($tickets as $ticket)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $ticket->passenger_name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $ticket->passenger_phone }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $ticket->seat_number }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($ticket->is_boarding)
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    Boarded at {{ $ticket->boarding_time->format('H:i') }}
                                </span>
                            @else
                                <form action="{{ route('tickets.board', $ticket) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="text-blue-600 hover:text-blue-900">Confirm Boarding</button>
                                </form>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if(!$ticket->is_boarding)
                                <form action="{{ route('tickets.destroy', $ticket) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            <a href="{{ route('flights.index') }}" class="text-blue-600 hover:text-blue-900">← Back to Flights</a>
        </div>
    </div>
</div>
@endsection