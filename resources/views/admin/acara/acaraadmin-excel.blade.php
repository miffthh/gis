<!DOCTYPE html>
<html lang="en">

<head>
</head>

<body>
    <table style="border-collapse: collapse;">
        <tr>
            <th colspan="7" rowspan="2" align="center" style="vertical-align: middle; border: 1px solid black;"><strong>Data Acara di Kabupaten Bandung</strong></th>
        </tr>
        <tr></tr>
        <tr style="border: 1px solid black;">
            <th align="center" style="background-color: green; border: 1px solid black;"><b>No</b></th>
            <th align="center" style="background-color: green; border: 1px solid black;"><b>Nama Acara</b></th>
            <th align="center" style="background-color: green; border: 1px solid black;"><b>Kategori Acara</b></th>
            <th align="center" style="background-color: green; border: 1px solid black;"><b>Deskripsi Singkat</b></th>
            <th align="center" style="background-color: green; border: 1px solid black;"><b>Tanggal</b></th>
            <th align="center" style="background-color: green; border: 1px solid black;"><b>Hadiah</b></th>
            <th align="center" style="background-color: green; border: 1px solid black;"><b>Kontak</b></th>
            <th align="center" style="background-color: green; border: 1px solid black;"><b>Alamat</b></th>
            <th align="center" style="background-color: green; border: 1px solid black;"><b>Latitude</b></th>
            <th align="center" style="background-color: green; border: 1px solid black;"><b>Longitude</b></th>
        </tr>

        @php
        $no = 1;
        @endphp
        @foreach ($acara as $index => $ac)
        <tr style="border: 1px solid black;">
            <td align="center" scope="row" style="vertical-align: middle; border: 1px solid black;">{{ $no++ }}</td>
            <td style="vertical-align: middle; border: 1px solid black;">{{ $ac->nama_acara }}</td>
            <td style="vertical-align: middle; border: 1px solid black;">{{ $ac->kategori }}</td>
            <td style="vertical-align: middle; border: 1px solid black;">{!! nl2br($ac->deskripsi_singkat) !!}</td>
            <td style="vertical-align: middle; border: 1px solid black;">{{ $ac->tanggal }}</td>
            <td style="vertical-align: middle; border: 1px solid black;">{!! nl2br($ac->hadiah) !!}</td>
            <td style="vertical-align: middle; border: 1px solid black;">{{ $ac->kontak }}</td>
            <td style="vertical-align: middle; border: 1px solid black;">{{ $ac->alamat }}</td>
            <td style="vertical-align: middle; border: 1px solid black;">{{ $ac->latitude }}</td>
            <td style="vertical-align: middle; border: 1px solid black;">{{ $ac->longitude }}</td>
        </tr>

        @endforeach
    </table>
</body>

</html>
