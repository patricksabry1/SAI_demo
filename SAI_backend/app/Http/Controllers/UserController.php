<?php

namespace App\Http\Controllers;

use App\Http\Services\AuthService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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

    /**
     * Fetches the details of a logged in user, authentication guarded.
     *
     * @return JsonResponse
     * @throws Exception
     */
    public function showUser() {
        $response = (new AuthService())->getloggedInUser();

        return $response;
    }

    /**
     * Logs a user out using JWT auth.
     *
     * @return JsonResponse
     * @throws Exception
     */
    public function logoutUser() {
        return (new AuthService())->logoutUser();
    }
}
