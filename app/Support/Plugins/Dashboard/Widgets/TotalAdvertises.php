<?php

namespace Vanguard\Support\Plugins\Dashboard\Widgets;

use Vanguard\Plugins\Widget;
use Vanguard\Repositories\Advertise\AdvertiseRepository;

class TotalAdvertises extends Widget
{
    public $width = '3';
    protected $permissions = 'advertise.manage';
    private $advertise;

    public function __construct(AdvertiseRepository $advertise)
    {
        $this->advertise = $advertise;
    }

    public function render()
    {
        return view('plugins.dashboard.widgets.total-advertises', [
            'count' => $this->advertise->count()
        ]);
    }
}
