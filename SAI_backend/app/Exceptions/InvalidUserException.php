<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

/**
 * Class InvalidUserException
 * @package App\Exceptions
 */
class InvalidUserException extends Exception {
    /*** @var string */
    protected $message = 'A user with that email does not exist. Please try again.';

    /**
     * @return JsonResponse
     */
    public function render()
    {
        return Response::json([
            'error'   => class_basename($this),
            'message' => $this->getMessage(),
        ], 409);
    }
}
