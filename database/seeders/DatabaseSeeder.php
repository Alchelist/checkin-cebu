<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Registration;
use App\Models\StaffUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        StaffUser::updateOrCreate(['username' => 'doorstaff'], [
            'name' => 'Demo Door Staff', 'password' => 'Pass1234!', 'role' => 'door_staff', 'is_active' => true,
        ]);
        StaffUser::updateOrCreate(['username' => 'organizer'], [
            'name' => 'Demo Organizer', 'password' => 'Pass1234!', 'role' => 'organizer', 'is_active' => true,
        ]);
        $meetup = Event::updateOrCreate(['title' => 'Cebu Dev Meetup 2026'], [
            'description' => 'An evening of practical talks, honest engineering conversations, and new connections for Cebu developers.',
            'venue' => 'Ayala Center Cebu, Function Room 2', 'starts_at' => now()->startOfDay()->setTime(9, 0), 'ends_at' => now()->startOfDay()->setTime(23, 0), 'capacity' => 30, 'status' => 'published',
        ]);
        $full = Event::updateOrCreate(['title' => 'Cebu Design Social'], [
            'description' => 'A small, sold-out gathering for designers and creative technologists.',
            'venue' => 'The Greenery, Kasambagan', 'starts_at' => now()->addDays(7)->startOfDay()->setTime(15, 0), 'ends_at' => now()->addDays(7)->startOfDay()->setTime(17, 30), 'capacity' => 3, 'status' => 'published',
        ]);
        for ($i=1; $i<=3; $i++) Registration::updateOrCreate(['ticket_code' => "CDS-DEMO0{$i}"], [
            'event_id'=>$full->id,'full_name'=>"Seeded Guest {$i}",'email'=>"guest{$i}@example.test",'mobile'=>'0917123456'.$i,'qr_token'=>str_pad("seed{$i}",48,'x'),'status'=>'confirmed','registered_at'=>now(),
        ]);
    }
}
