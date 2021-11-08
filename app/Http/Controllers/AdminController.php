<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{    
    /**
     * [Admin] Get All Users
     *
     */
    public function users()
    {
        return User::all();
    }
    
    /**
     * [Admin] Check User Info
     *
     * @param  string $uuid
     */
    private function checkUser($uuid)
    {
        $user = User::findUuid($uuid)->first();

        if (!$user) {
            return response(['message' => 'Invalid UUID']);
        }

        return $user;
    }
    
    /**
     * [Admin] Get User Info
     *
     * @param  string $uuid
     */
    public function user($uuid)
    {
        $user = $this->checkUser($uuid);
        
        return response(['user' => $user, 'tokens' => $user->tokens]);
    }
    
    /**
     * [Admin] Delete User Tokens
     *
     * @param  string $uuid
     */
    public function revokeTokens($uuid)
    {
        $user = $this->checkUser($uuid);

        $user->tokens()->delete();

        return response(['User\'s tokens has been revoked.']);
    }
    
    /**
     * [Admin] Delete User
     *
     * @param  string $uuid
     */
    public function deleteUser($uuid)
    {
        $user = $this->checkUser($uuid);

        $user->delete();

        return response(['User has been deleted.']);
    }
}
