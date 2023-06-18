<?php

namespace Vanguard\Http\Controllers\Web\Advertise;

use DateInterval;
use DatePeriod;
use DateTime;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Vanguard\Exports\AdvertiseLogExport;
use Vanguard\Http\Controllers\Controller;
use Vanguard\Repositories\AdvertiseLog\AdvertiseLogRepository;

class AdvertiseLogController extends Controller
{
    private $advertiseLog;

    public function __construct(AdvertiseLogRepository $advertiseLog)
    {
        $this->advertiseLog = $advertiseLog;
    }

    public function index()
    {
        $advertises = $this->advertiseLog->advertises();
        $adsId = request()->advertise_id;
        $startDate = request()->start_date;
        $endDate = request()->end_date;
        if (!$adsId && count($advertises)>0) {
            $adsId = $advertises[0]->id;
        }
        if (!$startDate || !$endDate) {
            $endDate = date("Y-m-d");
            $date = date_create($endDate);
            $startDate = date_sub($date, date_interval_create_from_date_string('30 days'))->format('Y-m-d');
        }

        $list = $this->advertiseLog->paginate(1000, $adsId, $startDate, $endDate);

        $period = new DatePeriod(
            new DateTime("$startDate"),
            new DateInterval('P1D'),
            new DateTime("$endDate")
        );
        $logs = [];
        $logList = $list->toArray()['data'];
        foreach ($period as $index => $item) {
            $date = $item->format('Y-m-d');
            $logs[$index] = ['date' => $date, 'count_advertise' => 0];
            foreach ($logList as $logItem) {
                $logItem = (array) $logItem;
                if ($logItem['date'] == $date) {
                    $logs[$index]['count_advertise'] = $logItem['count_advertise'];
                }
            }
        }

        $data = [
            'advertises' => $advertises,
            'logs' => $logs,
            'list' => $list,
            'adsId' => $adsId,
            'startDate' => $startDate,
            'endDate' => $endDate,
        ];
        return view('advertise.log.index', $data);
    }

    public function export(): BinaryFileResponse
    {
        $adsId = request()->advertise_id;
        $startDate = request()->start_date;
        $endDate = request()->end_date;

        return Excel::download(
            new AdvertiseLogExport($this->advertiseLog, $adsId, $startDate, $endDate),
            $this->advertiseLog->getAdvertiseTitle($adsId, $startDate, $endDate)
        );
    }
}
