<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
        $user       = Auth::user();
        $categories = ['Art', 'History', 'Geography', 'Science', 'Sports'];

        return view('profile', compact('user', 'categories'));
    }
}