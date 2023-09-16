<?php

namespace App\Http\Controllers;

use App\Exports\WisataAdminExport;
use App\Models\Wisata;
use PDF;
use App\Models\WisataAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Contracts\Service\Attribute\Required;


class WisataAdminController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $wisata = DB::table('wisata')
                ->where('nama_wisata', 'LIKE', '%' . $request->search . '%')
                ->paginate(10);
        } else {
            $wisata = DB::table('wisata')->paginate(10);
        }

        return view('admin.wisata.wisataadmin', compact('wisata'))->with(["title" => "Data Wisata"]);
    }

    public function map()
    {
        // Mengambil data wisata dari database
        $wisata = WisataAdmin::all();

        return view('wisata.map', compact('wisata'));
    }
    public function tambahwisataadmin()
    {
        return view('admin.wisata.tambahwisataadmin', ["title" => "Data Wisata"]);
    }

    public function aksi_tambah_wisata(Request $request)
    {
        $validatedData = $request->validate([
            'nama_wisata' => 'required',
            'kategori' => 'required',
            'deskripsi_singkat' => 'required',
            'harga_tiket' => 'required',
            'akses_kendaraan' => 'required|array',
            'jam_operasional' => 'required',
            'website' => 'required',
            'kontak' => 'required',
            'fasilitas' => 'required|array',
            'alamat' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'photo1' => 'nullable|file|image|mimes:png,jpg,jpeg',
            'photo2' => 'nullable|file|image|mimes:png,jpg,jpeg',
            'photo3' => 'nullable|file|image|mimes:png,jpg,jpeg'
        ]);

        $data = $validatedData;

        if ($request->hasFile('photo1')) {
            $file1 = $request->file('photo1');
            $fileName1 = uniqid() . '.' . $file1->getClientOriginalExtension();
            $file1->storeAs('public/photo_wisata/', $fileName1);
            $data['photo1'] = $fileName1;
        }

        if ($request->hasFile('photo2')) {
            $file2 = $request->file('photo2');
            $fileName2 = uniqid() . '.' . $file2->getClientOriginalExtension();
            $file2->storeAs('public/photo_wisata/', $fileName2);
            $data['photo2'] = $fileName2;
        }

        if ($request->hasFile('photo3')) {
            $file3 = $request->file('photo3');
            $fileName3 = uniqid() . '.' . $file3->getClientOriginalExtension();
            $file3->storeAs('public/photo_wisata/', $fileName3);
            $data['photo3'] = $fileName3;
        }

        // Mengubah array akses_kendaraan menjadi string dipisahkan oleh enter
        $aksesKendaraan = implode(PHP_EOL, $data['akses_kendaraan']);
        $data['akses_kendaraan'] = $aksesKendaraan;

        // Mengubah array fasilitas menjadi string dipisahkan oleh enter
        $fasilitas = implode(PHP_EOL, $data['fasilitas']);
        $data['fasilitas'] = $fasilitas;

        // Simpan data lokasi GIS
        $data['latitude'] = $request->input('latitude');
        $data['longitude'] = $request->input('longitude');

        WisataAdmin::create($data);

        Alert::success('Data Berhasil Ditambahkan', 'Success.');
        return redirect('/wisataadmin');
    }

    public function editwisataadmin(Request $request)
    {
        $id = $request->id;

        $request['wisata'] = DB::table('wisata')
            ->where('id', $id)
            ->get();
        return view('admin.wisata.editwisataadmin', $request, ["title" => "Data Wisata"]);
    }

    public function aksi_edit_wisata(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_wisata' => 'required',
            'kategori' => 'required',
            'deskripsi_singkat' => 'required',
            'harga_tiket' => 'required',
            'akses_kendaraan' => 'required|array',
            'jam_operasional' => 'required',
            'website' => 'required',
            'kontak' => 'required',
            'fasilitas' => 'required|array',
            'alamat' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'photo1' => 'nullable|file|image|mimes:png,jpg,jpeg',
            'photo2' => 'nullable|file|image|mimes:png,jpg,jpeg',
            'photo3' => 'nullable|file|image|mimes:png,jpg,jpeg'
        ]);

        $data = $validatedData;

        $wisata = WisataAdmin::findOrFail($id);

        if ($request->hasFile('photo1')) {
            $file1 = $request->file('photo1');
            $fileName1 = uniqid() . '.' . $file1->getClientOriginalExtension();
            $file1->storeAs('public/photo_wisata/', $fileName1);
            Storage::delete('public/photo_wisata/' . $wisata->photo1);
            $data['photo1'] = $fileName1;
        }

        if ($request->hasFile('photo2')) {
            $file2 = $request->file('photo2');
            $fileName2 = uniqid() . '.' . $file2->getClientOriginalExtension();
            $file2->storeAs('public/photo_wisata/', $fileName2);
            Storage::delete('public/photo_wisata/' . $wisata->photo2);
            $data['photo2'] = $fileName2;
        }

        if ($request->hasFile('photo3')) {
            $file3 = $request->file('photo3');
            $fileName3 = uniqid() . '.' . $file3->getClientOriginalExtension();
            $file3->storeAs('public/photo_wisata/', $fileName3);
            Storage::delete('public/photo_wisata/' . $wisata->photo3);
            $data['photo3'] = $fileName3;
        }

        // Mengubah array akses_kendaraan menjadi string dipisahkan oleh enter
        $aksesKendaraan = implode(PHP_EOL, $data['akses_kendaraan']);
        $data['akses_kendaraan'] = $aksesKendaraan;

        // Mengubah array fasilitas menjadi string dipisahkan oleh enter
        $fasilitas = implode(PHP_EOL, $data['fasilitas']);
        $data['fasilitas'] = $fasilitas;

        // Simpan data lokasi GIS
        $data['latitude'] = $request->input('latitude');
        $data['longitude'] = $request->input('longitude');

        $wisata->update($data);

        Alert::success('Data Berhasil Diubah', 'Success.');
        return redirect('/wisataadmin');
    }
    public function hapus($id)
    {
        $wisata = WisataAdmin::find($id);

        // Menghapus foto dari storage jika ada
        if ($wisata->photo1) {
            Storage::delete('public/photo_wisata/' . $wisata->photo1);
        }

        if ($wisata->photo2) {
            Storage::delete('public/photo_wisata/' . $wisata->photo2);
        }

        if ($wisata->photo3) {
            Storage::delete('public/photo_wisata/' . $wisata->photo3);
        }

        $wisata->delete();

        // Alert::success('Data Berhasil Dihapus', 'Success.');
        return redirect('/wisataadmin');
    }

    public function eksportpdf()
    {
        $wisata = WisataAdmin::all();

        $pdf = PDF::loadView('admin.wisata.wisataadmin-pdf', compact('wisata'));

        return $pdf->stream('wisata.pdf');
    }

    public function eksportexcel()
    {
        return Excel::download(new WisataAdminExport, 'datawisata.xlsx');
    }
}
