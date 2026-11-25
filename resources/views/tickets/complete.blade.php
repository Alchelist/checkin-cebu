@extends('layouts.app')

@section('content')
    <div class="ticket">
        <div class="ticket-top">
            <p class="eyebrow">YOUR EVENT TICKET</p>
            <h1>{{ $registration->event->title }}</h1>
            <p>{{ $registration->event->starts_at->timezone('Asia/Manila')->format('D, M j, Y g:i A') }} at
                {{ $registration->event->venue }}</p>
        </div>
        <div class="ticket-body">
            <p class="attendee">{{ $registration->full_name }}</p>
            @if ($registration->status === 'waitlisted')
                <p class="muted">You are on the waitlist. This QR code is not valid for entry.</p>
            @else
                <p class="muted">Present this QR code at the door.</p>
            @endif
            <img class="qr" alt="QR code for {{ $registration->ticket_code }}"
                src="https://api.qrserver.com/v1/create-qr-code/?size=260x260&data={{ urlencode($registration->ticket_code) }}">
            <p class="code">{{ $registration->ticket_code }}</p>
            <p class="muted">Status: {{ ucfirst(str_replace('_', ' ', $registration->status)) }}</p>
            @if ($registration->status === 'waitlisted')
                <p class="muted">Waitlist position: #{{ $registration->waitlist_position }}</p>
            @endif
        </div>
    </div>
    @if (in_array($registration->status, ['confirmed', 'waitlisted']))
        <div class="form-card narrow cancel">
            <h2>Need to cancel?</h2>
            <p>Confirm using the email used to register. Checked-in tickets cannot be cancelled.</p>
            <form method="POST" action="{{ route('tickets.cancel', $registration->ticket_code) }}">@csrf<label>Email
                    address<input type="email" name="email" required></label>
                @error('cancel_email')
                    <small>{{ $message }}</small>
                @enderror
                <button class="button secondary">Cancel registration</button>
            </form>
        </div>
    @endif
    <p class="center"><a href="{{ route('tickets.lookup') }}">Need to find this ticket later?</a></p>
@endsection
