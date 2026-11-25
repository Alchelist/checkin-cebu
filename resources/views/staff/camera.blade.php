@extends('layouts.app')

@section('content')
    <a class="back" href="{{ route('staff.dashboard') }}">
        Back to dashboard</a>
    <div class="form-card narrow">
        <p class="eyebrow">DOOR CHECK-IN</p>
        <h1>{{ $event->title }}</h1>
        <p>Use a camera to scan, or enter the ticket code manually.</p>
        @if (session('result'))
            <div class="result {{ session('result.type') }}">
                <strong>{{ session('result.title') }}</strong><span>{{ session('result.message') }}</span></div>
        @endif
        <div class="camera-controls"><button type="button" id="start-camera" class="button secondary">Start camera</button>
        </div>
        <p id="camera-message" class="muted" role="status">Camera access requires HTTPS when opening this page from a phone
            or another device.</p>
        <div id="reader" class="camera"></div>
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
        window.addEventListener('load', function() {
            const start = document.getElementById('start-camera'),
                message = document.getElementById('camera-message'),
                input = document.getElementById('ticket_code'),
                form = document.getElementById('checkin-form');
            let scanner, running = false;
            const show = text => message.textContent = text;
            if (!window.isSecureContext && location.hostname !== 'localhost') show(
                'Camera is blocked on HTTP. Open this site with HTTPS, or use the manual ticket-code field below.'
                );
            const load = () => window.Html5Qrcode ? show('Select Start camera to scan a ticket.') : setTimeout(load,
                100);
            load();
            start.addEventListener('click', () => {
                if (running) {
                    scanner.stop().then(() => {
                        running = false;
                        start.textContent = 'Start camera';
                        show('Camera stopped.');
                    });
                    return;
                }
                scanner = new Html5Qrcode('reader');
                start.disabled = true;
                show('Starting camera…');
                scanner.start({
                    facingMode: 'environment'
                }, {
                    fps: 10,
                    qrbox: {
                        width: 220,
                        height: 220
                    }
                }, text => {
                    input.value = text;
                    show('QR code detected — checking in…');
                    scanner.stop().finally(() => form.submit());
                }, () => {}).then(() => {
                    running = true;
                    start.disabled = false;
                    start.textContent = 'Stop camera';
                    show('Camera ready. Point it at the QR code.');
                }).catch(error => {
                    start.disabled = false;
                    show('Could not start this camera (' + error.name +
                        '). Close Zoom/Teams/Camera, allow permission, then try another camera or type the ticket code.'
                        );
                });
            });
        });
    </script>
@endsection
