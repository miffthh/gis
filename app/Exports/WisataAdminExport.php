<?php

namespace App\Exports;

use App\Models\WisataAdmin;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;



class WisataAdminExport implements FromView, WithHeadings, ShouldAutoSize
{
    private $wisata;

    public function __construct()
    {
        $this->wisata = WisataAdmin::all();
    }

    public function view(): View
    {
        return view('admin.wisata.wisataadmin-excel', [
            'wisata' => $this->wisata
        ]);
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama Wisata',
            'Kategori Wisata',
            'Deskripsi Singkat',
            'Harga Tiket',
            'Akses Kendaraan',
            'Jam Operasional',
            'Website',
            'Kontak',
            'Fasilitas',
            'Alamat',
            'Latitude',
            'Longitude',
        ];
    }


}
