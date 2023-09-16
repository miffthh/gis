<!DOCTYPE html>
<html lang="en">

<head>
</head>

<body>
    <table style="border-collapse: collapse;">
        <tr>
            <th colspan="8" rowspan="2" align="center" style="vertical-align: middle; border: 1px solid black;"><strong>Data Promosi di Kabupaten Bandung</strong></th>
        </tr>
        <tr></tr>
        <tr style="border: 1px solid black;">
            <th align="center" style="background-color: green; border: 1px solid black;"><b>No</b></th>
            <th align="center" style="background-color: green; border: 1px solid black;"><b>Nama Promosi</b></th>
            <th align="center" style="background-color: green; border: 1px solid black;"><b>Deskripsi Singkat</b></th>
            <th align="center" style="background-color: green; border: 1px solid black;"><b>Tanggal Awal</b></th>
            <th align="center" style="background-color: green; border: 1px solid black;"><b>Tanggal Akhir</b></th>
            <th align="center" style="background-color: green; border: 1px solid black;"><b>Harga Awal</b></th>
            <th align="center" style="background-color: green; border: 1px solid black;"><b>Harga Promo</b></th>
            <th align="center" style="background-color: green; border: 1px solid black;"><b>Syarat dan Ketentuan</b></th>
            <th align="center" style="background-color: green; border: 1px solid black;"><b>Latitude</b></th>
            <th align="center" style="background-color: green; border: 1px solid black;"><b>Longitude</b></th>
        </tr>

        @php
        $no = 1;
        @endphp
        @foreach ($promosi as $index => $p)
        <tr style="border: 1px solid black;">
            <td align="center" scope="row" style="vertical-align: middle; border: 1px solid black;">{{ $no++ }}</td>
            <td style="vertical-align: middle; border: 1px solid black;">{{ $p->nama_promosi }}</td>
            <td style="vertical-align: middle; border: 1px solid black;">{!! nl2br($p->deskripsi_singkat) !!}</td>
            <td style="vertical-align: middle; border: 1px solid black;">{{ $p->tgl_awal }}</td>
            <td style="vertical-align: middle; border: 1px solid black;">{{ $p->tgl_akhir }}</td>
            <td style="vertical-align: middle; border: 1px solid black;">{{ $p->harga_awal }}</td>
            <td style="vertical-align: middle; border: 1px solid black;">{{ $p->harga_promo }}</td>
            <td style="vertical-align: middle; border: 1px solid black;">{!! nl2br($p->sk) !!}</td>
            <td style="vertical-align: middle; border: 1px solid black;">{{ $p->latitude }}</td>
            <td style="vertical-align: middle; border: 1px solid black;">{{ $p->longitude }}</td>
        </tr>

        @endforeach
    </table>
</body>

</html>
