<?php


namespace App\Http\Services;

use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;

class EmailService
{
    /**
     * Sends file upload notification email via Sendgrid SMTP. Sendgrid handles job queueing internally.
     *
     * @param Model $file
     * @param int $userId
     *
     * @return JsonResponse
     */
    public function sendConfirmationEmail($file, $userId) {
        // get user email address for mail send
        $recipientEmail = User::query()->where('id', $userId)->value('email');

        try {
            Mail::send('confirmFileUpload', [
                's3_object_id'  => $file->s3_object_id,
                'file_name'     => $file->file_name,
                'file_size'     => $file->file_size,
                'uploaded_at'   => $file->uploaded_at
            ], function ($message) use ($recipientEmail)
            {
                $message->from('patricksabry97@hotmail.com', 'Patrick Sabry');
                $message->to($recipientEmail);
                $message->subject('A file has been successfully uploaded to the cloud!');
            });

            return response()->json([
                "success"    => true,
                "message"    => "File successfully uploaded to S3",
                "file_name"  => $file['file_name'],
            ]);
        } catch (Exception $e) {
            return response()->json([
                "success"    => false,
                "message"    => $e->getMessage(),
                "file_name"  => $file['file_name'],
            ], 400);
        }
    }
}
