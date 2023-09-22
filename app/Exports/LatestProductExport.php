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

class LatestProductExport implements FromCollection, WithHeadingRow, WithStyles, WithEvents
{
    use Exportable;

    protected array $commodities;

    public function __construct(array $commodities)
    {
        $this->commodities = $commodities;
    }

    public function collection(): Collection
    {
        $title = [
            'name' => 'ប្រភេទទំនិញ',
            'date' => 'កាលបរិច្ឆេទនៃរបាយការណ៍',
            'price' => 'តម្លៃ',
        ];
        return collect([$title] + $this->commodities);
    }

    public function styles(Worksheet $sheet): void
    {
        $sheet->getStyle('1')->getFont()->setBold(true);
        $sheet->getStyle('1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);
        $sheet->getStyle('B')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getDelegate()->getRowDimension('1')->setRowHeight(25);
                $event->sheet->getDelegate()->getColumnDimension('A')->setWidth(50);
                $event->sheet->getDelegate()->getColumnDimension('B')->setWidth(25);
                $event->sheet->getDelegate()->getColumnDimension('C')->setWidth(25);
            },
        ];
    }
}
