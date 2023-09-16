<!DOCTYPE html>
<html>

<head>
    <style>
        @page {
            margin: 1cm 1cm 1cm 1cm;
            size: portrait;
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
            margin-bottom: 20px;
            /* Jarak tambahan */
        }

        .signature {
            margin-top: 20px;
            /* Jarak antara nama penanggung jawab dan garis */
        }

        .staff {
            font-size: 13px;
            /* Font size untuk staff penanggung jawab */
        }

        .user {
            font-size: 13px;
            /* Font size untuk pengguna yang login */
        }
    </style>
</head>

<body>

    <h1>Data Resto & Cafe</h1>

    <table id="customers">
        <tr>
            <th cscope="row"> No</th>
            <th>Nama Resto</th>
            <th>Kategori Resto</th>
            <th>Deskripsi Singkat</th>
            <th>Jam Operasional</th>
            <th>Kontak</th>
            <th>Alamat</th>
            <th>Latitude</th>
            <th>Longitude</th>
        </tr>
        @php
            $no = 1;
        @endphp
        @foreach ($resto as $index => $r)
            <tr>
                <td scope="row">{{ $no++ }}</td>
                <td>{{ $r->nama_resto }}</td>
                <td>{{ $r->kategori_resto }}</td>
                <td>{!! nl2br($r->deskripsi_singkat) !!}</td>
                <td>{!! nl2br($r->jam_operasional) !!}</td>
                <td>{{ $r->kontak }}</td>
                <td>{{ $r->alamat }}</td>
                <td>{{ $r->latitude }}</td>
                <td>{{ $r->longitude }}</td>
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
