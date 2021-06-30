<?php

namespace App\Http\Controllers;

use App\Exceptions\InvalidPasswordException;
use App\Exceptions\InvalidUserException;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class UserController extends controller
{
    /**
     * UserController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth')->only(['createUser', 'showUser']);
    }


    public function createUser(Request $request) {
        $user = User::query()->firstOrNew([
            'name'      => 'Patrick',
            'email'     => 'patricksabry97@hotmail.com',
            'password'  => Hash::make('test123')
        ]);

        if (!$user->exists) {
            $user->save();
        }
    }

    /**
     * Attempts to authenticate a user for login, checks if user exists in DB
     * and validates credentials.
     *
     * @return String
     * @throws Exception
     */
    public function loginUser() {

        // get login credentials from request
        $credentials = request()->only(['email','password']);

        // check if user email exists in DB
        $user = User::query()
            ->where('email', Arr::get($credentials, 'email'))
            ->first();

        if (empty($user)) {
            throw new InvalidUserException();
        }

        // attempt to authenticate using middleware, return JWT token if successful.
        $token = auth()->attempt($credentials);

        if (!$token) {
            throw new InvalidPasswordException();
        } else {
            return json_encode(['token' => $token]);
        }
    }

    public function showUser() {
        return auth()->user();
    }
}
