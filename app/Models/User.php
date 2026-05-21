<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'username',
        'email',
        'password',
        'xp',
        'category_scores',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'category_scores' => 'array',
    ];

    public function getRank(): string
    {
        if ($this->xp < 1500) return 'Quiz Aprentice';
        if ($this->xp < 5000) return 'Average Quizer';
        if ($this->xp < 10000) return 'Epic Quizer';
        return 'Quiz Master';
    }

    public function getCategoryScore(string $category): array
    {
        $scores = $this->category_scores ?? [];
        return $scores[$category] ?? ['correct' => 0, 'total' => 0];
    }

    public function updateCategoryScore(string $category, bool $correct): void
    {
        $scores = $this->category_scores ?? [];
        if (!isset($scores[$category])) {
            $scores[$category] = ['correct' => 0, 'total' => 0];
        }
        $scores[$category]['total']++;
        if ($correct) {
            $scores[$category]['correct']++;
        }
        $this->category_scores = $scores;
    }

    public function getTotalCorrect(): int
    {
        $scores = $this->category_scores ?? [];
        return array_sum(array_column($scores, 'correct'));
    }

    public function quizSessions()
    {
        return $this->hasMany(QuizSession::class);
    }
}