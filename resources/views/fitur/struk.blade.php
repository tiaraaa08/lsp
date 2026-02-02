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
                color: black !important;
                line-height: 1.3;
            }
            .divider {
                height: 0;
                border-top: 3px solid black;
                margin: 10px 0;
            }
            table {
                width: 100%;
            }
            .td-1 {
                width: 45%;
            }
            .td-2 {
                width: 5%;
            }
            .td-3{
                width: 50%;
            }
        }
    </style>
</head>

<body>
    <img src="{{ asset('template/img/svg/Logo.svg') }}" alt="">
    <h4 class="text-center">LAUNTOR - TIARA</h4>
    <div class="divider"></div>
    <h6 class="text-center">Bukti Transaksi</h6>
    <div class="divider"></div>
    <table>
        <tr>
            <td class="td-1">Waktu Transaksi</td>
            <td class="td-2">:</td>
            <td class="td-3">{{ Carbon\carbon::parse($transaksi->tanggal_transaksi)->translatedFormat('d F Y') }}</td>
        </tr>
        <tr>
            <td class="td-1">Pelanggan</td>
            <td class="td-2">:</td>
            <td class="td-3">{{ $transaksi->pelanggan->nama_pelanggan }}</td>
        </tr>
        <tr>
            <td class="td-1">No HP Pelanggan</td>
            <td class="td-2">:</td>
            <td class="td-3">{{ $transaksi->pelanggan->no_hp }}</td>
        </tr>
    </table>
    <div class="divider"></div>
    <table>
        <tr>
            <td class="td-1">Layanan</td>
            <td class="td-2">:</td>
            <td class="td-3">{{ $transaksi->layanan->nama_layanan }}</td>
        </tr>
        <tr>
            <td class="td-1">Berat</td>
            <td class="td-2">:</td>
            <td class="td-3">{{ $transaksi->berat }}</td>
        </tr>
        <tr>
            <td class="td-1">Harga per KG</td>
            <td class="td-2">:</td>
            <td class="td-3">Rp <div class="float-end">{{ number_format($transaksi->layanan->harga_layanan, 0, ',', '.') }}</div></td>
        </tr>
    </table>
    <div class="divider"></div>
    <table>
        <tr>
            <td class="td-1">Nominal</td>
            <td class="td-2">:</td>
            <td class="td-3">Rp <div class="float-end">{{ number_format($transaksi->layanan->harga_layanan * $transaksi->berat, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td class="td-1">Jumlah Bayar</td>
            <td class="td-2">:</td>
            <td class="td-3">Rp <div class="float-end">{{ number_format($transaksi->jumlah_bayar, 0, ',', '.') }}</div></td>
        </tr>
        <tr>
            <td class="td-1">Kembalian</td>
            <td class="td-2">:</td>
            <td class="td-3">Rp <div class="float-end">{{ number_format($transaksi->jumlah_bayar - ($transaksi->layanan->harga_layanan * $transaksi->berat), 0, ',', '.') }}</div></td>
        </tr>
    </table>
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js.map') }}"></script>
    <script>
        window.print();
        window.onafterprint= () => {
            window.location.href = "{{ route('transaksi.index') }}";
        }
    </script>
</body>

</html>
