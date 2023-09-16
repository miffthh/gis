<?php

namespace App\Exports;

use App\Models\PromosiAdmin;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;



class PromosiAdminExport implements FromView, ShouldAutoSize
{
    private $promosi;

    public function __construct()
    {
        $this->promosi = PromosiAdmin::all();
    }

    public function view(): View
    {
        return view('admin.promosi.promosiadmin-excel', [
            'promosi' => $this->promosi
        ]);
    }




}
