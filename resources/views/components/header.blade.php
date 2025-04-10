<!-- resources/views/components/header.blade.php -->
<header class="bg-blue-600 text-white shadow-md">
    <div class="container mx-auto px-4 py-4">
        <div class="flex flex-col md:flex-row justify-between items-center">
            <h1 class="text-2xl font-bold mb-2 md:mb-0">Airplane Booking System</h1>
            <nav class="flex space-x-4">
                <a href="{{ route('flights.index') }}" class="hover:underline px-3 py-1 rounded hover:bg-blue-700 transition">Flights</a>
            </nav>
        </div>
    </div>
</header>