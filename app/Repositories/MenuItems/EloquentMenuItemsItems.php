<?php

namespace Vanguard\Repositories\MenuItems;

use Illuminate\Support\Facades\DB;
use Vanguard\Menu;
use Vanguard\MenuItem;
use Vanguard\Post;
use Vanguard\Video;

class EloquentMenuItemsItems implements MenuItemsRepository
{
    public function paginate(int $paginate, $search = null)
    {
        // TODO: Implement paginate() method.
        return MenuItem::when($search, function ($q) use ($search) {
            $q->where('title', "LIKE", '%' . $search . '%')
                ->orWhere('route', "LIKE", '%' . $search . '%');
        })
            ->paginate($paginate);
    }

    public function store(array $data)
    {
        // TODO: Implement store() method.
        $menus = new MenuItem();
        $menus->menu_id = $data["menu_id"];
        $menus->parent_id = $data["parent_id"] ?? null;
        $menus->title = $data["title"];
        $menus->url = $data["url"];
        $menus->target = $data["target"];
        $menus->icon_class = $data["icon_class"];
        $menus->color = $data["color"];
        $menus->order = $data["order"];
        $menus->route = $data["route"];
        $menus->save();

        return $menus;
    }

    public function single($id)
    {
        // TODO: Implement single() method.
        return MenuItem::find($id);
    }

    public function update($id, $data)
    {
        // TODO: Implement update() method.
        $menus = MenuItem::find($id);
        $menus->menu_id = $data["menu_id"];
        $menus->parent_id = $data["parent_id"] ?? null;
        $menus->title = $data["title"];
        $menus->url = $data["url"];
        $menus->target = $data["target"];
        $menus->icon_class = $data["icon_class"];
        $menus->color = $data["color"];
        $menus->order = $data["order"];
        $menus->route = $data["route"];
        $menus->save();

        return $menus;
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
        MenuItem::find($id)->delete();
    }
}
