@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card auth-card">
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-group">
                <i class="fas fa-user"></i>
                <input id="name" type="text" name="name" placeholder="Nickname" value="{{ old('name') }}" required>
            </div>
            @error('name')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <div class="form-group">
                <i class="fas fa-user"></i>
                <input id="email" type="text" name="email" placeholder="E-mail" value="{{ old('email') }}" required>
            </div>
            @error('email')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <div class="form-group">
                <i class="fas fa-key"></i>
                <input id="password" type="password" name="password" autocomplete="new-password" placeholder="Password" required>
            </div>
            @error('password')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <div class="form-group">
                <i class="fas fa-key"></i>
                <input id="password_confirmation" type="password" name="password_confirmation" autocomplete="new-password" placeholder="Repeat password" required>
            </div>
            <button class="btn btn-primary" type="submit">Зарегестрироваться</button>
        </form>
    </div>
</div>
@endsection
