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
}
