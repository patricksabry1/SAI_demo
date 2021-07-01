<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadFileRequest;
use App\Http\Services\EmailService;
use App\Http\Services\FileService;
use Illuminate\Http\Request;

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
     * @return String
     */
    public function uploadFile(Request $request, $userId)
    {
        $file = (new FileService())->storeTestFile($request, $userId);

        // fire off email with uploaded file details
        (new EmailService())->sendConfirmationEmail($file);
        return $file;
    }
}
