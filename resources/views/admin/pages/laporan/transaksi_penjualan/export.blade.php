<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Transaksi Penjualan
        @if (Auth::guard('admin')->user()->role == 'gudang' or Auth::guard('admin')->user()->role == 'owner')
            Counter Tahun {{ $periode }}
        @elseif (Auth::guard('admin')->user()->role == 'counter')
            {{ $counter_name }} Tahun {{ $periode }}
        @endif
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

        <h3 class="text-center mt-2 mb-2">PT. KIJ</h3>
        <p class="text-center mt-2 mb-2">Jl. Milenial</p>
        <p class="text-center mt-2 mb-2">No. Telepon: 085850757026 | Email: denyndra.26@gmail.com</p>
        <hr style="border: 2;">
        <h4 class="text-center mt-2 mb-2">Laporan Transaksi Penjualan
            @if (Auth::guard('admin')->user()->role == 'gudang' or Auth::guard('admin')->user()->role == 'owner')
                Counter Tahun {{ $periode }}
            @elseif (Auth::guard('admin')->user()->role == 'counter')
                {{ $counter_name }} Tahun {{ $periode }}
            @endif

        </h4>

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
                            <th>ID Transaksi</th>
                            <th>Counter</th>
                            <th>Tanggal Penjualan</th>
                            <th>Grand Total Penjualan</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($transaksi_penjualans as $no => $transaksi_penjualan)
                            <tr>
                                <td align="center">{{ $no + 1 }}</td>
                                <td align="center">{{ $transaksi_penjualan->transaksi_penjualan_id }}</td>
                                <td align="center">{{ $transaksi_penjualan->name }}</td>
                                <td align="center">
                                    @php
                                        $date = date_create($transaksi_penjualan->tanggal_penjualan);
                                        $tanggal = date_format($date, 'd F Y');
                                        echo $tanggal;
                                    @endphp
                                </td>
                                <td align="center">
                                    @php
                                        $rupiah = number_format($transaksi_penjualan->grand_total_penjualan, 0, ',', '.');
                                        echo 'Rp ' . $rupiah;
                                    @endphp
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>

        </div>
    </div>

</body>

</html>
