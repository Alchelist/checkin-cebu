<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Registration;
use App\Models\StaffUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use RuntimeException;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $doorStaffPassword = config('checkin.demo_doorstaff_password');
        $organizerPassword = config('checkin.demo_organizer_password');

        if (!$doorStaffPassword || !$organizerPassword) {
            throw new RuntimeException(
                'Set DEMO_DOORSTAFF_PASSWORD and DEMO_ORGANIZER_PASSWORD before seeding.'
            );
        }

        StaffUser::updateOrCreate(
            ['username' => 'doorstaff'],
            [
                'name' => 'Demo Door Staff',
                'password' => $doorStaffPassword,
                'role' => 'door_staff',
                'is_active' => true,
            ]
        );

        StaffUser::updateOrCreate(
            ['username' => 'organizer'],
            [
                'name' => 'Demo Organizer',
                'password' => $organizerPassword,
                'role' => 'organizer',
                'is_active' => true,
            ]
        );

        $meetupDate = now()->addDays(7)->startOfDay();

        Event::updateOrCreate(
            ['title' => 'Cebu Dev Meetup 2026'],
            [
                'description' => 'An evening of practical talks, honest engineering conversations, and new connections for Cebu developers.',
                'venue' => 'Ayala Center Cebu, Function Room 2',
                'starts_at' => $meetupDate->copy()->setTime(9, 0),
                'ends_at' => $meetupDate->copy()->setTime(17, 0),
                'capacity' => 30,
                'status' => 'published',
            ]
        );

        $fullDate = now()->addDays(7)->startOfDay();

        $full = Event::updateOrCreate(
            ['title' => 'Cebu Design Social'],
            [
                'description' => 'A small, sold-out gathering for designers and creative technologists.',
                'venue' => 'The Greenery, Kasambagan',
                'starts_at' => $fullDate->copy()->setTime(15, 0),
                'ends_at' => $fullDate->copy()->setTime(17, 30),
                'capacity' => 3,
                'status' => 'published',
            ]
        );

        for ($i = 1; $i <= 3; $i++) {
            Registration::updateOrCreate(
                ['ticket_code' => "CDS-DEMO0{$i}"],
                [
                    'event_id' => $full->id,
                    'full_name' => "Seeded Guest {$i}",
                    'email' => "guest{$i}@example.test",
                    'mobile' => '0917123456' . $i,
                    'qr_token' => Str::random(48),
                    'status' => 'confirmed',
                    'registered_at' => now(),
                ]
            );
        }
    }
}
