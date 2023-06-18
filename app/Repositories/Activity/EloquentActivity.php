<?php

namespace Vanguard\Repositories\Activity;

use Carbon\Carbon;
use DB;
use Vanguard\Activity;

class EloquentActivity implements ActivityRepository
{
    public function log($data)
    {
        // date_default_timezone_set("Asia/Phnom_Penh");
        
        $activity = new Activity();
        $activity->description = $data["description"];
        $activity->user_id = $data["user_id"];
        $activity->ip_address = $data["ip_address"];
        $activity->user_agent = $data["user_agent"];
        $activity->save();

        return $activity;
    }

    public function paginateActivitiesForUser($userId, $perPage = 20, $search = null)
    {
        $query = Activity::where('user_id', $userId);

        return $this->paginateAndFilterResults($perPage, $search, $query);
    }

    private function paginateAndFilterResults($perPage, $search, $query)
    {
        if ($search) {
            $query->where('description', 'LIKE', "%$search%");
        }

        $result = $query->orderBy('created_at', 'DESC')
            ->paginate($perPage);

        if ($search) {
            $result->appends(['search' => $search]);
        }

        return $result;
    }

    public function getLatestActivitiesForUser($userId, $activitiesCount = 10)
    {
        return Activity::where('user_id', $userId)
            ->orderBy('created_at', 'DESC')
            ->limit($activitiesCount)
            ->get();
    }

    public function paginateActivities($perPage = 20, $search = null)
    {
        $query = Activity::with('user');

        return $this->paginateAndFilterResults($perPage, $search, $query);
    }

    public function userActivityForPeriod($userId, Carbon $from, Carbon $to)
    {
        $result = Activity::select([
            DB::raw("DATE(created_at) as day"),
            DB::raw('count(id) as count')
        ])
            ->where('user_id', $userId)
            ->whereBetween('created_at', [$from, $to])
            ->groupBy('day')
            ->orderBy('day', 'ASC')
            ->pluck('count', 'day');

        while (!$from->isSameDay($to)) {
            if (!$result->has($from->toDateString())) {
                $result->put($from->toDateString(), 0);
            }
            $from->addDay();
        }

        return $result->sortBy(function ($value, $key) {
            return strtotime($key);
        });
    }

    public function getLatestActivities($count = 10)
    {
        return Activity::orderBy('created_at', 'DESC')
            ->limit($count)
            ->get();
    }
}
