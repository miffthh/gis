<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\RestoAdmin;
use Illuminate\Http\Request;
use App\Exports\RestoAdminExport;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Contracts\Service\Attribute\Required;

class RestoAdminController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $resto = DB::table('resto')
                ->where('nama_resto', 'LIKE', '%' . $request->search . '%')
                ->paginate(10);
        } else {
            $resto = DB::table('resto')->paginate(10);
        }

        return view('admin.resto.restoadmin', compact(['resto']), ["title" => "Data Resto"]);
    }

    public function tambahrestoadmin()
    {
        return view('admin.resto.tambahrestoadmin', ["title" => "Data resto"]);
    }

    public function aksi_tambah_resto(Request $request)
    {
        $data = $request->validate([
            'nama_resto'            => 'required',
            'kategori_resto'        => 'required',
            'deskripsi_singkat'     => 'required',
            'jam_operasional'       => 'required',
            'kontak'                => 'required',
            'alamat'                => 'required',
            'latitude'              => 'required',
            'longitude'             => 'required',
            'photo1'                => 'nullable|file|image|mimes:png,jpg,jpeg',
            'photo2'                => 'nullable|file|image|mimes:png,jpg,jpeg',
            'photo3'                => 'nullable|file|image|mimes:png,jpg,jpeg'
        ]);

        if ($request->hasFile('photo1')) {
            $file1 = $request->file('photo1');
            $fileName1 = uniqid() . '.' . $file1->getClientOriginalExtension();
            $file1->storeAs('public/photo_resto/', $fileName1);
            $data['photo1'] = $fileName1;
        }

        if ($request->hasFile('photo2')) {
            $file2 = $request->file('photo2');
            $fileName2 = uniqid() . '.' . $file2->getClientOriginalExtension();
            $file2->storeAs('public/photo_resto/', $fileName2);
            $data['photo2'] = $fileName2;
        }

        if ($request->hasFile('photo3')) {
            $file3 = $request->file('photo3');
            $fileName3 = uniqid() . '.' . $file3->getClientOriginalExtension();
            $file3->storeAs('public/photo_resto/', $fileName3);
            $data['photo3'] = $fileName3;
        }

        // Memisahkan deskripsi singkat dengan enter
        $deskripsiSingkat = str_replace("\n", PHP_EOL, $request->input('deskripsi_singkat'));
        $data['deskripsi_singkat'] = $deskripsiSingkat;

        // Memisahkan jam operasional dengan enter
        $jamOperasional = str_replace("\n", PHP_EOL, $request->input('jam_operasional'));
        $data['jam_operasional'] = $jamOperasional;

        // Simpan latitude dan longitude
        $data['latitude'] = $request->input('latitude');
        $data['longitude'] = $request->input('longitude');

        RestoAdmin::create($data);
        Alert::success('Data Berhasil Ditambahkan', 'Success.');
        return redirect('/restoadmin');
    }

    public function editrestoadmin(Request $request)
    {
        $id = $request->id;

        $request['resto'] = DB::table('resto')
            ->where('id', $id)
            ->get();
        return view('admin.resto.editrestoadmin', $request, ["title" => "Data Resto"]);
    }

    public function aksi_edit_resto(Request $request, $id)
    {
        $data = $request->validate([
            'nama_resto'            => 'required',
            'kategori_resto'        => 'required',
            'deskripsi_singkat'     => 'required',
            'jam_operasional'       => 'required',
            'kontak'                => 'required',
            'alamat'                => 'required',
            'latitude'              => 'required',
            'longitude'             => 'required',
            'photo1'                => 'nullable|file|image|mimes:png,jpg,jpeg',
            'photo2'                => 'nullable|file|image|mimes:png,jpg,jpeg',
            'photo3'                => 'nullable|file|image|mimes:png,jpg,jpeg'
        ]);

        $resto = RestoAdmin::find($id);

        if ($request->hasFile('photo1')) {
            $photo1 = $request->file('photo1');
            $photo1Name = uniqid() . '.' . $photo1->getClientOriginalExtension();
            $photo1->storeAs('public/photo_resto/', $photo1Name);

            Storage::delete('public/photo_resto/' . $resto->photo1);

            $data['photo1'] = $photo1Name;
        }

        if ($request->hasFile('photo2')) {
            $photo2 = $request->file('photo2');
            $photo2Name = uniqid() . '.' . $photo2->getClientOriginalExtension();
            $photo2->storeAs('public/photo_resto/', $photo2Name);

            Storage::delete('public/photo_resto/' . $resto->photo2);

            $data['photo2'] = $photo2Name;
        }

        if ($request->hasFile('photo3')) {
            $photo3 = $request->file('photo3');
            $photo3Name = uniqid() . '.' . $photo3->getClientOriginalExtension();
            $photo3->storeAs('public/photo_resto/', $photo3Name);

            Storage::delete('public/photo_resto/' . $resto->photo3);

            $data['photo3'] = $photo3Name;
        }

        // Simpan data latitude dan longitude
        $data['latitude'] = $request->input('latitude');
        $data['longitude'] = $request->input('longitude');

        $resto->update($data);

        Alert::success('Data Berhasil Diubah', 'Success.');
        return redirect('/restoadmin');
    }


    public function hapus($id)
    {
        $resto = RestoAdmin::find($id);

        // Menghapus foto dari storage jika ada
        if ($resto->photo1) {
            Storage::delete('public/photo_resto/' . $resto->photo1);
        }

        if ($resto->photo2) {
            Storage::delete('public/photo_resto/' . $resto->photo2);
        }

        if ($resto->photo3) {
            Storage::delete('public/photo_resto/' . $resto->photo3);
        }

        $resto->delete();

        return redirect('/restoadmin');
    }

    public function ekspooortpdf()
    {
        $resto = RestoAdmin::all();

        $pdf = PDF::loadView('admin.resto.restoadmin-pdf', compact('resto'));

        return $pdf->stream('resto.pdf');
    }
    public function eeksportexceel()
    {
        return Excel::download(new RestoAdminExport, 'dataresto.xlsx');
    }
}
