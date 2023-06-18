<?php

namespace Vanguard\Support\Plugins;

use Vanguard\Plugins\Plugin;
use Vanguard\Support\Sidebar\Item;
use Vanguard\User;

class Settings extends Plugin
{
    public function sidebar()
    {
        $general = Item::create(__('General'))
            ->route('settings.general')
            ->active("admin/settings")
            ->permissions('settings.general');

        $authAndRegistration = Item::create(__('Authenticate'))
            ->route('settings.auth')
            ->active("admin/settings/auth")
            ->permissions('settings.auth');

        $notifications = Item::create(__('Notification'))
            ->route('settings.notifications')
            ->active("admin/settings/notifications")
            ->permissions([function (User $user) {
                return $user->hasPermission('settings.notifications');
            }]);

        $themeSetting = Item::create(__('Manage Themes'))
            ->route('themes.general')
            ->active("admin/themes*")
            ->permissions('themes.manage');

        return Item::create(__('Setting'))
            ->href('#settings-dropdown')
            ->icon('fas fa-cog')
            ->active("admin/settings*")
            ->permissions(['settings.general', 'settings.auth', 'settings.notifications'])
            ->addChildren([
                $general,
                $authAndRegistration,
                $notifications,
                $themeSetting
            ]);
    }
}
