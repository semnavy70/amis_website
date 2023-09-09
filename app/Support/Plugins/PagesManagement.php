<?php

namespace Vanguard\Support\Plugins;

use Vanguard\Plugins\Plugin;
use Vanguard\Support\Sidebar\Item;

class PagesManagement extends Plugin
{
    public function sidebar()
    {
        $page = Item::create(__('Page'))
            ->route('page.index')
            ->active("admin/page/*")
            ->permissions('pages.manage');

        $category = Item::create(__('Page category'))
            ->route('page-category.index')
            ->active("admin/page-category/*")
            ->permissions('page-category.manage');


        $contactUs = Item::create(__('Contact us'))
            ->route('page.contact-us')
            ->active("admin/page/contact-us")
            ->permissions('pages.manage');

        return Item::create(__('Manage Pages'))
            ->href('#page-management-dropdown')
            ->icon('fas fa-solid fa-file')
            ->active("admin/page-contact-us")
            ->permissions(['pages.manage'])
            ->addChildren([
                $page,
                $category,
                $contactUs,
            ]);
    }
}
