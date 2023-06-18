<?php

namespace Vanguard\Support\Plugins;

use Vanguard\Plugins\Plugin;
use Vanguard\Support\Sidebar\Item;

class PagesManagement extends Plugin
{
    public function sidebar()
    {
        return Item::create(__('Manage Pages'))
            ->route('page.index')
            ->icon('fa fa-clipboard')
            ->active("admin/page*")
            ->permissions('pages.manage');
    }
}
