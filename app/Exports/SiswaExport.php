<?php

namespace App\Exports;

use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Reader\Xml\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat as StyleNumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SiswaExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Siswa::all();
    }
    public function headings(): array
    {
        return [
            'ID',
            'Kelas ID',
            'NIS',
            'NISN',
            'Nama',
            'Jenis Kelamin',
            'Jenis Pendaftaran',
            'Diterima Pada',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Agama',
            'Status dalam Keluarga',
            'Anak ke',
            'Alamat',
            'Telepon',
            'Nama Ayah',
            'Pekerjaan Ayah',
            'Nama Ibu',
            'Pekerjaan Ibu',
            'Nama Wali',
            'Pekerjaan Wali',
        ];
    }

    public function styles($sheet)
    {
        // Menambahkan gaya pada header
        $sheet->getStyle('A1:T1')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 12,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'color' => ['argb' => 'FFFF00']
            ]
        ]);
    }

    public function title(): string
    {
        return 'Data Siswa'; // Nama sheet
    }

    public function columnFormats(): array
    {
        return [
            'A' => StyleNumberFormat::FORMAT_TEXT, // Format kolom ID sebagai teks
            'B' => StyleNumberFormat::FORMAT_TEXT, // Format kolom Kelas ID sebagai teks
            'C' => StyleNumberFormat::FORMAT_TEXT, // Format kolom NIS sebagai teks
            'D' => StyleNumberFormat::FORMAT_TEXT, // Format kolom NISN sebagai teks
            'E' => StyleNumberFormat::FORMAT_TEXT, // Format kolom Nama sebagai teks
            // Tambahkan format lain sesuai kebutuhan
        ];
    }

    public function startCell(): string
    {
        return 'A1'; // Menentukan sel awal
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $sheet->getStyle('A1:T1')->getFont()->setBold(true);
                $sheet->getStyle('A1:T1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle('A1:T1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
                $sheet->getStyle('A1:T1')->getFill()->getStartColor()->setARGB('FFFF00');
            },
        ];
    }
}
