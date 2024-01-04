
<!DOCTYPE html>
<html>

<head>
    <title>Laporan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <style type="text/css">
        table tr td,
        table tr th {
            font-size: 9pt;
        }
    </style>
    <center>
        <h5>Laporan Surat Masuk    
        </h5>
    </center>

    <table class='table table-bordered' style="table-layout: fixed; ">
        <thead>
            <tr>
                <th style="border-top-left-radius: 20px;"">Tanggal Surat</th>
                <th class="text-center">Tanggal Diterima</th>
                <th class="text-center">No Surat</th>
                <th class="text-center">Perihal</th>
                <th class="text-center">Pengirim</th>
                <th class="text-center">Disposisi</th>
                <th class="text-center">Keterangan</th>
                <th style="border-top-right-radius: 20px;">Jenis Surat</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $row)
                <tr>
                    <td>{{ $row->{'tanggal_surat'} }}</td>
                    <td>{{ $row->{'tanggal_diterima'} }}</td>
                    <td>{{ $row->{'nomor_surat'} }}</td>
                    <td>{{ $row->perihal }}</td>
                    <td>{{ $row->pengirim }}</td>
                    <td>{{ $row->disposisi }}</td>
                    <td>{{ $row->keterangan}}</td>
                    <td>{{ $row->{'nama_jenis'} }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
