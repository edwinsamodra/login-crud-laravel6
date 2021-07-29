<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function __invoke(Request $request)
    {
        return response()->json([
            'status' => 'success',
            'message' => 'you are logged in',
            'data' => ([
                'id' => $request->user()->id,
                'username' => $request->user()->username,
                'nama' => $request->user()->nama
            ])
        ], 200);
    }
}
