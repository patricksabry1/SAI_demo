<?php

namespace App\Http\Services;

use App\Models\File;
use App\Models\User;
use App\Models\UserFile;
use Aws\S3\Exception\S3Exception;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class FileService
{
    public function storeTestFile(Request $request, int $userId)
    {
        // validate request to ensure correct file type is accepted
        $request->validate([
            'file' => 'required|mimes:pdf,docx,xml,csv,txt|max:10248'
        ]);

        // fetch file from request and parse meta details
        $file = $request->file('file');
        $fileName = $request->file('file')->getClientOriginalName();
        $fileSize = $request->file('file')->getSize();

        // validate file size as final precaution prior to upload
        $validFile = $this->validateFileSize($fileSize);

        if ($validFile == 'valid') {
            // generate unique S3 object key as a hash of user_id + filename
            $object_key = MD5($userId . $fileName);

            // store the file in the S3 bucket if it doesn't already exist
            if (!Storage::disk('s3')->exists($object_key)) {
                try {
                    Storage::disk('s3')->put($object_key, $file);
                } catch (S3Exception $e) {
                    return $e->getAwsErrorMessage();
                }
            } else {
                return response()->json([
                    'error'     => 'FileExistsException',
                    'message'   => ' A file with this name already exists.'
                ], 400);
            }
        }

        // ensure file was uploaded successfully, then store file meta data against current user in DB
        $file = File::query()->firstOrCreate([
            's3_object_id' => $object_key
        ], [
            'file_name' => $fileName,
            'file_size' => $fileSize,
            'uploaded_at' => Carbon::now()
        ]);

        // map user to file in relationship table
        UserFile::query()->firstOrCreate([
            'user_id' => User::query()->where('id', $userId)->value('id'),
            'file_id' => $file->id
        ]);

        return response()->json([
           "success"    => true,
           "message"    => "File successfully uploaded to S3",
           "file_name"  => $file->file_name,
        ], 200);
    }

    public function validateFileSize($fileSize)
    {
        $fileSizeKB = round(($fileSize / 1024));

        switch ($fileSizeKB) {
            case $fileSizeKB > 0 && $fileSizeKB <= 10240:
                return 'valid';
            case $fileSizeKB > 10240:
                return response()->json([
                    "success"    => false,
                    "message"    => "File size exceeds 10MB.",
                ], 400);
            case $fileSizeKB == 0:
                return response()->json([
                    "success"    => false,
                    "message"    => "File is empty.",
                ], 400);
            default:
                return null;
        }
    }
}
