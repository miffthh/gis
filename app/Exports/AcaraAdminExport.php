<?php

namespace App\Exports;

use App\Models\AcaraAdmin;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;



class AcaraAdminExport implements FromView, WithHeadings, ShouldAutoSize
{
    private $acara;

    public function __construct()
    {
        $this->acara = AcaraAdmin::all();
    }

    public function view(): View
    {
        return view('admin.acara.acaraadmin-excel', [
            'acara' => $this->acara
        ]);
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama Acara',
            'Kategori Acara',
            'Deskripsi Singkat',
            'Tanggal',
            'Hadiah',
            'Kontak',
            'Alamat',
        ];
    }


}
