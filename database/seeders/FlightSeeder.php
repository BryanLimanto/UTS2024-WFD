<?php

// database/seeders/FlightSeeder.php
namespace Database\Seeders;

use App\Models\Flight;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class FlightSeeder extends Seeder
{
    public function run(): void
    {
        $flights = [
            [
                'flight_code' => 'JT610',
                'origin' => 'SUB',
                'destination' => 'CGK',
                'departure_time' => Carbon::now()->addDays(1),
                'arrival_time' => Carbon::now()->addDays(1)->addHours(1)
            ],
            [
                'flight_code' => 'GA212',
                'origin' => 'SUB',
                'destination' => 'DPS',
                'departure_time' => Carbon::now()->addDays(2),
                'arrival_time' => Carbon::now()->addDays(2)->addHours(1)
            ],
            // Add 3 more flights
        ];

        foreach ($flights as $flight) {
            Flight::create($flight);
        }
    }
}