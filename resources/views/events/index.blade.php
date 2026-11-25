@extends('layouts.app') @section('content')
    <section class="hero">
        <p class="eyebrow">CEBU EVENTS, MADE SIMPLE</p>
        <h1>Find your next good room.</h1>
        <p>Free local events, easy registration, and a ticket ready at the door.</p>
    </section>
    <div class="section-head">
        <h2>Upcoming events</h2><span>All times are Cebu time (UTC+8)</span>
    </div>
    <div class="cards">
        @forelse($events as $event)
            <article class="card"><span
                    class="date">{{ $event->starts_at->timezone('Asia/Manila')->format('D · M j') }}</span>
                <h2>{{ $event->title }}</h2>
                <p>{{ $event->venue }}</p>
                <p>{{ $event->starts_at->timezone('Asia/Manila')->format('g:i A') }} –
                    {{ $event->ends_at->timezone('Asia/Manila')->format('g:i A') }}</p>
                <div class="card-foot"><strong>{{ app(App\Http\Controllers\EventController::class)->spotsLeft($event) }} of
                        {{ $event->capacity }} spots left</strong><a class="button secondary"
                        href="{{ route('events.show', $event) }}">View event</a></div>
        </article>@empty<p>No upcoming events right now.</p>
        @endforelse
    </div>
@endsection
