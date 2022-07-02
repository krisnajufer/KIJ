<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Klasifikasi Tahun {{ $start_date }} - {{ $end_date }}
    </title>
    <link type="text/css" rel="stylesheet"
        href="{{ ltrim(public_path('SBAdmin2/assets/css/sb-admin-2.min.css'), '/') }}">
    <link type="text/css" rel="stylesheet"
        href="{{ ltrim(public_path('SBAdmin2/assets/vendor/datatables/dataTables.bootstrap4.min.css'), '/') }}">

    <style>
        body {
            color: black;
        }

        .print {
            margin-top: 10px;
        }

        @media print {
            .print {
                display: none;
            }
        }

        /* table {
            border-collapse: collapse;
        } */
    </style>
</head>

<body>
    <center>

        <h3 class="text-center mt-2 mb-2">PT. Young Multi Sarana</h3>
        <p class="text-center mt-2 mb-2">Jl. Kyai Tambak Deres No.229, Bulak, Kec. Bulak, Kota SBY, Jawa Timur</p>
        <p class="text-center mt-2 mb-2">No. Telepon: 08970055457 | Email: yms@gmail.com</p>
        <hr style="border: 2;">
        <h4 class="text-center mt-2 mb-2">Laporan Klasifikasi Tahun {{ $start_date }} - {{ $end_date }}</h4>

    </center>

    <div class="card-body">
        <div class="table-responsive">

            {{-- <br>
            <br>
            <br>
            <p><b>DAFTAR BAHAN BAKU:</b></p> --}}

            <div class="table-responsive">
                <table border="1" cellspacing="" cellpadding="4" width="100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID Klasifikasi</th>
                            <th>Nama Barang</th>
                            <th>Permintaan Tahunan</th>
                            <th>Persentase Biaya</th>
                            <th>Persentase Kumulatif</th>
                            <th>Klasifikasi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @php
                            $number = 1;
                            $hasil = 0;
                            $total = 0;
                            foreach ($details as $detail) {
                                $total += $detail->costxpertahun;
                            }
                        @endphp
                        @foreach ($details as $no => $detail)
                            <tr>
                                <td align="center">{{ $number++ }}&nbsp;</td>
                                <td align="center">{{ $detail->klasifikasi_id }}</td>
                                <td align="center">{{ $detail->nama_barang }}</td>
                                <td align="center">{{ $detail->permintaan_tahunan }}</td>
                                <td align="center">{{ $detail->persentase_biaya }}%</td>
                                <td align="center">
                                    @php
                                        $decimal = round(($detail->costxpertahun / $total) * 100, 2);
                                        $hasil += $decimal;
                                        echo $hasil . ' %';
                                    @endphp
                                </td>
                                <td align="center">{{ $detail->klasifikasi }}</td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>

        </div>
    </div>

</body>

</html>
