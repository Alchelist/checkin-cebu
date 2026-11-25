<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Models\Registration;
use App\Models\StaffUser;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_an_attendee_can_register_and_see_a_ticket(): void
    {
        $event = Event::create([
            'title' => 'Test Meetup', 'description' => 'Test event', 'venue' => 'Cebu',
            'starts_at' => now()->addDay(), 'ends_at' => now()->addDay()->addHours(2),
            'capacity' => 10, 'status' => 'published',
        ]);

        $response = $this->post(route('registrations.store', $event), [
            'full_name' => 'Juan Dela Cruz', 'email' => 'juan@example.com', 'mobile' => '09171234567',
        ]);

        $response->assertRedirect();
        $this->get($response->headers->get('Location'))->assertOk()->assertSee('Juan Dela Cruz');
    }

    public function test_staff_can_check_in_a_ticket_once_with_its_qr_code_value(): void
    {
        $event = Event::create([
            'title' => 'Today Event', 'description' => 'Test event', 'venue' => 'Cebu',
            'starts_at' => now()->startOfDay()->addHours(8), 'ends_at' => now()->endOfDay(),
            'capacity' => 10, 'status' => 'published',
        ]);
        $staff = StaffUser::create(['name' => 'Staff', 'username' => 'staff-test', 'password' => 'Pass1234!', 'role' => 'door_staff']);
        $registration = Registration::create([
            'event_id' => $event->id, 'full_name' => 'QR Guest', 'email' => 'qr@example.com', 'mobile' => '09171234567',
            'ticket_code' => 'EVT-SECUREQR123', 'qr_token' => str_repeat('a', 48), 'status' => 'confirmed', 'registered_at' => now(),
        ]);

        $this->withSession(['staff_user_id' => $staff->id, 'staff_name' => $staff->name])
            ->post(route('staff.checkin.submit', $event), ['ticket_code' => $registration->ticket_code])
            ->assertSessionHas('result.title', 'Checked in');
        $this->assertDatabaseHas('registrations', ['id' => $registration->id, 'status' => 'checked_in']);
        $this->withSession(['staff_user_id' => $staff->id])
            ->post(route('staff.checkin.submit', $event), ['ticket_code' => $registration->ticket_code])
            ->assertSessionHas('result.title', 'Already checked in');
    }
}
