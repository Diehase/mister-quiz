@extends('layouts.app')

@section('title', 'Регистрация')

@section('content')
<div style="max-width:440px; margin:0 auto;">
    <div class="card">
        <h1>РЕГИСТРАЦИЯ</h1>

        @if($errors->any())
            <div class="alert alert-error">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <label for="username">Имя пользователя</label>
            <input type="text" id="username" name="username" value="{{ old('username') }}" required>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required>

            <label for="password">Пароль</label>
            <input type="password" id="password" name="password" required>

            <label for="password_confirmation">Подтверждение пароля</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required>

            <button type="submit" class="btn btn-primary" style="width:100%; margin-top:0.5rem;">
                Создать аккаунт
            </button>
        </form>

        <p style="text-align:center; margin-top:1.5rem; color:var(--muted); font-size:0.9rem;">
            Уже есть аккаунт? <a href="{{ route('login') }}" style="color:var(--accent); text-decoration:none;">Войти</a>
        </p>
    </div>
</div>
@endsection