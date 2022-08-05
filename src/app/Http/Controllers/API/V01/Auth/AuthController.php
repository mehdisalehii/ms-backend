<?php

namespace App\Http\Controllers\API\V01\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\UserRepository;
use Dotenv\Exception\ValidationException;
use Egulias\EmailValidator\Validation\Exception\EmptyValidationList;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'email' => ['email', 'required', 'unique:users'],
            'password' => ['required']
        ]);
        resolve(UserRepository::class)->create($request);
        return response()->json([
            'message' => 'user created successfully'
        ], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => ['email', 'required'],
            'password' => ['required']
        ]);
        if (Auth::attempt($request->only(['email', 'password']))) {
            return response()->json(Auth::user(),200);
        }
        throw \Illuminate\Validation\ValidationException::withMessages([
            'email'=>'incorect credentials'
        ]);

    }

    public function user()
    {
        return response()->json(Auth::user(),200);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return response()->json([
           'message'=>'logout successfully'
        ]);
    }

}
