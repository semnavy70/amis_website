<?php

namespace Vanguard\Exports;

use DateInterval;
use DatePeriod;
use DateTime;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Vanguard\Repositories\AdvertiseLog\AdvertiseLogRepository;

class AdvertiseLogExport implements FromCollection, WithHeadings
{
    private $advertiseLog;
    private $adsId;
    private $startDate;
    private $endDate;

    public function __construct(AdvertiseLogRepository $advertiseLog, $adsId, $startDate, $endDate)
    {
        $this->advertiseLog = $advertiseLog;
        $this->adsId = $adsId;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function collection()
    {
        $logList = $this->advertiseLog->paginate(
            1000,
            $this->adsId,
            $this->startDate,
            $this->endDate,
        );
        $period = new DatePeriod(
            new DateTime($this->startDate),
            new DateInterval('P1D'),
            new DateTime($this->endDate)
        );

        $list = [];
        foreach ($logList as $index => $item) {
            $list[$index]['date'] = ($item->date);
            $list[$index]['count_advertise'] = $item->count_advertise;
        }

        $logs = [];
        foreach ($period as $index => $item) {
            $date = $item->format('Y-m-d');
            $logs[$index] = ['id' => $index + 1, 'date' => dmYDate($date), 'count_advertise' => "0"];
            foreach ($list as $logItem) {
                if ($logItem['date'] == $date) {
                    $count  = $logItem['count_advertise'];
                    $logs[$index]['count_advertise'] = "$count";
                }
            }
        }

        return collect($logs);
    }

    public function headings(): array
    {
        return ["#", __('Datetime'), __('Total click')];
    }

}
