<?php

namespace App\Http\Controllers\Auth;

use App\Actions\CreateUser;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\RegisterUserRequest;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }
    public function store(RegisterUserRequest $request)
    {
        $user = CreateUser::store($request->all());

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('contacts.index');
    }
}
