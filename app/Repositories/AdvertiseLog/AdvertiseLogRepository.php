<?php

namespace Vanguard\Repositories\AdvertiseLog;

interface AdvertiseLogRepository
{
    public function advertises();

    public function paginate($paginate, $adsId, $startDate, $endDate);

    public function getAdvertiseTitle($adsId, $startDate, $endDate);
}
