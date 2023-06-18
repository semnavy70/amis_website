<?php

namespace Vanguard\Providers;

use Vanguard\Plugins\VanguardServiceProvider as BaseVanguardServiceProvider;
use Vanguard\Support\Plugins\AdvertiseManagement;
use Vanguard\Support\Plugins\Dashboard\Dashboard;
use Vanguard\Support\Plugins\Dashboard\Widgets\LatestActive;
use Vanguard\Support\Plugins\Dashboard\Widgets\PostHistory;
use Vanguard\Support\Plugins\Dashboard\Widgets\TotalAdvertises;
use Vanguard\Support\Plugins\Dashboard\Widgets\TotalPosts;
use Vanguard\Support\Plugins\Dashboard\Widgets\TotalUsers;
use Vanguard\Support\Plugins\FileManagerManagement;
use Vanguard\Support\Plugins\MenusManagement;
use Vanguard\Support\Plugins\PagesManagement;
use Vanguard\Support\Plugins\PostManagement;
use Vanguard\Support\Plugins\RolesAndPermissions;
use Vanguard\Support\Plugins\Settings;
use Vanguard\Support\Plugins\Users;

class VanguardServiceProvider extends BaseVanguardServiceProvider
{
    /**
     * List of registered plugins.
     *
     * @return array
     */
    protected function plugins()
    {
        return [
            Dashboard::class,
            PostManagement::class,
            PagesManagement::class,
//            AdvertiseManagement::class,
//            MenusManagement::class,
            FileManagerManagement::class,
            Users::class,
            RolesAndPermissions::class,
            Settings::class,
        ];
    }

    /**
     * Dashboard widgets.
     *
     * @return array
     */
    protected function widgets()
    {
        return [
            TotalUsers::class,
            TotalPosts::class,
            TotalAdvertises::class,
            PostHistory::class,
            LatestActive::class,
        ];
    }
}
