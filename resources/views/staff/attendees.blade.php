@extends('layouts.app') @section('content')
    <a class="back" href="{{ route('staff.dashboard') }}">
        ← Staff events</a>
    <div class="section-head">
        <div>
            <p class="eyebrow">ATTENDEES</p>
            <h1>{{ $event->title }}</h1>
        </div><span>{{ $registered }} / {{ $event->capacity }} registered · {{ $checkedIn }} checked in</span>
    </div>
    <form class="search" method="GET"><input name="search" value="{{ $search }}"
            placeholder="Search name or ticket code"><button class="button secondary">Search</button></form>
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
                </tr>@empty<tr>
                        <td colspan="6">No attendees found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
