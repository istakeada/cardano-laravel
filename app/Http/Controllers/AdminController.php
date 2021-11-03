<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function users()
    {
        return User::all();
    }

    private function checkUser($uuid)
    {
        $user = User::findUuid($uuid)->first();

        if (!$user) {
            return response(['message' => 'Invalid UUID']);
        }

        return $user;
    }

    public function user($uuid)
    {
        $user = $this->checkUser($uuid);
        
        return response(['user' => $user, 'tokens' => $user->tokens]);
    }

    public function revokeTokens($uuid)
    {
        $user = $this->checkUser($uuid);

        $user->tokens()->delete();

        return response(['User\'s tokens has been revoked.']);
    }

    public function deleteUser($uuid)
    {
        $user = $this->checkUser($uuid);

        $user->delete();

        return response(['User has been deleted.']);
    }
}
