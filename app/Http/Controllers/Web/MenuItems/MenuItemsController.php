<?php

namespace Vanguard\Http\Controllers\Web\MenuItems;

use Vanguard\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Vanguard\Menu;
use Vanguard\Repositories\MenuItems\MenuItemsRepository;

class MenuItemsController extends Controller
{

    private $menuItem;

    public function __construct(MenuItemsRepository $menuItem)
    {
        $this->menuItem = $menuItem;
    }

    public function index()
    {
        $list = $this->menuItem->paginate(10);
        return view('menuitem.index', compact('list'));
    }

    public function create()
    {
        $menus = Menu::all();
        $data = [
            'menus' => $menus
        ];
        return view('menuitem.create', $data);
    }

    public function store(Request $request)
    {
        $this->menuItem->store($request->all());
        return redirect()->route('menuitem.index')->withSuccess("បង្កើតប្រភេទមុឺនុយជោគជ័យ");
    }

    public function edit($id)
    {
        $menu = Menu::all();
        $menuItem = $this->menuItem->single($id);
        $data = [
            'menu' => $menu,
            'menuItem' => $menuItem,
        ];
        return view('menuitem.edit', $data);
    }

    public function update(CreateMenuItemsRequest $request)
    {
        $this->menuItem->update($request->id, $request->all());
        return redirect()->route('menuitem.index')->withSuccess("កែប្រែប្រភេទមុឺនុយបានជោគជ័យ");
    }

    public function delete($id)
    {
        $this->menuItem->delete($id);
        return back()->withSuccess("ការលុបជោគជ័យ");
    }
}
