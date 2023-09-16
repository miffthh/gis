<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use App\Models\AcaraAdmin;
use App\Models\RestoAdmin;
use App\Models\WisataAdmin;
use App\Models\PromosiAdmin;
use Illuminate\Http\Request;
use App\Models\PenginapanAdmin;
use App\Http\Controllers\Controller;
use App\Models\Forum;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        $wisata = WisataAdmin::whereNotNull('latitude')->whereNotNull('longitude')->get();
        $penginapan = PenginapanAdmin::whereNotNull('latitude')->whereNotNull('longitude')->get();
        $resto = RestoAdmin::whereNotNull('latitude')->whereNotNull('longitude')->get();
        $event = AcaraAdmin::whereNotNull('latitude')->whereNotNull('longitude')->get();
        $promosi = PromosiAdmin::whereNotNull('latitude')->whereNotNull('longitude')->get();
        $title = 'Home';

        return view('/home', compact('wisata', 'penginapan', 'resto', 'event', 'promosi', 'title'));
    }
    public function wisata(Request $request)
    {
        $search = $request->input('search');

        $query = WisataAdmin::query();

        if ($search) {
            $query->where('nama_wisata', 'like', '%' . $search . '%');
        }

        $wisata = $query->get();

        return view('pengguna.wisata.wisata', ['wisata' => $wisata, 'title' => 'Data Wisata']);
    }
    public function detailwisata($id)
    {
        $wisata = WisataAdmin::findOrFail($id);

        return view('pengguna.wisata.detailwisata', compact('wisata'))->with('title', 'Detail Wisata');
    }
    public function rutewisata($id)
    {
        $wisata = WisataAdmin::findOrFail($id);

        return view('pengguna/wisata/rutewisata', compact('wisata'))->with('title', 'Rute Wisata');
    }

    // public function carirute(Request $request)
    // {
    //     $lokasiPengguna = $request->input('lokasi_pengguna');
    //     $lokasiWisata = $request->input('lokasi_wisata');

    //     $client = new Client();

    //     $response = $client->request('GET', 'https://maps.googleapis.com/maps/api/directions/json', [
    //         'query' => [
    //             'origin' => $lokasiPengguna,
    //             'destination' => $lokasiWisata,
    //             'key' => 'API_KEY_ANDA',
    //         ]
    //     ]);

    //     $data = json_decode($response->getBody(), true);

    //     $rute = [];

    //     if ($data['status'] === 'OK') {
    //         $legs = $data['routes'][0]['legs'][0];

    //         $rute['jarak'] = $legs['distance']['text'];
    //         $rute['durasi'] = $legs['duration']['text'];
    //         $rute['petunjuk'] = [];

    //         foreach ($legs['steps'] as $step) {
    //             $rute['petunjuk'][] = $step['html_instructions'];
    //         }
    //     }

    //     return response()->json($rute);
    // }
    public function penginapan(Request $request)
    {
        $search = $request->input('search');

        $query = PenginapanAdmin::query();

        if ($search) {
            $query->where('nama_penginapan', 'like', '%' . $search . '%');
        }

        $penginapan = $query->get();

        return view('pengguna.penginapan.penginapan', ['penginapan' => $penginapan, 'title' => 'Data Penginapan']);
    }
    public function detailpenginapan($id)
    {
        $penginapan = PenginapanAdmin::findOrFail($id);

        return view('pengguna.penginapan.detailpenginapan', compact('penginapan'))->with('title', 'Detail Penginapan');
    }
    public function rutepenginapan($id)
    {
        $penginapan = PenginapanAdmin::findOrFail($id);

        return view('pengguna/penginapan/rutepenginapan', compact('penginapan'))->with('title', 'Rute Penginapan');
    }
    public function resto(Request $request)
    {
        $search = $request->input('search');

        $query = RestoAdmin::query();

        if ($search) {
            $query->where('nama_resto', 'like', '%' . $search . '%');
        }

        $resto = $query->get();

        return view('pengguna.resto.resto', ['resto' => $resto, 'title' => 'Data Resto']);
    }
    public function detailresto($id)
    {
        $resto = RestoAdmin::findOrFail($id);

        return view('pengguna.resto.detailresto', compact('resto'))->with('title', 'Detail Resto');
    }
    public function ruteresto($id)
    {
        $resto = RestoAdmin::findOrFail($id);

        return view('pengguna/resto/ruteresto', compact('resto'))->with('title', 'Rute Resto');
    }
    public function event(Request $request)
    {
        $search = $request->input('search');

        $query = AcaraAdmin::query();

        if ($search) {
            $query->where('nama_acara', 'like', '%' . $search . '%');
        }

        $event = $query->get();

        return view('pengguna.event.event', ['event' => $event, 'title' => 'Data Acara']);
    }
    public function detailevent($id)
    {
        $event = AcaraAdmin::findOrFail($id);

        return view('pengguna.event.detailevent', compact('event'))->with('title', 'Detail Acara');
    }
    public function ruteevent($id)
    {
        $event = AcaraAdmin::findOrFail($id);

        return view('pengguna/event/ruteevent', compact('event'))->with('title', 'Rute Acara');
    }
    public function promosi(Request $request)
    {
        $search = $request->input('search');

        $query = PromosiAdmin::query();

        if ($search) {
            $query->where('nama_promosi', 'like', '%' . $search . '%');
        }

        $promosi = $query->get();

        return view('pengguna.promosi.promosi', ['promosi' => $promosi, 'title' => 'Data Promosi']);
    }
    public function detailpromosi($id)
    {
        $promosi = PromosiAdmin::findOrFail($id);

        return view('pengguna.promosi.detailpromosi', compact('promosi'))->with('title', 'Detail Promosi');
    }
    public function rutepromosi($id)
    {
        $promosi = PromosiAdmin::findOrFail($id);

        return view('pengguna/promosi/rutepromosi', compact('promosi'))->with('title', 'Rute Promosi');
    }
    public function lihatRute($type, $id)
    {
        $data = null;

        // Ambil data berdasarkan jenis lokasi
        if ($type === 'wisata') {
            $data = WisataAdmin::find($id);
        } elseif ($type === 'penginapan') {
            $data = PenginapanAdmin::find($id);
        } elseif ($type === 'resto') {
            $data = RestoAdmin::find($id);
        } elseif ($type === 'resto') {
            $data = AcaraAdmin::find($id);
        }elseif ($type === 'resto') {
            $data = PromosiAdmin::find($id);
        }
        // Tambahkan pernyataan elseif yang serupa untuk jenis lokasi lainnya
        // Misal: elseif ($type === 'jenis_lokasi_lain') { $data = JenisLokasiLain::find($id); }

        // Kirimkan data yang spesifik ke view
        return view('lihatrute', compact('data'));
    }
}
