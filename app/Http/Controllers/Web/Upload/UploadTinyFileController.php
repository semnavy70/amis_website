<?php

namespace Vanguard\Http\Controllers\Web\Upload;

use Vanguard\Http\Controllers\Controller;
use Vanguard\Services\Upload\UploadFileManager;

class UploadTinyFileController extends Controller
{
    private $fileManager;

    public function __construct(UploadFileManager $fileManager)
    {
        $this->fileManager = $fileManager;
    }

    public function upload()
    {
        $folder = "post/" . date("Ym");
        $fileName = $this->fileManager->uploadFile(request()->file, $folder);
        $fullPath = getGCSPath($fileName);

        return ['location' => $fullPath];
    }
}
