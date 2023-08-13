<?php

namespace Vanguard\Support\Plugins;

use Vanguard\Plugins\Plugin;
use Vanguard\Support\Sidebar\Item;

class SlideManagement extends Plugin
{
    public function sidebar()
    {
        return Item::create(__('Manage Slide'))
            ->route('slide.index')
            ->icon('fas fa-folder-open')
            ->active("admin/slide*")
            ->permissions('slide.manage');
    }
}
