<!DOCTYPE html>
<html>
    
<head>
    <title>Surat Jalan Pengiriman Barang</title>
    <style>
        body {
            font-family: Calibri, sans-serif;
            font-size: 12px;
            margin: 8px; /* Margin normal untuk elemen body */
        }

        h1, h2, p, table {
            margin: 0; /* Reset margin untuk elemen heading (h1, h2), paragraph (p), dan tabel (table) */
        }

        .container {
            max-width: 800px;
            margin: 30px auto;
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
            margin-bottom: 30px;
            color: #333;
            font-family: Calibri, sans-serif;
        }

        h2 {
            font-family: Calibri, sans-serif;
            font-size: 18px;
            color: #555;
            margin-bottom: 15px;
        }

        p {
            font-family: Calibri, sans-serif;
            font-size: 14px;
            color: #333;
        }

        a {
            margin: 5px 0;
            color: #333;
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
            margin-top: 20px;
        }

        .shipment-info th, .shipment-info td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
            font-family: Calibri, sans-serif;
        }

        .shipment-info th {
            background-color: #f2f2f2;
            font-weight: normal;
        }

        .signatures table {
            width: 100%;
            margin-top: 30px;
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
            height: 70px; /* Ubah nilai height sesuai dengan keinginan Anda */
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
        <p>Kepada: Pemasok (Dummy)</p>
        <p>Up: {{ $barang->pic }}</p>
        <p>Cc: Logistic</p>
        <h1>Surat Jalan Pengiriman Barang</h1>
        <a>Dengan ini kami kirimkan barang melalui Ekspedisi {{ $barang->ekspedisi }} dengan rincian barang sebagai berikut:</a>
        <table class="shipment-info">
            <tr>
                <th>No.</th>
                <th>Item Barang</th>
                <th>Suplier</th>
                <th>No. PO & PR</th>
                <th>User</th>
                <th>Jumlah</th>
                <th>Unit</th>
            </tr>
            @php $i = 1; @endphp
            @foreach($barang_detail as $row)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $row->item }}</td>
                <td>{{ $row->supplier }}</td>
                <td>{{ $row->nomor_po }}</td>
                <td>{{ $row->user }}</td>
                <td>{{ $row->jumlah }}</td>
                <td>{{ $row->unit }}</td>
            </tr>
            @endforeach            
            <!-- Isi tabel dengan data lainnya sesuai kebutuhan -->
        </table>
        

        <a>Demikian surat jalan ini dibuat untuk dapat dipergunakan sebagaimana mestinya.</a>
        <div class="signatures">
            <table>
                <tr>
                    <td colspan="2">Dibuat oleh:</td>
                    <td colspan="2">Mengetahui:</td>
                    <td colspan="2">Dibawa oleh:</td>
                    <td colspan="2">Diterima oleh:</td>
                </tr>
                <tr>
                    <td colspan="2">_________________</td>
                    <td colspan="2">_________________</td>
                    <td colspan="2">_________________</td>
                    <td colspan="2">_________________</td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>