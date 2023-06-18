<?php

namespace Vanguard\Http\Controllers\Web;

use Illuminate\Http\Request;
use Vanguard\Http\Controllers\Controller;
use Vanguard\Repositories\Activity\ActivityRepository;
use Vanguard\User;

class ActivityController extends Controller
{
    private $activities;

    public function __construct(ActivityRepository $activities)
    {
        $this->middleware('auth');
        $this->middleware('permission:users.activity');
        $this->activities = $activities;
    }

    public function index(Request $request)
    {
        $perPage = 20;

        $list = $this->activities->paginateActivities(
            $perPage,
            $request->get('search'),
        );

        $data = [
            'list' => $list,
        ];
        return view('activity.index', $data);
    }

    public function userActivity(User $user, Request $request)
    {
        $perPage = 20;

        $list = $this->activities->paginateActivitiesForUser(
            $user->id,
            $perPage,
            $request->get('search'),
        );

        $data = [
            'list' => $list,
            'user' => $user,
        ];
        return view('activity.index', $data);
    }

}
