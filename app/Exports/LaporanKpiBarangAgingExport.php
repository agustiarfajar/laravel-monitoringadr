<?php

namespace App\Exports;

use DateTime;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class LaporanKpiBarangAgingExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $data;

    public function __construct(Collection $data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        // return $this->data;

        // Create a new collection to store the rows
        $rows = new Collection();

        // Loop through the data and create a new row for each combination of dates
        foreach ($this->data as $item) {
            $targetDate = new DateTime($item->tgl_kedatangan);
            $today = new DateTime(); // Ini akan mengambil tanggal dan waktu saat ini

            $interval = $today->diff($targetDate);
            $daysDifference = $interval->days;
            $row = (object) [
                'tgl_kedatangan' => $item->tgl_kedatangan,
                'status' => $daysDifference." Hari",
                'user' => $item->user,
                'perusahaan' => $item->perusahaan,
                'item' => $item->item,
                'pemasok' => $item->pemasok,
                'nomor_po' => $item->nomor_po,
                'jumlah' => $item->jumlah,
                'unit' => $item->unit,
            ];
            $rows->push($row);
        }

        return $rows;
    }

    public function headings(): array
    {
        // Define your headers here
        return [
            'Tgl Kedatangan',
            'Status',
            'Diminta Oleh',
            // 'Status',
            'Perusahaan',
            'Barang',
            'Pemasok',
            'No PO/PR',
            'Jumlah',
            'Unit',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $lastRow = $sheet->getHighestRow();

        // Set background color for cells from B2 to the last row
        $sheet->getStyle('B2:B' . $lastRow)->applyFromArray([
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'color' => ['rgb' => 'FF0000'], // Red color
            ],
            'font' => [
                'color' => ['rgb' => 'FFFFFF'], // White color
            ],  
        ]);
        $cellRange = 'A1:' . $sheet->getHighestColumn() . $sheet->getHighestRow();

        return [
            // Style the first row (headers) to make the font bold
            1 => ['font' => ['bold' => true]],
            $cellRange => [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['rgb' => '000000'], // You can set a custom color here if needed
                    ],
                ],
            ],
        ];
    }
}
