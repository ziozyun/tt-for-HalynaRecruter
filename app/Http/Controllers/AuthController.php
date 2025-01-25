<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');
        if (!Auth::attempt($credentials)) {
            return response()->json(['invalidUsernameOrPassword' => true], 401);
        }

        /** @var App\Models\User */
        $user = auth()->user();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'success' => true,
            'token' => $token,
            'user' => $user
        ]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|unique:users,username|max:20',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|string|min:6|max:50',
        ]);

        $user = User::create([
            'username' => $request->username,
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'success' => true,
            'token' => $token,
            'user' => $user
        ]);
    }

    public function logout()
    {
        /** @var App\Models\User */
        $user = auth()->user();

        $user->currentAccessToken()->delete();

        return response()->json(['success' => true]);
    }

    public function me()
    {
        return response()->json(auth()->user());
    }
}
