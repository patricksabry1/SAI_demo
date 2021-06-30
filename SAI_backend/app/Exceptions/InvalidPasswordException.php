<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

/**
 * Class InvalidPasswordException
 * @package App\Exceptions
 */
class InvalidPasswordException extends Exception {
    /*** @var string */
    protected $message = 'Invalid password. Please try again.';

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
