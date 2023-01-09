<?php

namespace App\Http\Controllers\Voyager;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Http\Controllers\VoyagerMediaController as BaseVoyagerMediaController;

class VoyagerMediaController extends BaseVoyagerMediaController
{
    public function index_modal()
    {
        // Check permission
        Voyager::canOrFail('browse_media');

        return Voyager::view('voyager::media.index_modal');
    }


    public function index_tinymce()
    {
        // Check permission
        Voyager::canOrFail('browse_media');

        return Voyager::view('voyager::media.index_tinymce');
    }
}
