<?php

namespace Vanguard\Support\Plugins;

use Vanguard\Plugins\Plugin;
use Vanguard\Support\Sidebar\Item;

class MenusManagement extends Plugin
{
    public function sidebar()
    {
        $menu = Item::create(__('Menu Pages'))
            ->route('menus.index')
            ->active("admin/menus*")
            ->permissions('menus.manage');

        $menuItem = Item::create(__('Menu Items'))
            ->route('menuitem.index')
            ->active("admin/menuitem*")
            ->permissions('menuitem.manage');


        return Item::create(__('Manage Menus'))
            ->href('#menu-management-dropdown')
            ->icon('fas fa-solid fa-bars')
            ->active("admin/menuitem*")
            ->permissions(['menuitem.manage'])
            ->addChildren([
                $menu,
                $menuItem,
            ]);

    }
}
