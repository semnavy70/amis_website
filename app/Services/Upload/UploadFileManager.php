<?php

namespace Vanguard\Services\Upload;

use Illuminate\Filesystem\FilesystemManager;
use Illuminate\Http\UploadedFile;

class UploadFileManager
{
    protected $disk = 'gcs';
    private $fs;

    public function __construct(FilesystemManager $fs)
    {
        $this->fs = $fs->disk($this->disk);
    }

    public function uploadFile(UploadedFile $file, $folder = "/")
    {
        $this->fs->put(
            $folder,
            $file
        );

        if ($folder == "/") {
            return $file->hashName();
        }

        return $folder . "/" . $file->hashName();
    }

}
