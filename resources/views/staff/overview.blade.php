@extends('layouts.app') @section('content')
    <div class="section-head">
        <div>
            <p class="eyebrow">STAFF PORTAL · {{ strtoupper(str_replace('_', ' ', session('staff_role'))) }}</p>
            <h1>Event command center</h1>
        </div>
        @if (session('staff_role') === 'organizer')
            <a class="button" href="{{ route('staff.events.create') }}">Create event</a>
        @endif
    </div>
    <div class="cards">
        @foreach ($events as $event)
            <article class="card"><span
                    class="date">{{ $event->starts_at->timezone('Asia/Manila')->format('M j, Y') }}</span>
                <h2>{{ $event->title }}</h2>
                <p>{{ $event->venue }}</p>
                <div class="metrics"><span><b>{{ $event->registered_count }}</b>/{{ $event->capacity }}
                        confirmed</span><span><b>{{ $event->checked_in_count }}</b> checked
                        in</span><span>{{ $event->waitlisted_count }} waitlisted</span><span>{{ $event->cancelled_count }}
                        cancelled</span></div>
                <div class="staff-links"><a href="{{ route('staff.checkin', $event) }}">Check in</a><a
                        href="{{ route('staff.attendees', $event) }}">Attendees</a>
                    @if (session('staff_role') === 'organizer')
                        <a href="{{ route('staff.events.edit', $event) }}">Edit</a>
                    @endif
                </div>
            </article>
        @endforeach
    </div>
@endsection
