@extends('layouts.app') @section('content')
    <div class="ticket">
        <div class="ticket-top">
            <p class="eyebrow">YOUR EVENT TICKET</p>
            <h1>{{ $registration->event->title }}</h1>
            <p>{{ $registration->event->starts_at->timezone('Asia/Manila')->format('D, M j, Y · g:i A') }} ·
                {{ $registration->event->venue }}</p>
        </div>
        <div class="ticket-body">
            <p class="attendee">{{ $registration->full_name }}</p>
            <p class="muted">Present this QR code at the door</p><img class="qr"
                alt="QR code for {{ $registration->ticket_code }}"
                src="https://api.qrserver.com/v1/create-qr-code/?size=260x260&data={{ urlencode($registration->ticket_code) }}">
            <p class="code">{{ $registration->ticket_code }}</p>
            <p class="muted">Status: {{ ucfirst(str_replace('_', ' ', $registration->status)) }}</p>
        </div>
    </div>
    <p class="center"><a href="{{ route('tickets.lookup') }}">Need to find this ticket later?</a></p>
@endsection
