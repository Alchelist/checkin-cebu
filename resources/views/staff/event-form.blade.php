@extends('layouts.app') @section('content')
    <a class="back" href="{{ route('staff.dashboard') }}">
        Back to dashboard</a>
    <div class="form-card">
        <p class="eyebrow">EVENT MANAGEMENT</p>
        <h1>{{ $event->exists ? 'Edit event' : 'Create an event' }}</h1>
        <form method="POST"
            action="{{ $event->exists ? route('staff.events.update', $event) : route('staff.events.store') }}">@csrf
            @if ($event->exists)
                @method('PUT')
            @endif
            <label>
                Title<input name="title" value="{{ old('title', $event->title) }}" required></label>
            @error('title')
                <small>{{ $message }}</small>
            @enderror
            <label>
                Description
                <textarea name="description" required>{{ old('description', $event->description) }}</textarea>
            </label><label>Venue<input name="venue" value="{{ old('venue', $event->venue) }}" required></label>
            <div class="two"><label>Starts at<input type="datetime-local" name="starts_at"
                        value="{{ old('starts_at', $event->starts_at?->format('Y-m-d\\TH:i')) }}"
                        required></label><label>Ends at<input type="datetime-local" name="ends_at"
                        value="{{ old('ends_at', $event->ends_at?->format('Y-m-d\\TH:i')) }}" required></label></div>
            @error('ends_at')
                <small>{{ $message }}</small>
            @enderror
            <div class="two">
                <label>Capacity<input type="number" min="1" name="capacity"
                        value="{{ old('capacity', $event->capacity ?? 30) }}" required></label><label>Status<select
                        name="status">
                        <option value="draft" @selected(old('status', $event->status) === 'draft')>Draft</option>
                        <option value="published" @selected(old('status', $event->status) === 'published')>Published</option>
                        <option value="closed" @selected(old('status', $event->status) === 'closed')>Closed</option>
                    </select></label>
            </div>
            @error('capacity')
                <small>{{ $message }}</small>
            @enderror
            <button class="button">{{ $event->exists ? 'Save changes' : 'Create event' }}</button>
        </form>
    </div>
@endsection
