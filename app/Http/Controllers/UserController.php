<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private function createToken($user)
    {
        return $user->createToken($user->name)->plainTextToken;
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:2',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8'
        ]);

        $user = User::create([
            'uuid' => Str::uuid(),
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response(['user' => $user, 'token' => $this->createToken($user)], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::findEmail($request->email)->first();

        if (!$user) {
            return response(['message' => 'Account doesn\'t exist on our records.'], 401);
        } else if (!Hash::check($request->password, $user->password)) {
            return response(['message' => 'Password doesn\'t match the account password'], 401);
        }

        return response(['user' => $user, 'token' => $this->createToken($user)], 201);
    }

    public function info()
    {
        return response(['user' => auth()->user()]);
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'string|min:2',
            'email' => 'email|unique:users,email,' . auth()->id(),
            'password' => 'min:8',
            'current_password' => 'required|password'
        ]);

        if (count($request->all()) == 0) {
            return response(['message' => 'Nothing has been updated', 'user' => $user]);
        } else if ($request->has('name')) {
            $user->update(['name' => $request->name]);
        } else if ($request->has('email')) {
            $user->update(['email' => $request->email]);
        } else if ($request->has('password')) {
            $user->update(['password' => Hash::make($request->password)]);
        }

        return response(['message' => 'User information updated', 'user' => auth()->user()]);
    }

    public function logout()
    {
        auth()->user()->currentAccessToken()->delete();

        return response(['message' => 'You have been logged out']);
    }
}
