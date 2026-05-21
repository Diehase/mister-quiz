@extends('layouts.app')

@section('title', 'Профиль')

@section('content')
<h1>ПРОФИЛЬ</h1>

<div style="display:grid; grid-template-columns:1fr 1fr; gap:1.5rem;">

    {{-- Основная информация --}}
    <div class="card">
        <h2>Обо мне</h2>

        <div style="margin-bottom:1rem;">
            <span style="color:var(--muted); font-size:0.8rem; text-transform:uppercase; letter-spacing:1px;">Имя пользователя</span>
            <p style="font-size:1.1rem; margin-top:0.2rem;">{{ $user->username }}</p>
        </div>

        <div style="margin-bottom:1rem;">
            <span style="color:var(--muted); font-size:0.8rem; text-transform:uppercase; letter-spacing:1px;">Email</span>
            <p style="font-size:1.1rem; margin-top:0.2rem;">{{ $user->email }}</p>
        </div>

        <div style="margin-bottom:1rem;">
            <span style="color:var(--muted); font-size:0.8rem; text-transform:uppercase; letter-spacing:1px;">XP</span>
            <p style="font-size:2rem; color:var(--accent); font-family:'Bebas Neue',sans-serif; letter-spacing:2px; margin-top:0.2rem;">
                {{ number_format($user->xp) }} XP
            </p>
        </div>

        <div>
            <span style="color:var(--muted); font-size:0.8rem; text-transform:uppercase; letter-spacing:1px;">Ранг</span>
            <p style="margin-top:0.4rem;">
                <span class="badge" style="font-size:0.9rem; padding:0.4rem 1rem;">{{ $user->getRank() }}</span>
            </p>
        </div>
    </div>

    {{-- Статистика по категориям --}}
    <div class="card">
        <h2>По категориям</h2>
        <table>
            <thead>
                <tr>
                    <th>Категория</th>
                    <th>Правильно</th>
                    <th>Всего</th>
                    <th>%</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $cat)
                @php $score = $user->getCategoryScore($cat); @endphp
                <tr>
                    <td><span class="badge">{{ $cat }}</span></td>
                    <td style="color:var(--success);">{{ $score['correct'] }}</td>
                    <td>{{ $score['total'] }}</td>
                    <td>
                        {{ $score['total'] > 0 ? round($score['correct'] / $score['total'] * 100) . '%' : '—' }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

<div style="text-align:center; margin-top:2rem;">
    <a href="{{ route('quiz.start') }}" class="btn btn-primary">Сыграть</a>
</div>
@endsection