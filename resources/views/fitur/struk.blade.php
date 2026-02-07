<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <style>
        @media print {
            body {
                width: 80mm;
                line-height: 1.3;
                color: black !important;
            }

            .divider {
                margin: 10px 0;
                border-top: 3px solid black;
                height: 0;
            }

            .table {
                width: 100%;
            }

            .col-1 {
                width: 45%;
            }

            .col-2 {
                width: 5%;
            }

            .col-3 {
                width: 50%;
            }
        }
    </style>
</head>

<body>
    <div class="text-center">
        <h3>Bukti Pembayaran</h3>
        <div class="divider"></div>
        <h4>LSP TIARA</h4>
        <div class="divider"></div>
        <table>
            <tr>
                <td class="col-1">Tanggal</td>
                <td class="col-2">:</td>
                <td class="col-3">{{ $transaksi->tanggal }}</td>
            </tr>
            <tr>
                <td class="col-1">Nama</td>
                <td class="col-2" rowspan="2">:</td>
                <td class="col-3">{{ $transaksi->pelanggan->nama }}</td>
            </tr>
        </table>
        <div class="divider"></div>
        <table>
            <tr>
                <td class="col-1">Layanan</td>
                <td class="col-2">:</td>
                <td class="col-3">{{ $transaksi->layanan->nama }}</td>
            </tr>
            <tr>
                <td class="col-1">Harga per KG</td>
                <td class="col-2">:</td>
                <td class="col-3" class="float-end">Rp {{ number_format($transaksi->layanan->harga, 0, ',', '.') }}
                </td>
            </tr>
            <tr>
                <td class="col-1">Berat</td>
                <td class="col-2" rowspan="2">:</td>
                <td class="col-3">{{ $transaksi->berat }}</td>
            </tr>
        </table>
        <div class="divider"></div>
        <table>
            <tr>
                <td class="col-1">Nominal</td>
                <td class="col-2">:</td>
                <td class="col-3" class="float-end">Rp
                    {{ number_format($transaksi->layanan->harga * $transaksi->berat, 0, ',', '.') }}
                </td>
            </tr>
            <tr>
                <td class="col-1">Bayar</td>
                <td class="col-2">:</td>
                <td class="col-3" class="float-end">Rp {{ number_format($transaksi->bayar, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td class="col-1">Kembalian</td>
                <td class="col-2">:</td>
                <td class="col-3">
                    Rp{{ number_format($transaksi->bayar - $transaksi->layanan->harga * $transaksi->berat, 0, ',', '.') }}
                </td>
            </tr>
        </table>
    </div>
    <script src="{{ asset('jquery.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script>
        // window.print();
        window.onload = function(){
            window.print();
            window.onafterprint = () =>{
                window.location.href = "{{ route('transaksi.index') }}";
            }
        }
    </script>
</body>

</html>
