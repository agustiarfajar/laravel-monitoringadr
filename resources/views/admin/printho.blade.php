<!DOCTYPE html>
<html>
    
<head>
    <title>Surat Jalan Pengiriman Barang</title>
    <style>
        body {
            font-family: Calibri, sans-serif;
            font-size: 12px;
            margin: 8px; /* Margin normal untuk elemen body */
            margin-top: 90px;
        }

        h1, h2, p, table {
            margin: 0; /* Reset margin untuk elemen heading (h1, h2), paragraph (p), dan tabel (table) */
        }

        .container {
            max-width: 800px;
            margin: 3px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .company-logo {
            width: 150px; /* Set the desired width here */
            height: 150px; /* Set the desired height here */
            object-fit: contain; /* Maintain aspect ratio and fit within the specified width and height */
        }

        h1 {
            text-align: center;
            margin-bottom: 12px;
            color: #333;
            font-size: 18px;
            font-family: Calibri, sans-serif;
        }

        h2 {
            font-family: Calibri, sans-serif;
            font-size: 15px;
            color: #555;
            margin-bottom: 15px;
        }

        p {
            font-family: Calibri, sans-serif;
            font-size: 12px;
            color: #333;
        }

        a {
            margin: 5px 0;
            color: #333;
            font-size: 12px;
            font-family: Calibri, sans-serif;
        }

        .sender-info, .receiver-info, .shipment-info {
            border-bottom: 1px solid #ccc;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        .sender-info h2, .receiver-info h2, .shipment-info h2 {
            color: #333;
            border-bottom: 1px solid #333;
            padding-bottom: 5px;
            font-family: Calibri, sans-serif;
        }

        /* Styling untuk tabel barang */
        .shipment-info {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            margin-bottom: 5px;
        }

        .shipment-info th, .shipment-info td {
            border: 1px solid #ccc;
            padding: 6px;
            text-align: left;
            font-family: Calibri, sans-serif;
        }

        .shipment-info th {
            background-color: #f2f2f2;
            font-weight: normal;
        }

        .signatures table {
            width: 100%;
            margin-top: 10px;
            border-collapse: collapse;
        }

        .signatures th {
            background-color: #f2f2f2;
            font-weight: normal;
            font-family: Calibri, sans-serif;
        }

        .signatures td {
            text-align: left;
            vertical-align: top;
            font-family: Calibri, sans-serif;
        }

        .signatures td[colspan="2"] {
            width: 25%;
            height: 60px; /* Ubah nilai height sesuai dengan keinginan Anda */
        }

        @media screen and (max-width: 600px) {
            .container {
                padding: 10px;
            }
        }

    </style> 
</head>
<body>
    <div class="container">
        <p>Kepada:</p>
        <p>{{ $barang->perusahaan }}</p>
        <p>Up: {{ $barang->pic }}</p>
        <p>Cc: Logistic</p>
        <h1>Surat Jalan Pengiriman Barang</h1>
        <a>Dengan ini kami kirimkan barang melalui ekspedisi {{ $barang->ekspedisi }} dengan rincian barang sebagai berikut:</a>
        <table class="shipment-info">
            <tr>
                <th>No.</th>
                <th>Nama Barang</th>
                <th>Pemasok</th>
                <th>No. PO PR</th>
                <th>User</th>
                <th>Jumlah</th>
                <th>Unit</th>
            </tr>
            @php $i = 1; @endphp
            @foreach($barangChunks as $chunk)
                @foreach($chunk as $row)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $row->item }}</td>
                <td>{{ $row->pemasok }}</td>
                <td>{{ $row->nomor_po }}</td>
                <td>{{ $row->user }}</td>
                <td>{{ $row->jumlah }}</td>
                <td>{{ $row->unit }}</td>
            </tr>
            @endforeach
            @if($loop->remaining > 0) 
            </table>
            <div style="page-break-before: always;"></div>
            <table class="shipment-info">
                <tr>
                    <th>No.</th>
                    <th>Nama Barang</th>
                    <th>Pemasok</th>
                    <th>No. PO PR</th>
                    <th>User</th>
                    <th>Jumlah</th>
                    <th>Unit</th>
                </tr>
            @endif
            @endforeach           
            <!-- Isi tabel dengan data lainnya sesuai kebutuhan -->
        </table>
        
        <a>Demikian surat jalan ini dibuat untuk dapat dipergunakan sebagaimana mestinya.</a>
        <br><br>
        <p style="text-align: left;">Jakarta, 28 Juli 2023</p>
        <div class="signatures">
            <table>
                <tr>
                    <td colspan="2">Dibuat oleh:</td>
                    <td colspan="2">Mengetahui:</td>
                    <td colspan="2">Dibawa oleh:</td>
                    <td colspan="2">Diterima oleh:</td>
                </tr>
                <tr>
                    <td colspan="2" style="text-decoration: underline;">Fery Gunawan</td>
                    <td colspan="2" style="text-decoration: underline;">Lianto</td>
                    <td colspan="2">_________________</td>
                    <td colspan="2">_________________</td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>