@extends('layouts.app')

@section('title', 'Квиз')

@section('content')
<h1>КВИЗ</h1>

@if($errors->any())
    <div class="alert alert-error">{{ $errors->first() }}</div>
@endif

<form method="POST" action="{{ route('quiz.submit', $quizSession->id) }}">
    @csrf

    @foreach($questions as $index => $question)
    <div class="card" style="margin-bottom:1.5rem;">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1rem;">
            <span style="color:var(--muted); font-size:0.8rem; text-transform:uppercase; letter-spacing:1px;">
                Вопрос {{ $index + 1 }} / {{ $questions->count() }}
            </span>
            <div style="display:flex; gap:0.5rem; align-items:center;">
                <span class="badge">{{ $question->category }}</span>
                <span style="color:var(--accent); font-size:0.85rem; font-weight:600;">+{{ $question->xp }} XP</span>
            </div>
        </div>

        <p style="font-size:1.1rem; margin-bottom:1.2rem; line-height:1.6;">
            {{ $question->question_text }}
        </p>

        <div style="display:grid; grid-template-columns:1fr 1fr; gap:0.75rem;">
            @foreach($question->answers as $answer)
            <label style="
                display:flex; align-items:center; gap:0.75rem;
                background:var(--bg); border:1px solid var(--border);
                border-radius:8px; padding:0.8rem 1rem; cursor:pointer;
                transition:border-color 0.2s;
            " onmouseover="this.style.borderColor='var(--accent)'" onmouseout="this.style.borderColor='var(--border)'">
                <input type="radio" name="answers[{{ $question->id }}]" value="{{ $answer->id }}" required style="accent-color:var(--accent);">
                {{ $answer->answer_text }}
            </label>
            @endforeach
        </div>
    </div>
    @endforeach

    <div style="text-align:center; margin-top:2rem;">
        <button type="submit" class="btn btn-primary" style="font-size:1.1rem; padding:0.8rem 3rem;">
            Отправить ответы
        </button>
    </div>
</form>
@endsection