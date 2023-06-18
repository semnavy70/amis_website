<?php

namespace Vanguard\Support\Plugins\Dashboard;

use Vanguard\Plugins\Plugin;
use Vanguard\Support\Sidebar\Item;

class Dashboard extends Plugin
{
    public function sidebar()
    {
        return Item::create(__('dashboard'))
            ->route('dashboard')
            ->icon('fas fa-tachometer-alt')
            ->active("admin/dashboard");
    }
}
