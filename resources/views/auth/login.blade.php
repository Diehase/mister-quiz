@extends('layouts.app')

@section('title', 'Вход')

@section('content')
<div style="max-width:440px; margin:0 auto;">
    <div class="card">
        <h1>ВХОД</h1>

        @if($errors->any())
            <div class="alert alert-error">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required>

            <label for="password">Пароль</label>
            <input type="password" id="password" name="password" required>

            <button type="submit" class="btn btn-primary" style="width:100%; margin-top:0.5rem;">
                Войти
            </button>
        </form>

        <p style="text-align:center; margin-top:1.5rem; color:var(--muted); font-size:0.9rem;">
            Нет аккаунта? <a href="{{ route('register') }}" style="color:var(--accent); text-decoration:none;">Зарегистрироваться</a>
        </p>
    </div>
</div>
@endsection