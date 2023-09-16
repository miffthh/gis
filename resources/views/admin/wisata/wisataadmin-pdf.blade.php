<!DOCTYPE html>
<html>

<head>
    <style>
        @page {
            margin: 1cm 1cm 1cm 1cm;
            size: landscape;
        }

        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #customers td,
        #customers th {
            border: 1px solid #ddd;
            padding: 8px;
            font-size: 9px;
        }

        #customers tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #customers tr:hover {
            background-color: #ddd;
        }

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #04AA6D;
            color: white;
            font-size: 9px;
        }

        .footer {
            position: fixed;
            left: 1cm;
            bottom: 1cm;
            right: 1cm;
            text-align: right;
            font-size: 9px;
            margin-bottom: 20px; /* Jarak tambahan */
        }

        .signature {
            margin-top: 20px; /* Jarak antara nama penanggung jawab dan garis */
        }

        .staff {
            font-size: 13px; /* Font size untuk staff penanggung jawab */
        }

        .user {
            font-size: 13px; /* Font size untuk pengguna yang login */
        }
    </style>
</head>

<body>

    <h1>Data Wisata</h1>

    <table id="customers">
        <tr>
            <th cscope="row">No</th>
            <th>Nama Wisata</th>
            <th>Kategori Wisata</th>
            <th>Deskripsi Singkat</th>
            <th>Harga Tiket</th>
            <th>Akses Kendaraan</th>
            <th>Jam Operasional</th>
            <th>Website</th>
            <th>Kontak</th>
            <th>Fasilitas</th>
            <th>Alamat</th>
            <th>Latitude</th>
            <th>Longitude</th>
        </tr>
        @php
            $no = 1;
        @endphp
        @foreach ($wisata as $index => $w)
            <tr>
                <td scope="row">{{ $no++ }}</td>
                <td>{{ $w->nama_wisata }}</td>
                <td>{{ $w->kategori }}</td>
                <td>{{ $w->deskripsi_singkat }}</td>
                <td>Rp. {{ $w->harga_tiket }}</td>
                <td>{{ $w->akses_kendaraan }}</td>
                <td>{{ $w->jam_operasional }}</td>
                <td>{{ $w->website }}</td>
                <td>{{ $w->kontak }}</td>
                <td>{{ $w->fasilitas }}</td>
                <td>{{ $w->alamat }}</td>
                <td>{{ $w->latitude }}</td>
                <td>{{ $w->longitude }}</td>
            </tr>
        @endforeach
    </table>

    <div class="footer">
        <div class="signature">
            <span class="staff">Staff Penanggung Jawab:</span>
            <br> <!-- Tambahkan baris baru untuk jarak -->
            <br> <!-- Tambahkan baris baru untuk jarak -->
            <br> <!-- Tambahkan baris baru untuk jarak -->
            <br>
            <u class="user">{{ Auth::user()->name }}</u>
        </div>
    </div>
</body>

</html>
