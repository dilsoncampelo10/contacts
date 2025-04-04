<?php

namespace App\Actions;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateUser
{
    public static function store(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
