@extends('layouts.app')

@section('content')
    <div class="ticket">
        <div class="ticket-top">
            <p class="eyebrow">YOUR EVENT TICKET</p>

            <h1>{{ $registration->event->title }}</h1>

            <p class="event-details">
                {{ $registration->event->starts_at->timezone('Asia/Manila')->format('D, M j, Y · g:i A') }}
                <span>•</span>
                {{ $registration->event->venue }}
            </p>
        </div>

        <div class="ticket-body">
            <p class="eyebrow">REGISTERED ATTENDEE</p>

            <p class="attendee">
                {{ $registration->full_name }}
            </p>

            @if ($registration->status === 'waitlisted')
                <p class="status-message waitlisted">
                    You are currently on the waitlist. This QR code is not valid for entry.
                </p>
            @else
                <p class="status-message">
                    Present this QR code at the entrance for check-in.
                </p>
            @endif

            <div class="qr-container">
                <img class="qr" alt="QR code for {{ $registration->ticket_code }}"
                    src="https://api.qrserver.com/v1/create-qr-code/?size=260x260&data={{ urlencode($registration->ticket_code) }}">
            </div>

            <p class="code-label">TICKET CODE</p>

            <p class="code">
                {{ $registration->ticket_code }}
            </p>

            <div class="ticket-status">
                <span>Status</span>

                <strong>
                    {{ ucfirst(str_replace('_', ' ', $registration->status)) }}
                </strong>
            </div>

            @if ($registration->status === 'waitlisted')
                <div class="ticket-status">
                    <span>Waitlist Position</span>

                    <strong>
                        #{{ $registration->waitlist_position }}
                    </strong>
                </div>
            @endif
        </div>
    </div>

    @if (in_array($registration->status, ['confirmed', 'waitlisted']))
        <div class="form-card narrow cancel">
            <h2>Need to cancel?</h2>

            <p>
                Enter the email address you used during registration.
                Checked-in tickets cannot be cancelled.
            </p>

            <form method="POST" action="{{ route('tickets.cancel', $registration->ticket_code) }}">
                @csrf

                <label for="cancel-email">
                    Email Address
                </label>

                <input id="cancel-email" type="email" name="email" placeholder="Enter your registered email"
                    value="{{ old('email') }}" required>

                @error('cancel_email')
                    <small>{{ $message }}</small>
                @enderror

                <button type="submit" class="button secondary">
                    Cancel Registration
                </button>
            </form>
        </div>
    @endif

    <p class="center ticket-footer">
        <a href="{{ route('tickets.lookup') }}">
            Need to find this ticket later?
        </a>
    </p>
@endsection
