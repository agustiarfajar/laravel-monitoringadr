<?php

namespace App\Exports;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class LaporanKpiExport implements FromCollection, WithHeadings, WithStyles
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
            $row = (object) [
                'tgl_surat_jalan' => $item->tgl_surat_jalan,
                'tgl_kirim_pemasok' => (substr($item->no_faktur, 0, 2) == 'SP' ? $item->tgl_kirim_pemasok : $item->tgl_diterima_site),
                'tgl_diterima_site' => $item->tgl_diterima_site,
                // 'status' => $item->status,
                (substr($item->no_faktur, 0, 2) == 'SJ' ? 'SHO' : 'SSP'),
                'no_faktur' => $item->no_faktur,
                'perusahaan' => $item->perusahaan,
                'item' => $item->item,
                'pemasok' => $item->pemasok,
                'ekspedisi' => $item->ekspedisi,
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
            'Tgl Surat Jalan',
            'Tgl Diproses',            
            'Tgl Diterima Site',
            // 'Status',
            'Jenis',
            'No.Surat Jalan',
            'Perusahaan',
            'Barang',
            'Pemasok',
            'Ekspedisi',
            'No.PO/PR',
            'Jumlah',
            'Unit',
        ];
    }

    public function styles(Worksheet $sheet)
    {
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
