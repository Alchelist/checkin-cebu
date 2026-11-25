@extends('layouts.app') @section('content')
    <div class="form-card narrow">
        <p class="eyebrow">STAFF PORTAL</p>
        <h1>Welcome back</h1>
        <form method="POST" action="{{ route('staff.login.submit') }}">@csrf<label>Username<input name="username"
                    value="{{ old('username') }}" required autofocus></label>
            @error('username')
                <small>{{ $message }}</small>
            @enderror
            <label>
                Password<input type="password" name="password" required></label>
            @error('password')
                <small>{{ $message }}</small>
            @enderror
            <button class="button">Sign in</button>
        </form>
    </div>
@endsection
