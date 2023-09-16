<!DOCTYPE html>
<html>
<head>
    <title>Data Resto</title>
</head>
<body>
    <table style="border-collapse: collapse;">
        <thead>
            <tr>
                <th colspan="7" rowspan="2" align="center" style="vertical-align: middle; border: 1px solid black;"><strong>Data Resto dan Cafe di Kabupaten Bandung</strong></th>
            </tr>
            <tr></tr>
            <tr style="border: 1px solid black;">
                <th align="center" style="background-color: green; border: 1px solid black;">No</th>
                <th align="center" style="background-color: green; border: 1px solid black;">Nama Resto</th>
                <th align="center" style="background-color: green; border: 1px solid black;">Kategori Resto</th>
                <th align="center" style="background-color: green; border: 1px solid black;">Deskripsi Singkat</th>
                <th align="center" style="background-color: green; border: 1px solid black;">Jam Operasional</th>
                <th align="center" style="background-color: green; border: 1px solid black;">Kontak</th>
                <th align="center" style="background-color: green; border: 1px solid black;">Alamat</th>
                <th align="center" style="background-color: green; border: 1px solid black;">Laitude</th>
                <th align="center" style="background-color: green; border: 1px solid black;">Longitude</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach ($resto as $r)
                <tr style="border-collapse: collapse;">
                    <td align="center" scope="row" style="vertical-align: middle; border: 1px solid black;">{{ $no++ }}</td>
                    <td style="vertical-align: middle; border: 1px solid black;">{{ $r->nama_resto }}</td>
                    <td style="vertical-align: middle; border: 1px solid black;">{{ $r->kategori_resto }}</td>
                    <td style="vertical-align: middle; border: 1px solid black;">{!! nl2br($r->deskripsi_singkat) !!}</td>
                    <td style="vertical-align: middle; border: 1px solid black;">{!! nl2br($r->jam_operasional) !!}</td>
                    <td style="vertical-align: middle; border: 1px solid black;">{{ $r->kontak }}</td>
                    <td style="vertical-align: middle; border: 1px solid black;">{{ $r->alamat }}</td>
                    <td style="vertical-align: middle; border: 1px solid black;">{{ $r->latitude }}</td>
                    <td style="vertical-align: middle; border: 1px solid black;">{{ $r->longitude }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
