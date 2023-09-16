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

    <h1>Data Promosi</h1>

    <table id="customers">
        <tr>
            <th cscope="row">No</th>
            <th>Nama Promosi</th>
            <th>Deskripsi Singkat</th>
            <th>Dari Tanggal</th>
            <th>Sampai Tanggal</th>
            <th>Harga Awal</th>
            <th>Harga Promo</th>
            <th>Syarat & Ketentuan</th>
            <th>Latitude</th>
            <th>Longitude</th>
        </tr>
        @php
            $no = 1;
        @endphp
        @foreach ($promosi as $index => $p)
            <tr>
                <td scope="row">{{ $no++ }}</td>
                <td>{{ $p->nama_promosi }}</td>
                <td>{!! nl2br($p->deskripsi_singkat) !!}</td>
                <td>{{ $p->tgl_awal }}</td>
                <td>{{ $p->tgl_akhir }}</td>
                <td>{{ $p->harga_awal }}</td>
                <td>{{ $p->harga_promo }}</td>
                <td>{!! nl2br($p->sk) !!}</td>
                <td>{{ $p->latitude }}</td>
                <td>{{ $p->longitude }}</td>
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
