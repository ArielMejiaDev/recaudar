<?php namespace App\Services;

use Illuminate\Support\Facades\Storage;

class S3Uploader
{
    public static function upload($inputName, $directory, $fileToReplace = null)
    {
        $file = request()->file($inputName)->store($directory, 's3');
        Storage::disk('s3')->setVisibility($file, 'public');

        if($fileToReplace) {
            Storage::disk('s3')->delete( $directory . '/' . basename($fileToReplace));
        }

        return Storage::disk('s3')->url($file);
    }
}
