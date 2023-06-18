<?php

namespace Vanguard\Http\Controllers\Web\Themes;

use Vanguard\Http\Controllers\Controller;
use Vanguard\Http\Requests\Themes\CreateThemesRequest;
use Vanguard\Http\Requests\Themes\UpdateThemesRequest;
use Vanguard\Repositories\Themes\ThemesRepository;

class ThemesController extends Controller
{
    private $themes;

    public function __construct(ThemesRepository $themes)
    {
        $this->themes = $themes;
    }

    public function index () {
        $theme = $this->themes->single();
        $data = [
            'theme' => $theme,
        ];
         return view('themes.general', $data);
    }

    public function store(CreateThemesRequest $request)
    {
        $this->themes->store($request->all());
        return view('themes.general');
    }

    public function edit()
    {
        $theme = $this->themes->single();
        $data = [
            'theme' => $theme,
        ];
        return view('themes.edit', $data);
    }

    public function update(UpdateThemesRequest $request)
    {
        $this->themes->update($request->all());
        return redirect()->route('themes.general')->withSuccess("កែប្រែជោគជ័យ");
    }



}
