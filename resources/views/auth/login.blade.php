@extends('layouts.app')

@section('content')
    <div class="container">
            <div class="card auth-card">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <i class="fas fa-envelope"></i>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="E-mail" required>
                </div>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <div class="form-group">
                    <i class="fas fa-key"></i>
                    <input id="password" type="password" name="password" autocomplete="current-password" placeholder="Password" required>
                </div>
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <div class="form-group">
                    <input type="checkbox" class="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label for="remember">Запомнить меня?</label>
                </div>
                <button class="btn btn-primary" type="submit">Авторизоваться</button>
                @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        Забли пароль?
                    </a>
                @endif
            </form>
        </div>
    </div>
@endsection
