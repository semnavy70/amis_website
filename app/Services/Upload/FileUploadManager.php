<?php

namespace Vanguard\Services\Upload;

use Illuminate\Filesystem\FilesystemManager;
use Illuminate\Http\UploadedFile;

class FileUploadManager
{
    private $fs;
    protected $disk = 'gcs';

    public function __construct(FilesystemManager $fs)
    {
        $this->fs = $fs->disk($this->disk);
    }

    public function  uploadFile(UploadedFile $file): string
    {
        $fileName = $file->hashName();
        $fileContent = $file->getContent();

        $this->fs->put(
            $fileName,
            $fileContent,
            $this->disk,
        );

        return $fileName;
    }

}
