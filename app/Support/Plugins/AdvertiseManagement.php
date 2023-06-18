<?php

namespace Vanguard\Support\Plugins;

use Vanguard\Plugins\Plugin;
use Vanguard\Support\Sidebar\Item;

class AdvertiseManagement extends Plugin
{
    public function sidebar()
    {
        $ads = Item::create(__('Advertise'))
            ->route('advertise.index')
            ->active("admin/advertise/*")
            ->permissions('advertise.manage');

        $page = Item::create(__('Page'))
            ->route('advertise-page.index')
            ->active("admin/advertise-page/*")
            ->permissions('advertise-page.manage');

        $blog = Item::create(__('Blog'))
            ->route('advertise-blog.index')
            ->active("admin/advertise-blog/*")
            ->permissions('advertise-blog.manage');

        $logging = Item::create(__('Report'))
            ->route('advertise-log.index')
            ->active("admin/advertise-log/*")
            ->permissions('advertise-log.manage');


        return Item::create(__('Manage advertise'))
            ->href('#advertise-management-dropdown')
            ->icon('fab fa-adversal')
            ->active("admin/advertise*")
            ->permissions(['advertise.manage'])
            ->addChildren([
                $ads,
                $page,
                $blog,
                $logging,
            ]);
    }

}
