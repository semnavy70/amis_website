<?php

namespace Vanguard\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class MonthlyProductExport implements FromCollection, WithHeadingRow, WithStyles, WithEvents
{
    use Exportable;

    protected array $list;
    protected array $comodities;

    public function __construct(array $list)
    {
        $this->list = $list;
        $this->comodities = $list[0]['commodity'];
    }

    public function collection(): Collection
    {
        function flattenArray($array): array
        {
            $result = [];
            foreach ($array as $key => $value) {
                if (is_array($value)) {
                    $result += flattenArray($value);
                } else {
                    $result[$key] = $value;
                }
            }
            return $result;
        }

        // Todo: Header
        $comoditiesHeaders = collect($this->comodities)
            ->map(function ($comoditiesItem) {
                return [
                    "{$comoditiesItem['code']}" => $comoditiesItem['name'],
                ];
            })->toArray();
        $comoditiesHeaders = flattenArray($comoditiesHeaders);
        $title = [
                'region' => 'ខេត្ត',
                'market' => 'ផ្សារ',
            ] + $comoditiesHeaders;

        // Todo: Body
        $newList = collect($this->list)
            ->map(function ($item) {
                $comoditiesItems = collect($item['commodity'])
                    ->map(function ($comoditiesItem) {
                        $price = "-";
                        if ($comoditiesItem['price'] > 0) {
                            $price = number_format($comoditiesItem['new'], 2);
                        }

                        return [
                            "{$comoditiesItem['code']}" => $price,
                        ];
                    })->toArray();
                $comoditiesItems = flattenArray($comoditiesItems);
                return [
                        'region' => $item['region']['name'],
                        'market' => $item['market']['name'],
                    ] + $comoditiesItems;
            })
            ->toArray();

        // Todo: Combine
        return collect([$title] + (array)$newList);
    }

    public function styles(Worksheet $sheet): void
    {
        $sheet->getStyle('1')->getFont()->setBold(true);
        $sheet->getStyle('1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getDelegate()->getRowDimension('1')->setRowHeight(25);
                $event->sheet->getDelegate()->getColumnDimension('A')->setWidth(10);
                $event->sheet->getDelegate()->getColumnDimension('B')->setWidth(50);
            },
        ];
    }
}
