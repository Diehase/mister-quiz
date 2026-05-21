# MisterQuiz 🎯

A quiz game web application built with PHP and Laravel as part of a school project.

Inspired by *Who Wants to Be a Millionaire?*, this app lets users test their knowledge across multiple categories, earn XP, and compete on a leaderboard.

## Features

- User registration and login
- Quiz with questions across 5 categories: Art, History, Geography, Science, Sports
- XP system — earn points for correct answers
- Persistent quiz sessions (refreshing the page keeps the same questions)
- Results page with per-category breakdown
- Profile page with rank, XP, and category stats
- Leaderboard showing top 10 players

## Ranks

| XP | Rank |
|---|---|
| < 1500 | Quiz Aprentice |
| 1500 – 5000 | Average Quizer |
| 5000 – 10000 | Epic Quizer |
| 10000+ | Quiz Master |

## Stack

- PHP 8.x
- Laravel 8
- MySQL
- Blade templates

## Setup

```bash
# Clone the repo
git clone https://github.com/your-username/mister-quiz.git
cd mister-quiz

# Install dependencies
composer install

# Copy env and generate key
cp .env.example .env
php artisan key:generate

# Configure your database in .env
DB_DATABASE=mister_quiz
DB_USERNAME=root
DB_PASSWORD=

# Run migrations
php artisan migrate

# Seed questions (import questions.sql via phpMyAdmin)

# Start the server
php artisan serve
```
---

App runs at `http://127.0.0.1:8000`


---

> **P.S.** Проект ещё находится в разработке и не завершён.
> **P.S.** The project is still in development and not yet complete.
