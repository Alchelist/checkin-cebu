@extends('layouts.app') @section('content')
    <div class="form-card narrow">
        <p class="eyebrow">TICKET LOOKUP</p>
        <h1>Find your ticket</h1>
        <p>Enter the email address used for registration.</p>
        <form method="POST" action="{{ route('tickets.lookup.submit') }}">@csrf<label>Ticket code<input name="ticket_code"
                    value="{{ old('ticket_code') }}" placeholder="EVT-XXXXXXX" required></label>
            @error('ticket_code')
                <small>{{ $message }}</small>
            @enderror
            <label>
                Email address<input type="email" name="email" value="{{ old('email') }}" required></label>
            @error('email')
                <small>{{ $message }}</small>
            @enderror
            <button class="button">Find ticket</button>
        </form>
    </div>
@endsection
