@extends('layouts.app') @section('content')
    <a class="back" href="{{ route('events.show', $event) }}">
        ← Back to event</a>
    <div class="form-card">
        <p class="eyebrow">FREE REGISTRATION</p>
        <h1>{{ $event->title }}</h1>
        <p>{{ $event->starts_at->timezone('Asia/Manila')->format('M j, Y · g:i A') }} · {{ $event->venue }}</p>
        <form method="POST" action="{{ route('registrations.store', $event) }}">@csrf<label>Full name<input name="full_name"
                    value="{{ old('full_name') }}" required></label>
            @error('full_name')
                <small>{{ $message }}</small>
            @enderror
            <label>
                Email address<input type="email" name="email" value="{{ old('email') }}" required></label>
            @error('email')
                <small>{{ $message }}</small>
            @enderror
            <label>
                Mobile number<input inputmode="numeric" name="mobile" placeholder="09171234567" value="{{ old('mobile') }}"
                    required></label>
            @error('mobile')
                <small>{{ $message }}</small>
            @enderror
            <button class="button">Get my QR ticket</button>
        </form>
    </div>
@endsection
