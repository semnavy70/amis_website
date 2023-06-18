<?php

namespace Vanguard\Repositories\Menus;

use Vanguard\Menu;
use Vanguard\MenuItem;

class EloquentMenus implements MenusRepository
{
    public function paginate(int $paginate, $search = null)
    {
        // TODO: Implement paginate() method.
        return Menu::when($search, function ($q) use ($search) {
            $q->where('title', "LIKE", '%' . $search . '%')
                ->orWhere('route', "LIKE", '%' . $search . '%');
        })
            ->paginate($paginate);
    }
    public function store(array $data)
    {
        // TODO: Implement store() method.
        $menus = new Menu();
        $menus->name = $data["name"];
        $menus->save();

        return $menus;
    }

    public function single($id)
    {
        // TODO: Implement single() method.
        return Menu::find($id);
    }

    public function update($id, $data)
    {
        // TODO: Implement update() method.
        $menus = Menu::find($id);
        $menus->name = $data["name"];
        $menus->save();

        return $menus;
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
        Menu::find($id)->delete();
    }

}
