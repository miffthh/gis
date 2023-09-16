<!DOCTYPE html>
<html lang="en">

<head>
</head>

<body>
    <table style="border-collapse: collapse;">
        <tr>
            <th colspan="7" rowspan="2" align="center" style="vertical-align: middle; border: 1px solid black;"><strong>Data Penginapan di Kabupaten Bandung</strong></th>
        </tr>
        <tr></tr>
        <tr style="border: 1px solid black;">
            <th align="center" style="background-color: green; border: 1px solid black;"><b>No</b></th>
            <th align="center" style="background-color: green; border: 1px solid black;"><b>Nama Penginapan</b></th>
            <th align="center" style="background-color: green; border: 1px solid black;"><b>Kategori Penginapan</b></th>
            <th align="center" style="background-color: green; border: 1px solid black;"><b>Deskripsi Singkat</b></th>
            <th align="center" style="background-color: green; border: 1px solid black;"><b>Website</b></th>
            <th align="center" style="background-color: green; border: 1px solid black;"><b>Kontak</b></th>
            <th align="center" style="background-color: green; border: 1px solid black;"><b>Alamat</b></th>
            <th align="center" style="background-color: green; border: 1px solid black;"><b>Latitude</b></th>
            <th align="center" style="background-color: green; border: 1px solid black;"><b>Longitude</b></th>
        </tr>

        @php
        $no = 1;
        @endphp
        @foreach ($penginapan as $index => $p)
        <tr style="border: 1px solid black;">
            <td align="center" scope="row" style="vertical-align: middle; border: 1px solid black;">{{ $no++ }}</td>
            <td style="vertical-align: middle; border: 1px solid black;">{{ $p->nama_penginapan }}</td>
            <td style="vertical-align: middle; border: 1px solid black;">{{ $p->kategori_penginapan }}</td>
            <td style="vertical-align: middle; border: 1px solid black;">{!! nl2br($p->deskripsi_singkat) !!}</td>
            <td style="vertical-align: middle; border: 1px solid black;">{{ $p->website }}</td>
            <td style="vertical-align: middle; border: 1px solid black;">{{ $p->kontak }}</td>
            <td style="vertical-align: middle; border: 1px solid black;">{{ $p->alamat }}</td>
            <td style="vertical-align: middle; border: 1px solid black;">{{ $p->latitude }}</td>
            <td style="vertical-align: middle; border: 1px solid black;">{{ $p->longitude }}</td>
        </tr>

        @endforeach
    </table>
</body>

</html>
