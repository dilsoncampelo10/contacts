<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }
    public function store(Request $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(route('contacts.index', absolute: false));
    }
}
