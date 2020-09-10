<?php namespace App\Services;

use App\Exceptions\FileUploadToS3FailException;
use Illuminate\Support\Facades\Storage;

class S3Uploader
{
    public static function upload($inputName, $directory, $fileToReplace = null)
    {
        try {
            $file = request()->file($inputName)->store($directory, 's3');
            Storage::disk('s3')->setVisibility($file, 'public');
        }catch (\Throwable $exception) {
            throw new FileUploadToS3FailException();
        }

        if($fileToReplace) {
            Storage::disk('s3')->delete( $directory . '/' . basename($fileToReplace));
        }

        return Storage::disk('s3')->url($file);
    }
}
