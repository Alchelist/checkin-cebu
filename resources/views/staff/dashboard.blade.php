@extends('layouts.app') @section('content')
    <div class="section-head">
        <div>
            <p class="eyebrow">STAFF PORTAL</p>
            <h1>Events</h1>
        </div><span>Signed in as {{ session('staff_name') }}</span>
    </div>
    <div class="cards">
        @foreach ($events as $event)
            <article class="card"><span
                    class="date">{{ $event->starts_at->timezone('Asia/Manila')->format('M j, Y') }}</span>
                <h2>{{ $event->title }}</h2>
                <p>{{ $event->venue }}</p>
                <p><strong>{{ $event->registered_count }} / {{ $event->capacity }}</strong> registered ·
                    <strong>{{ $event->checked_in_count }}</strong> checked in</p>
                <div class="staff-links"><a href="{{ route('staff.checkin', $event) }}">Check in →</a><a
                        href="{{ route('staff.attendees', $event) }}">Attendees →</a></div>
            </article>
        @endforeach
    </div>
@endsection
