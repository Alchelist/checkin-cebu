@extends('layouts.app') @section('content')
    <a class="back" href="{{ route('events.index') }}">
        Back to events</a>
    <article class="detail"><span class="eyebrow">{{ $event->starts_at->timezone('Asia/Manila')->format('l, F j, Y') }}</span>
        <h1>{{ $event->title }}</h1>
        <p class="lead">{{ $event->description }}</p>
        <dl>
            <div>
                <dt>When</dt>
                <dd>{{ $event->starts_at->timezone('Asia/Manila')->format('g:i A') }} to
                    {{ $event->ends_at->timezone('Asia/Manila')->format('g:i A') }}</dd>
            </div>
            <div>
                <dt>Where</dt>
                <dd>{{ $event->venue }}</dd>
            </div>
            <div>
                <dt>Availability</dt>
                <dd>{{ app(App\Http\Controllers\EventController::class)->spotsLeft($event) }} of {{ $event->capacity }}
                    spots left</dd>
            </div>
        </dl>
        @if ($event->status === 'published')
            <a class="button"
            href="{{ route('registrations.create', $event) }}">{{ app(App\Http\Controllers\EventController::class)->spotsLeft($event) > 0 ? 'Register free' : 'Join waitlist' }}</a>@else<button
                class="button" disabled>Registration closed</button>
        @endif
    </article>
@endsection
