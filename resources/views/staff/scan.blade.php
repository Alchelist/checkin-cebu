@extends('layouts.app') @section('content')
    <a class="back" href="{{ route('staff.dashboard') }}">
        Back to dashboard</a>
    <div class="form-card narrow">
        <p class="eyebrow">DOOR CHECK-IN</p>
        <h1>{{ $event->title }}</h1>
        <p>Scan with the camera or enter the code manually.</p>
        @if (session('result'))
            <div class="result {{ session('result.type') }}">
                <strong>{{ session('result.title') }}</strong><span>{{ session('result.message') }}</span></div>
        @endif
        <div id="reader" class="camera">
        </div>
        <form id="checkin-form" method="POST" action="{{ route('staff.checkin.submit', $event) }}">@csrf<label>Ticket
                code<input id="ticket_code" name="ticket_code" placeholder="EVT-XXXXXXXXXXXX" autofocus required></label>
            @error('ticket_code')
                <small>{{ $message }}</small>
            @enderror
            <button class="button">Check in attendee</button>
        </form>
        <p class="muted">{{ $event->registrations()->where('status', 'checked_in')->count() }} /
            {{ $event->registrations()->whereIn('status', ['confirmed', 'checked_in'])->count() }} checked in</p>
    </div>
    <script src="https://unpkg.com/html5-qrcode" defer></script>
    <script>
        window.addEventListener('load', () => {
            if (!window.Html5QrcodeScanner) return;
            let scanner = new Html5QrcodeScanner('reader', {
                fps: 10,
                qrbox: 220
            });
            scanner.render((text) => {
                document.getElementById('ticket_code').value = text;
                scanner.clear();
                document.getElementById('checkin-form').submit()
            }, () => {});
        });
    </script>
@endsection
