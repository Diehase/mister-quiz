@extends('layouts.app')

@section('title', 'Результаты')

@section('content')
<h1>РЕЗУЛЬТАТЫ</h1>

<div class="card" style="text-align:center; margin-bottom:2rem;">
    <p style="font-size:3.5rem; font-family:'Bebas Neue',sans-serif; color:var(--accent); letter-spacing:2px;">
        {{ $correct }} / {{ $total }}
    </p>
    <p style="color:var(--muted);">правильных ответов</p>
</div>

<div class="card" style="margin-bottom:2rem;">
    <h2>По категориям</h2>
    <table>
        <thead>
            <tr>
                <th>Категория</th>
                <th>Правильно</th>
                <th>Всего</th>
            </tr>
        </thead>
        <tbody>
            @foreach($byCategory as $cat => $score)
            @if($score['total'] > 0)
            <tr>
                <td><span class="badge">{{ $cat }}</span></td>
                <td style="color:var(--success);">{{ $score['correct'] }}</td>
                <td>{{ $score['total'] }}</td>
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>
</div>

<div style="display:flex; gap:1rem; justify-content:center;">
    <a href="{{ route('quiz.start') }}" class="btn btn-primary">Сыграть снова</a>
    <a href="{{ route('profile') }}" class="btn btn-outline">Мой профиль</a>
    <a href="{{ route('home') }}" class="btn btn-outline">На главную</a>
</div>
@endsection