<?php

namespace Vanguard\Support\Plugins\Dashboard\Widgets;

use Vanguard\Plugins\Widget;
use Vanguard\Repositories\Activity\ActivityRepository;

class LatestActive extends Widget
{
    public $width = '3';
    protected $permissions = 'users.manage';
    private $activity;

    public function __construct(ActivityRepository $activity)
    {
        $this->activity = $activity;
    }

    public function render()
    {
        return view('plugins.dashboard.widgets.latest-active', [
            'latestActive' => $this->activity->getLatestActivities(6)
        ]);
    }
}
