<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class StorageService
{
    protected $disk;

    public function __construct()
    {
        $this->disk = Storage::disk('s3');
    }
    public function upload($file, $path)
    {
        $this->disk->put($path, $file);
        return self::getUrl($path);
    }

    public function delete($path)
    {
        return $this->disk->delete($path);
    }

    public function getFile($path)
    {
        return $this->disk->get($path);
    }

    public function getUrl($path)
    {
        return Storage::url($path);
    }
}
