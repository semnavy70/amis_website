<?php

namespace Vanguard\Repositories\Activity;

use Carbon\Carbon;

interface ActivityRepository
{
    public function log($data);

    public function paginateActivitiesForUser($userId, $perPage = 20, $search = null);

    public function getLatestActivitiesForUser($userId, $activitiesCount = 10);

    public function paginateActivities($perPage = 20, $search = null);

    public function userActivityForPeriod($userId, Carbon $from, Carbon $to);

    public function getLatestActivities($count = 10);
}
