<?php

namespace App\Http\Controllers\Auth;

use App\Entity\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;

class RegisterController extends Controller
{
    public function __invoke(RegisterRequest $request)
    {
        User::create([
            'nama' => request('nama'),
            'username' => request('username'),
            'password' => bcrypt(request('password'))
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'user registered successfully',
            'data' => ([
                'username' => request('username'),
                'nama' => request('nama')
            ])
        ], 200);
    }
}
