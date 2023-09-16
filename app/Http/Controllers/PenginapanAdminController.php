<?php

namespace App\Http\Controllers;

use PDF;
use Illuminate\Http\Request;
use App\Models\PenginapanAdmin;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PenginapanAdminExport;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Contracts\Service\Attribute\Required;

class PenginapanAdminController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $penginapan = DB::table('penginapan')
                ->where('nama_penginapan', 'LIKE', '%' . $request->search . '%')
                ->paginate(10);
        } else {
            $penginapan = DB::table('penginapan')->paginate(10);
        }

        return view('admin.penginapan.penginapanadmin', compact(['penginapan']), ["title" => "Data Penginapan"]);
    }

    public function tambahpenginapanadmin()
    {
        return view('admin.penginapan.tambahpenginapanadmin', ["title" => "Data Penginapan"]);
    }

    public function aksi_tambah_penginapan(Request $request)
    {
        $data = $request->validate([
            'nama_penginapan'       => 'required',
            'kategori_penginapan'   => 'required',
            'deskripsi_singkat'     => 'required',
            'website'               => 'required',
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
            $file1->storeAs('public/photo_penginapan/', $fileName1);
            $data['photo1'] = $fileName1;
        }

        if ($request->hasFile('photo2')) {
            $file2 = $request->file('photo2');
            $fileName2 = uniqid() . '.' . $file2->getClientOriginalExtension();
            $file2->storeAs('public/photo_penginapan/', $fileName2);
            $data['photo2'] = $fileName2;
        }

        if ($request->hasFile('photo3')) {
            $file3 = $request->file('photo3');
            $fileName3 = uniqid() . '.' . $file3->getClientOriginalExtension();
            $file3->storeAs('public/photo_penginapan/', $fileName3);
            $data['photo3'] = $fileName3;
        }

        // Memisahkan deskripsi singkat dengan enter
        $deskripsiSingkat = str_replace("\n", PHP_EOL, $request->input('deskripsi_singkat'));
        $data['deskripsi_singkat'] = $deskripsiSingkat;

        // Simpan data lokasi GIS
        $data['latitude'] = $request->input('latitude');
        $data['longitude'] = $request->input('longitude');

        PenginapanAdmin::create($data);
        Alert::success('Data Berhasil Ditambahkan', 'Success.');
        return redirect('/penginapanadmin');
    }

    public function editpenginapanadmin(Request $request)
    {
        $id = $request->id;

        $request['penginapan'] = DB::table('penginapan')
            ->where('id', $id)
            ->get();
        return view('admin.penginapan.editpenginapanadmin', $request, ["title" => "Data Penginapan"]);
    }

    public function aksi_edit_penginapan(Request $request, $id)
    {
        $data = $request->validate([
            'nama_penginapan'       => 'required',
            'kategori_penginapan'   => 'required',
            'deskripsi_singkat'     => 'required',
            'website'               => 'required',
            'kontak'                => 'required',
            'alamat'                => 'required',
            'latitude'              => 'required',
            'longitude'             => 'required',
            'photo1'                => 'nullable|file|image|mimes:png,jpg,jpeg',
            'photo2'                => 'nullable|file|image|mimes:png,jpg,jpeg',
            'photo3'                => 'nullable|file|image|mimes:png,jpg,jpeg'
        ]);

        $penginapan = PenginapanAdmin::find($id);

        if ($request->hasFile('photo1')) {
            $photo1 = $request->file('photo1');
            $photo1Name = uniqid() . '.' . $photo1->getClientOriginalExtension();
            $photo1->storeAs('public/photo_penginapan/', $photo1Name);

            Storage::delete('public/photo_penginapan/' . $penginapan->photo1);

            $data['photo1'] = $photo1Name;
        }

        if ($request->hasFile('photo2')) {
            $photo2 = $request->file('photo2');
            $photo2Name = uniqid() . '.' . $photo2->getClientOriginalExtension();
            $photo2->storeAs('public/photo_penginapan/', $photo2Name);

            Storage::delete('public/photo_penginapan/' . $penginapan->photo2);

            $data['photo2'] = $photo2Name;
        }

        if ($request->hasFile('photo3')) {
            $photo3 = $request->file('photo3');
            $photo3Name = uniqid() . '.' . $photo3->getClientOriginalExtension();
            $photo3->storeAs('public/photo_penginapan/', $photo3Name);

            Storage::delete('public/photo_penginapan/' . $penginapan->photo3);

            $data['photo3'] = $photo3Name;
        }

        // Simpan data latitude dan longitude
        $data['latitude'] = $request->input('latitude');
        $data['longitude'] = $request->input('longitude');

        $penginapan->update($data);

        Alert::success('Data Berhasil Diubah', 'Success.');
        return redirect('/penginapanadmin');
    }

    public function hapus($id)
    {
        $penginapan = PenginapanAdmin::find($id);

        // Menghapus foto dari storage jika ada
        if ($penginapan->photo1) {
            Storage::delete('public/photo_penginapan/' . $penginapan->photo1);
        }

        if ($penginapan->photo2) {
            Storage::delete('public/photo_penginapan/' . $penginapan->photo2);
        }

        if ($penginapan->photo3) {
            Storage::delete('public/photo_penginapan/' . $penginapan->photo3);
        }

        $penginapan->delete();

        // Alert::success('Data Berhasil Dihapus', 'Success.');
        return redirect('/penginapanadmin');
    }

    public function ekspoortpdf()
    {
        $penginapan = PenginapanAdmin::all();

        $pdf = PDF::loadView('admin.penginapan.penginapanadmin-pdf', compact('penginapan'));

        return $pdf->stream('penginapan.pdf');
    }
    public function eksportexcell()
    {
        return Excel::download(new PenginapanAdminExport, 'datapenginapan.xlsx');
    }
}
