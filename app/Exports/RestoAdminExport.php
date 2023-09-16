<?php

namespace App\Exports;

use App\Models\RestoAdmin;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class RestoAdminExport implements FromView, ShouldAutoSize
{
    public function view(): View
    {
        $resto = RestoAdmin::all();

        return view('admin.resto.restoadmin-excel', [
            'resto' => $resto
        ]);
    }


}
