<?php

namespace App\Http\Controllers;

use App\Models\RestoAdmin;
use App\Models\BudayaAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class BudayaAdminController extends Controller
{
    public function index()
    {
        $budaya = DB::table('budaya')->paginate(10);

        // dd($wisata);
        return view('budayaadmin', compact(['budaya']), ["title" => "Data Budaya"]);
    }

    public function tambahbudayaadmin()
    {
        return view('tambahbudayaadmin', ["title" => "Data budaya"]);
    }

    public function aksi_tambah_budaya(Request $request)
    {
        $data = $request->all();

        BudayaAdmin::create($data);

        Alert::success('Data Berhasil Ditambahkan', 'Success.');
        return redirect('/budayaadmin');
    }

    public function editbudayaadmin(Request $request)
    {
        $id = $request->id;

        $request['budaya'] = DB::table('budaya')
            ->where('id', $id)
            ->get();
        return view('editbudayaadmin', $request, ["title" => "Data budaya"]);
    }

    public function aksi_edit_budaya(Request $request, $id)
    {
        $data = $request->validate([
            'nama_budaya'            => 'required',
            'deskripsi_singkat'     => 'required',
            'alamat'                => 'required',
        ]);

        BudayaAdmin::find($id)->update($data);
        Alert::success('Data Berhasil Diubah', 'Success.');
        return redirect('/budayaadmin');
    }

    public function hapus($id)
    {
        $data = budayaAdmin::find($id);
        $data->delete();
        // $id = $request->id;
        // DB::table('wisata')
        //     ->where('id', $id)
        //     ->delete();
        Alert::success('Data Berhasil Dihapus', 'Success.');
        return redirect('/budayaadmin');
    }
}
