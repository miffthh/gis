<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\AcaraAdmin;
use Illuminate\Http\Request;
use App\Exports\AcaraAdminExport;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Contracts\Service\Attribute\Required;

class AcaraAdminController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $acara = DB::table('acara')
                ->where('nama_acara', 'LIKE', '%' . $request->search . '%')
                ->paginate(10);
        } else {
            $acara = DB::table('acara')->paginate(10);
        }

        return view('admin.acara.acaraadmin', compact(['acara']), ["title" => "Data acara"]);
    }

    public function tambahacaraadmin()
    {
        return view('admin.acara.tambahacaraadmin', ["title" => "Data Acara"]);
    }

    public function aksi_tambah_acara(Request $request)
    {
        $request->validate([
            'nama_acara' => 'required',
            'kategori' => 'required',
            'deskripsi_singkat' => 'required',
            'tanggal' => 'required|date',
            'hadiah' => 'required',
            'kontak' => 'required',
            'alamat' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'photo' => 'nullable|file|image|mimes:png,jpg,jpeg',
        ]);

        $hadiah = str_replace(',', "\n", $request->hadiah);

        $data = $request->except(['_token', 'hadiah']);

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/photo_acara/', $fileName);
            $data['photo'] = $fileName;
        }

        // Memisahkan deskripsi singkat dengan enter
        $deskripsiSingkat = str_replace("\n", PHP_EOL, $request->input('deskripsi_singkat'));
        $data['deskripsi_singkat'] = $deskripsiSingkat;

        $data['hadiah'] = $hadiah;

        // Simpan latitude dan longitude
        $data['latitude'] = $request->input('latitude');
        $data['longitude'] = $request->input('longitude');

        AcaraAdmin::create($data);
        Alert::success('Data Berhasil Ditambahkan', 'Success.');
        return redirect('/acaraadmin');
    }

    public function editacaraadmin(Request $request)
    {
        $id = $request->id;

        $acara = DB::table('acara')
            ->where('id', $id)
            ->get();

        return view('admin.acara.editacaraadmin', compact('acara'))->with(["title" => "Data Acara"]);
    }

    public function aksi_edit_acara(Request $request, $id)
    {
        $request->validate([
            'nama_acara' => 'required',
            'kategori' => 'required',
            'deskripsi_singkat' => 'required',
            'tanggal' => 'required|date',
            'hadiah' => 'required',
            'kontak' => 'required',
            'alamat' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'photo' => 'nullable|file|image|mimes:png,jpg,jpeg',
        ]);

        $data = $request->except(['_token']);

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/photo_acara/', $fileName);

            Storage::delete('public/photo_acara/' . $request->oldPhoto);

            $data['photo'] = $fileName;
        } else {
            $data['photo'] = $request->oldPhoto;
        }

        // Memisahkan deskripsi singkat dengan enter
        $deskripsiSingkat = str_replace("\n", PHP_EOL, $request->input('deskripsi_singkat'));
        $data['deskripsi_singkat'] = $deskripsiSingkat;

        // Memisahkan hadiah dengan enter
        $hadiah = str_replace("\n", PHP_EOL, $request->input('hadiah'));
        $data['hadiah'] = $hadiah;

        // Simpan data latitude dan longitude
        $data['latitude'] = $request->input('latitude');
        $data['longitude'] = $request->input('longitude');

        unset($data['oldPhoto']); // Menghapus 'oldPhoto' dari data yang akan diupdate

        AcaraAdmin::find($id)->update($data);
        Alert::success('Data Berhasil Diedit', 'Success.');
        return redirect('/acaraadmin');
    }


    public function hapus($id)
    {
        $acara = AcaraAdmin::find($id);

        if (!$acara) {
            // Objek AcaraAdmin tidak ditemukan
            return redirect('/acaraadmin')->withErrors('Data tidak ditemukan');
        }

        // Menghapus foto dari storage jika ada
        if ($acara->photo) {
            Storage::delete('public/photo_acara/' . $acara->photo);
        }

        $acara->delete();

        return redirect('/acaraadmin');
    }
    public function ekksportpdf()
    {
        $acara = AcaraAdmin::all();

        $pdf = PDF::loadView('admin.acara.acaraadmin-pdf', compact('acara'));

        return $pdf->stream('acara.pdf');
    }
    public function ekssportexcel()
    {
        return Excel::download(new AcaraAdminExport, 'dataacara.xlsx');
    }
}
