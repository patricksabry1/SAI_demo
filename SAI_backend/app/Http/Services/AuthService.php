<?php


namespace App\Http\Services;


use App\Exceptions\UserExistsException;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;


class AuthService
{
    /**
     * Creates a user in the database if does not already exist.
     *
     * @param $input
     *
     * @return JsonResponse
     */
    public function createUser($input) {
        $user = User::query()->firstOrNew([
            'name'      => Arr::get($input, 'name'),
            'email'     => Arr::get($input, 'email')
        ],[
            'password'  => Hash::make(Arr::get($input, 'password')) // can substitute hash for bcrypt optional
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
}
