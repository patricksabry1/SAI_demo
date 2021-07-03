<?php

namespace App\Http\Services;

use App\Http\Requests\UploadFileRequest;
use App\Models\File;
use App\Models\User;
use App\Models\UserFile;
use Aws\S3\Exception\S3Exception;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;


class FileService
{
    /**
     * Uploads valid file to S3 bucket and saves appropriate file metadata to remote DB
     *
     * @param UploadFileRequest $request
     * @param int $userId
     *
     * @return Mixed
     */
    public function storeFile(UploadFileRequest $request, int $userId)
    {
        // fetch file from request and parse meta details
        $file = $request->file('file');
        $fileName = $request->file('file')->getClientOriginalName();
        $fileSize = $request->file('file')->getSize();

        // generate unique S3 object key as a hash of user_id + filename
        $object_key = MD5($userId . $fileName);

        // store the file in the S3 bucket if it doesn't already exist
        if (!Storage::disk('s3')->exists($object_key)) {
            try {
                Storage::disk('s3')->put($object_key, file_get_contents($file));
            } catch (S3Exception $e) {
                return response()->json([
                    'error'     => 'S3Exception',
                    'message'   => $e->getAwsErrorMessage()
                ], 400);
            }
        } else {
            return response()->json([
                'error'     => 'FileExistsException',
                'message'   => ' A file with this name already exists.'
            ], 400);
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

        return $file;
    }
}
