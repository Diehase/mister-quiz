@extends('layouts.app')

@section('title', 'Таблица лидеров')

@section('content')
<h1>ТАБЛИЦА ЛИДЕРОВ</h1>

<div class="card">
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Игрок</th>
                <th>XP</th>
                <th>Ранг</th>
                <th>Правильных ответов</th>
            </tr>
        </thead>
        <tbody>
            @forelse($players as $i => $player)
            <tr>
                <td style="color:var(--muted); font-weight:600;">
                    @if($i === 0) 🥇
                    @elseif($i === 1) 🥈
                    @elseif($i === 2) 🥉
                    @else {{ $i + 1 }}
                    @endif
                </td>
                <td style="font-weight:600;">{{ $player->username }}</td>
                <td style="color:var(--accent); font-family:'Bebas Neue',sans-serif; font-size:1.1rem; letter-spacing:1px;">
                    {{ number_format($player->xp) }}
                </td>
                <td><span class="badge">{{ $player->getRank() }}</span></td>
                <td>{{ $player->getTotalCorrect() }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align:center; color:var(--muted); padding:2rem;">
                    Пока нет игроков.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div style="text-align:center; margin-top:2rem;">
    <a href="{{ route('home') }}" class="btn btn-outline">На главную</a>
</div>
@endsection