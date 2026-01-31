<?php

namespace Database\Seeders;

use App\Models\Property;
use App\Models\PropertyImage;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PropertySeeder extends Seeder
{
    public function run()
    {
        // create an admin
        $admin = User::factory()->create(['name' => 'Admin', 'email' => 'admin@example.com', 'password' => Hash::make('password'), 'is_admin' => true]);

        // create some hosts and properties
        $hosts = User::factory(3)->create();

        foreach ($hosts as $host) {
            $p = Property::create([
                'user_id' => $host->id,
                'title' => 'Charming place in '.$host->id,
                'description' => 'Test property description',
                'price_per_night' => rand(40,200),
                'city' => ['Paris','Lyon','Marseille'][array_rand(['Paris','Lyon','Marseille'])],
                'address' => '123 Example St',
            ]);

            PropertyImage::create(['property_id' => $p->id, 'path' => 'images/sample.jpg', 'alt' => $p->title]);
        }

        // create a sample guest with reservations
        $guest = User::factory()->create(['email' => 'guest@example.com']);

        $property = Property::first();

        if ($property) {
            Reservation::create([
                'user_id' => $guest->id,
                'property_id' => $property->id,
                'start_date' => now()->addDays(7)->toDateString(),
                'end_date' => now()->addDays(10)->toDateString(),
                'status' => 'confirmed',
                'payment_status' => 'paid',
                'total_amount' => $property->price_per_night * 3,
            ]);
        }
    }
}
