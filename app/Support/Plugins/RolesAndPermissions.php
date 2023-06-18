<?php

namespace Vanguard\Support\Plugins;

use Vanguard\Plugins\Plugin;
use Vanguard\Support\Sidebar\Item;

class RolesAndPermissions extends Plugin
{
    public function sidebar()
    {
        $roles = Item::create(__('Role'))
            ->route('roles.index')
            ->active("admin/roles*")
            ->permissions('roles.manage');

        $permissions = Item::create(__('Permission'))
            ->route('permissions.index')
            ->active("admin/permissions*")
            ->permissions('permissions.manage');

        return Item::create(__('Role and permission'))
            ->href('#roles-dropdown')
            ->icon('fas fa-user-shield')
            ->active(["admin/roles*", "admin/permissions*"])
            ->permissions(['roles.manage', 'permissions.manage'])
            ->addChildren([
                $roles,
                $permissions
            ]);
    }
}
