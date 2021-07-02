<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

/**
 * Class InvalidUserException
 * @package App\Exceptions
 */
class UserExistsException extends Exception {
    /*** @var string */
    protected $message = 'A user with that email already exists.';

    /**
     * @return JsonResponse
     */
    public function render()
    {
        return Response::json([
            'error'   => class_basename($this),
            'message' => $this->getMessage(),
        ], 400);
    }
}
