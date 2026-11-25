@extends('layouts.app') @section('content')
    <a class="back" href="{{ route('staff.dashboard') }}">
        ← Staff events</a>
    <div class="form-card narrow">
        <p class="eyebrow">DOOR CHECK-IN</p>
        <h1>{{ $event->title }}</h1>
        <p>Enter or scan a ticket code.</p>
        @if (session('result'))
            <div class="result {{ session('result.type') }}">
                <strong>{{ session('result.title') }}</strong><span>{{ session('result.message') }}</span></div>
        @endif
        <form method="POST" action="{{ route('staff.checkin.submit', $event) }}">
            @csrf<label>Ticket code<input name="ticket_code" placeholder="EVT-XXXXXXX" autofocus required></label>
            @error('ticket_code')
                <small>{{ $message }}</small>
            @enderror
            <button class="button">Check in attendee</button>
        </form>
        <p class="muted">{{ $event->registrations()->where('status', 'checked_in')->count() }} /
            {{ $event->registrations()->whereIn('status', ['confirmed', 'checked_in'])->count() }} checked in</p>
    </div>
@endsection
