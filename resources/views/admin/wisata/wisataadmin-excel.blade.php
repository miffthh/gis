<!DOCTYPE html>
<html lang="en">

<head>
</head>

<body>
    <table style="border-collapse: collapse;">
        <tr>
            <th colspan="13" rowspan="2" align="center" style="vertical-align: middle; border: 1px solid black;">
                <strong>Data Wisata di Kabupaten Bandung</strong></th>
        </tr>
        <tr></tr>
        <tr style="border: 1px solid black;">
            <th align="center" style="background-color: green; border: 1px solid black;"><b>No</b></th>
            <th align="center" style="background-color: green; border: 1px solid black;"><b>Nama Wisata</b></th>
            <th align="center" style="background-color: green; border: 1px solid black;"><b>Kategori Wisata</b></th>
            <th align="center" style="background-color: green; border: 1px solid black;"><b>Deskripsi Singkat</b></th>
            <th align="center" style="background-color: green; border: 1px solid black;"><b>Harga Tiket</b></th>
            <th align="center" style="background-color: green; border: 1px solid black;"><b>Akses Kendaraan</b></th>
            <th align="center" style="background-color: green; border: 1px solid black;"><b>Jam Operasional</b></th>
            <th align="center" style="background-color: green; border: 1px solid black;"><b>Website</b></th>
            <th align="center" style="background-color: green; border: 1px solid black;"><b>Kontak</b></th>
            <th align="center" style="background-color: green; border: 1px solid black;"><b>Fasilitas</b></th>
            <th align="center" style="background-color: green; border: 1px solid black;"><b>Alamat</b></th>
            <th align="center" style="background-color: green; border: 1px solid black;"><b>Latitude</b></th>
            <th align="center" style="background-color: green; border: 1px solid black;"><b>Longitude</b></th>
        </tr>

        @php
            $no = 1;
        @endphp
        @foreach ($wisata as $index => $w)
            <tr style="border: 1px solid black;">
                <td align="center" scope="row" style="vertical-align: middle; border: 1px solid black;">
                    {{ $no++ }}</td>
                <td style="vertical-align: middle; border: 1px solid black;">{{ $w->nama_wisata }}</td>
                <td style="vertical-align: middle; border: 1px solid black;">{{ $w->kategori }}</td>
                <td style="vertical-align: middle; border: 1px solid black;">{{ $w->deskripsi_singkat }}</td>
                <td style="vertical-align: middle; border: 1px solid black;">Rp. {{ $w->harga_tiket }}</td>
                <td style="vertical-align: middle; border: 1px solid black;">{!! nl2br($w->akses_kendaraan) !!}</td>
                <td style="vertical-align: middle; border: 1px solid black;">{{ $w->jam_operasional }}</td>
                <td style="vertical-align: middle; border: 1px solid black;">{{ $w->website }}</td>
                <td style="vertical-align: middle; border: 1px solid black;">{{ $w->kontak }}</td>
                <td style="vertical-align: middle; border: 1px solid black;">{!! nl2br($w->fasilitas) !!}</td>
                <td style="vertical-align: middle; border: 1px solid black;">{{ $w->alamat }}</td>
                <td style="vertical-align: middle; border: 1px solid black;">{{ $w->latitude }}</td>
                <td style="vertical-align: middle; border: 1px solid black;">{{ $w->longitude }}</td>
            </tr>
        @endforeach
    </table>
</body>

</html>
