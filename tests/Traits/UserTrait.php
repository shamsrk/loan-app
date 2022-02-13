<?php
/**
 * User related functions
 */

namespace Tests\Traits;

use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

trait UserTrait
{
    /**
     * Create a test user
     */
    protected function createUser()
    {
        $this->user = User::create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'user'
        ]);
    }

    /**
     * Create a test admin
     */
    protected function createAdmin()
    {
        $this->admin = User::create([
            'name' => 'UsAdmin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin'
        ]);
    }

    /**
     * Return Api token for user
     *
     * @param $user
     * @return string
     */
    protected function apiToken($user)
    {
        $token = Str::random(60);
        $user->forceFill([
            'api_token' => hash('sha256', $token),
        ])->save();

        return $token;
    }
}