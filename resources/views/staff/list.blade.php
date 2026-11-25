@extends('layouts.app') @section('content')
    <a class="back" href="{{ route('staff.dashboard') }}">
        Back to dashboard</a>
    <div class="section-head">
        <div>
            <p class="eyebrow">ATTENDEES</p>
            <h1>{{ $event->title }}</h1>
        </div><span>{{ $registered }} / {{ $event->capacity }} registered · {{ $checkedIn }} checked in</span>
    </div>
    <div class="toolbar">
        <form class="search" method="GET"><input name="search" value="{{ $search }}"
                placeholder="Search name or ticket code"><button class="button secondary">Search</button></form><a
            class="button secondary" href="{{ route('staff.attendees.export', $event) }}">Export CSV</a>
    </div>
    @if (session('staff_role') === 'organizer')
        <form class="inline-form" method="POST" action="{{ route('staff.registrations.promote', $event) }}">@csrf<button
                class="button secondary">Promote first waitlisted attendee</button></form>
    @endif
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Ticket</th>
                    <th>Registered</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($registrations as $r)
                    <tr>
                        <td>{{ $r->full_name }}</td>
                        <td>{{ $r->email }}</td>
                        <td>{{ $r->mobile }}</td>
                        <td><code>{{ $r->ticket_code }}</code></td>
                        <td>{{ $r->registered_at?->timezone('Asia/Manila')->format('M j, g:i A') }}</td>
                        <td><span class="pill {{ $r->status }}">{{ ucfirst(str_replace('_', ' ', $r->status)) }}</span>
                        </td>
                        <td>
                            @if ($r->status === 'checked_in')
                                <form method="POST" action="{{ route('staff.checkin.undo', [$event, $r]) }}">@csrf<button
                                        class="text-button">Undo check-in</button></form>
                            @elseif($r->status !== 'cancelled')
                                <form method="POST" action="{{ route('staff.registrations.cancel', [$event, $r]) }}">
                                    @csrf<button class="text-button danger-text">Cancel</button></form>
                            @endif
                        </td>
                </tr>@empty<tr>
                        <td colspan="7">No attendees found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
