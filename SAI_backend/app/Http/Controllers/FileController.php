<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadFileRequest;
use App\Http\Services\EmailService;
use App\Http\Services\FileService;
use Illuminate\Http\JsonResponse;


class FileController extends Controller
{
    /**
     * FileController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }


    /**
     * Uploads file to S3, saves file meta details to database and fires off email job.
     *
     * @param UploadFileRequest $request
     * @return JsonResponse
     */
    public function uploadFile(UploadFileRequest $request, $userId)
    {
        $file = (new FileService())->storeFile($request, $userId);

        // fire off email with uploaded file details
        $response = (new EmailService())->sendConfirmationEmail($file, $userId);

        return $response;
    }
}
