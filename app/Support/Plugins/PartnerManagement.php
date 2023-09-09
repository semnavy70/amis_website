<?php

namespace Vanguard\Support\Plugins;

use Vanguard\Plugins\Plugin;
use Vanguard\Support\Sidebar\Item;

class PartnerManagement extends Plugin
{
    public function sidebar()
    {
        return Item::create(__('Manage Partner'))
            ->route('partner.index')
            ->icon('fas fa-users')
            ->active("admin/partner*")
            ->permissions('partner.manage');
    }
}
