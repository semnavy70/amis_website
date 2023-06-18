<?php

namespace Vanguard\Support\Plugins;

use Vanguard\Plugins\Plugin;
use Vanguard\Support\Sidebar\Item;

class FileManagerManagement extends Plugin
{
    public function sidebar()
    {
        return Item::create(__('Manage File Manager'))
            ->route('unisharp.lfm.show')
            ->icon('fas fa-folder-open')
            ->active("admin/filemanager*")
            ->target("_blank")
            ->permissions('filemanager.manage');
    }
}
