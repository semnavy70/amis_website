<?php

namespace Vanguard\Repositories\AdvertiseLog;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Vanguard\Advertise;

class EloquentAdvertiseLog implements AdvertiseLogRepository
{
    public function advertises()
    {
        return Advertise::get();
    }

    public function paginate($paginate, $adsId, $startDate, $endDate): LengthAwarePaginator
    {
        return DB::table('advertise_logs as al')
            ->leftJoin('advertises as a', 'al.advertise_id', '=', 'a.id')
            ->when($adsId, function ($q) use ($adsId) {
                $q->where('al.advertise_id', $adsId);
            })
            ->when(($startDate && $endDate), function ($q) use ($startDate, $endDate) {
                $q->whereDate('al.created_at', '<=', $endDate)
                    ->whereDate('al.created_at', '>=', $startDate);
            })
            ->select(DB::raw('Date(al.created_at) as date'), DB::raw('COUNT(a.id) as count_advertise'))
            ->groupBy('date')
            ->paginate($paginate);
    }

    public function getAdvertiseTitle($adsId, $startDate, $endDate): string
    {
        $advertise = Advertise::find($adsId);

        return ($advertise->name) . '_' . dmYDate($startDate) . '_' . dmYDate($endDate) . '.xlsx';
    }
}
