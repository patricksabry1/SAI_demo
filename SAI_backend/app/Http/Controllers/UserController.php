<?php

namespace App\Http\Controllers;

use App\Exceptions\InvalidPasswordException;
use App\Exceptions\InvalidUserException;
use App\Http\Services\AuthService;
use App\Models\User;
use Exception;
use http\Client\Response;
use Illuminate\Http\JsonResponse;
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
        $this->middleware('auth')->only('showUser');
    }

    /**
     * Creates a system user and stores their details in DB
     *
     * @return JsonResponse
     * @throws Exception
     */
    public function createUser(Request $request) {
        $input = json_decode($request->getContent(),true);

        $response = (new AuthService())->createUser($input);

        return $response;
    }

    /**
     * Attempts to authenticate a user for login, checks if user exists in DB
     * and validates credentials.
     *
     * @return JsonResponse
     * @throws Exception
     */
    public function loginUser() {

        // get login credentials from request
        $credentials = request()->only(['email','password']);

        $response = (new AuthService())->loginUser($credentials);

        return $response;
    }

    public function showUser() {
        return auth()->user();
    }
}
