<?php

namespace Vanguard\Http\Controllers\Web\Menus;

use Vanguard\Http\Controllers\Controller;
use Vanguard\Http\Requests\Menus\CreateMenusRequest;
use Vanguard\Repositories\Menus\MenusRepository;

class MenusController extends Controller
{
    private $menus;

    public function __construct(MenusRepository $menus)
    {
        $this->menus = $menus;
    }

    public function index()
    {
        $list = $this->menus->paginate(10);
        return view('menus.index', compact('list'));
    }

    public function create()
    {
        return view('menus.create');
    }

    public function store(CreateMenusRequest $request)
    {
        $this->menus->store($request->all());
        return redirect()->route('menus.index')->withSuccess("បង្កើតមុឺនុយបានជោគជ័យ");
    }

    public function edit($id)
    {
        $menus = $this->menus->single($id);
        $data = [
            'menus' => $menus,
        ];
        return view('menus.edit', $data);
    }

    public function update(CreateMenusRequest $request)
    {
        $this->menus->update($request->id, $request->all());
        return redirect()->route('menus.index')->withSuccess("កែប្រែមុឺនុយបានជោគជ័យ");
    }

    public function delete($id)
    {
        $this->menus->delete($id);
        return back()->withSuccess("លុបមុឺនុយបានជោគជ័យ");
    }

}
