<?php

namespace App\Exports;

use App\Models\PenginapanAdmin;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;



class PenginapanAdminExport implements FromView, WithHeadings, ShouldAutoSize
{
    private $penginapan;

    public function __construct()
    {
        $this->penginapan = PenginapanAdmin::all();
    }

    public function view(): View
    {
        return view('admin.penginapan.penginapanadmin-excel', [
            'penginapan' => $this->penginapan
        ]);
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama penginapan',
            'Kategori penginapan',
            'Deskripsi Singkat',
            'Website',
            'Kontak',
            'Alamat',
        ];
    }


}
