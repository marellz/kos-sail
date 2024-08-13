<?php

namespace App\Services;

class PhotoUploadService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function upload ($photo, string $dir = 'uploads')
    {
        return $photo->store($dir);
    }
}
