<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\PromosiAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exports\PromosiAdminExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class PromosiAdminController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $promosi = DB::table('promosi')
                ->where('nama_promosi', 'LIKE', '%' . $request->search . '%')
                ->paginate(10);
        } else {
            $promosi = DB::table('promosi')->paginate(10);
        }

        return view('admin.promosi.promosiadmin', compact(['promosi']), ["title" => "Data Promosi"]);
    }
    public function tambahpromosiadmin()
    {
        return view('admin.promosi.tambahpromosiadmin', ["title" => "Data promosi"]);
    }

    public function aksi_tambah_promosi(Request $request)
    {
        $data = $request->validate([
            'nama_promosi'      => 'required',
            'deskripsi_singkat' => 'required',
            'tgl_awal'          => 'required|date',
            'tgl_akhir'         => 'required|date',
            'harga_awal'        => 'required',
            'harga_promo'       => 'required',
            'sk'                => 'required',
            'latitude'          => 'required',
            'longitude'         => 'required',
            'photo'             => 'nullable|file|image|mimes:png,jpg,jpeg',
        ]);

        $tgl_awal = str_replace(PHP_EOL, "\n", $request->tgl_awal); // Mengganti newline dengan \n
        $tgl_akhir = str_replace(PHP_EOL, "\n", $request->tgl_akhir); // Mengganti newline dengan \n
        $data['sk'] = str_replace(PHP_EOL, '<br><br>', $data['sk']); // Mengganti newline dengan <br><br>
        $data['tgl_awal'] = $tgl_awal;
        $data['tgl_akhir'] = $tgl_akhir;

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/photo_promosi/', $fileName);
            $data['photo'] = $fileName;
        } else {
            $data['photo'] = null;
        }

        // Memisahkan deskripsi singkat dengan enter
        $deskripsiSingkat = str_replace("\n", PHP_EOL, $request->input('deskripsi_singkat'));
        $data['deskripsi_singkat'] = $deskripsiSingkat;

        $data['sk'] = htmlspecialchars_decode($data['sk']);

        // Simpan latitude dan longitude
        $data['latitude'] = $request->input('latitude');
        $data['longitude'] = $request->input('longitude');

        PromosiAdmin::create($data);

        Alert::success('Data Berhasil Ditambahkan', 'Success.');
        return redirect('/promosiadmin');
    }

    public function editpromosiadmin(Request $request, $id)
    {
        $request['promosi'] = DB::table('promosi')
            ->where('id', $id)
            ->get();
        return view('admin.promosi.editpromosiadmin', $request, ["title" => "Data Promosi"]);
    }

    public function aksi_edit_promosi(Request $request, $id)
    {
        $data = $request->validate([
            'nama_promosi'      => 'required',
            'deskripsi_singkat' => 'required',
            'tgl_awal'          => 'required|date',
            'tgl_akhir'         => 'required|date',
            'harga_awal'        => 'required',
            'harga_promo'       => 'required',
            'sk'                => 'required',
            'latitude'          => 'required',
            'longitude'         => 'required',
            'photo'             => 'nullable|file|image|mimes:png,jpg,jpeg',
        ]);

        $tgl_awal = str_replace(PHP_EOL, "\n", $request->tgl_awal); // Mengganti newline dengan \n
        $tgl_akhir = str_replace(PHP_EOL, "\n", $request->tgl_akhir); // Mengganti newline dengan \n
        $data['sk'] = str_replace(PHP_EOL, '<br><br>', $data['sk']); // Mengganti newline dengan <br><br>
        $data['tgl_awal'] = $tgl_awal;
        $data['tgl_akhir'] = $tgl_akhir;

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/photo_promosi/', $fileName);
            $data['photo'] = $fileName;

            // Hapus foto lama jika ada
            $oldPhoto = $request->input('oldPhoto');
            Storage::delete('public/photo_promosi/' . $oldPhoto);
        } else {
            // Jika foto tidak diubah, gunakan foto lama
            $data['photo'] = $request->input('oldPhoto');
        }

        // Memisahkan deskripsi singkat dengan enter
        $deskripsiSingkat = str_replace("\n", PHP_EOL, $request->input('deskripsi_singkat'));
        $data['deskripsi_singkat'] = $deskripsiSingkat;

        $data['sk'] = htmlspecialchars_decode($data['sk']);

        // Simpan data latitude dan longitude
        $data['latitude'] = $request->input('latitude');
        $data['longitude'] = $request->input('longitude');

        PromosiAdmin::find($id)->update($data);

        Alert::success('Data Berhasil Diedit', 'Success.');
        return redirect('/promosiadmin');
    }


    public function hapus($id)
    {
        $promosi = PromosiAdmin::find($id);

        // Menghapus foto dari storage jika ada
        if ($promosi->photo) {
            Storage::delete('public/photo_promosi/' . $promosi->photo);
        }

        $promosi->delete();

        Alert::success('Data Berhasil Dihapus', 'Success.');
        return redirect('/promosiadmin');
    }
    public function eeksportpdf()
    {
        $promosi = PromosiAdmin::all();

        $pdf = PDF::loadView('admin.promosi.promosiadmin-pdf', compact('promosi'));

        return $pdf->stream('promosi.pdf');
    }
    public function ekksportexcel()
    {
        return Excel::download(new PromosiAdminExport, 'DataPromosi.xlsx');
    }
}
