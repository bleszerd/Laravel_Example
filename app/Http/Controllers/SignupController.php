<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SignupController extends Controller
{
    public function create()
    {
        return view('signup.create');
    }

    public function store(Request $request)
    {
        $userData = $request->except('_token');
        $userData['password'] = Hash::make($userData['password']);
        $user = User::create($userData);

        Auth::login($user);

        return redirect()->route('list_series');
    }
}
