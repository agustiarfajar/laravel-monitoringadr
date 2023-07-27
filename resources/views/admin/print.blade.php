<!DOCTYPE html>
<html>
    
<head>
    <title>Surat Jalan Perusahaan</title>
    <style>
        body {
            font-family: Calibri;
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

            .expedition-info {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }


        h1 {
            text-align: center;
            font-size: 18px;
            margin-bottom: 30px;
            color: #333;
        }

        h2 {
            font-size: 18px;
            color: #555;
            margin-bottom: 15px;
        }

        p {
            font-size: 14px;
            color: #333;
        }

        
        .expedition-info {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .expedition-info th, .expedition-info td {
            padding: 10px;
            text-align: left;
        }

        .expedition-info th {
            background-color: #f2f2f2;
            font-weight: normal;
        }

        .expedition-info tr:not(:last-child) {
            margin-bottom: 5px;
        }

        a {
            margin: 5px 0;
            color: #333;
            font-size: 14px;
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
        }

        .signatures td {
            text-align: left;
            vertical-align: top;
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
    <div>
        <p>Kepada: {{ $row }}</p>
        <p>Jakarta</p>
        <p>Telp: 08123456789</p>
    </div>
    <div class="container">
        <h1>Surat Jalan Penyerahan Barang</h1>
        <a>Dengan ini kami mohon untuk menyerahkan barang, sbb :</a>
        <table class="shipment-info">
            <tr>
                <th>Nama Barang dan Quantity</th>
                <th>No. PO & PR</th>
            </tr>
            <tr>
                <td>{{ $row }} ({{ $row }})</td>
                <td>{{ $row }}</td>
            </tr>
            <!-- Isi tabel dengan data lainnya sesuai kebutuhan -->
        </table>
        
        <a>Atas nama {{ $row }}, mohon barang tersebut diserahkan kepada:</a>
        <table class="expedition-info">
            <tr>
                <td>Nama Ekspedisi</td>
                <td>: {{ $barang }}</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>: Jl. Ekspedisi No. 123</td>
            </tr>
            <tr>
                <td>PIC:</td>
                <td>: {{ $barang }}</td>
            </tr>
            <tr>
                <td>Telp</td>
                <td>: 08123456789</td>
            </tr>
        </table>
        <br></br>
        <a>Demikianlah surat jalan ini kami buat, dan dapat dipergunakan sebagaimana mestinya.</a>
        <br></br>
        <p style="text-align: left;">Jakarta, 26 Juli 2023</p>
        <div class="signatures">
        <table>
            <tr>
                <td colspan="2">Hormat Kami:</td>
                <td colspan="2">Mengetahui:</td>
                <td colspan="2">Yang Menerima:</td>
            </tr>
            <tr>
                <td colspan="2">_________________</td>
                <td colspan="2">_________________</td>
                <td colspan="2">_________________</td>
            </tr>
            </table>

            <h2>Note : Surat jalan dilampirkan 3 rangkap ke pihak Ekspedisi</h2>
        </div>
    </div>
</body>
</html>