<?php


namespace App\Http\Services;


use App\Exceptions\InvalidPasswordException;
use App\Exceptions\InvalidUserException;
use App\Exceptions\UserExistsException;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;

class AuthService
{
    public function createUser($input) {
        $user = User::query()->firstOrNew([
            'name'      => Arr::get($input, 'name'),
            'email'     => Arr::get($input, 'email')
        ],[
            'password'  => Hash::make(Arr::get($input, 'password'),) // can substitute hash for bcrypt optional
        ]);

        if ($user->exists) {
            throw new UserExistsException();

        }

        $user->save();
        return Response::json([
            'success'   => true,
            'name'      => $user->name,
            'email'     => $user->email
        ], 201);
    }

    public function loginUser($credentials) {
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
            return response()->json(['success' => true, 'token' => $token]);
        }
    }
}
