<?php

namespace Vanguard\Repositories\Themes;

interface ThemesRepository
{
    public function index();

    public function store(array $data);

    public function single();

    public function update(array $data);

}
