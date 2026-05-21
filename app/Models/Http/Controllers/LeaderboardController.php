<?php

namespace App\Http\Controllers;

use App\Models\User;

class LeaderboardController extends Controller
{
    public function index()
    {
        $players = User::orderByDesc('xp')->take(10)->get();
        return view('leaderboard', compact('players'));
    }
}