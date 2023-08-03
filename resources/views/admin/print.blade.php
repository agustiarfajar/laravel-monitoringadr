<!DOCTYPE html>
<html>
    
<head>
    <title>Surat Jalan Perusahaan</title>
    <style>

        body {
            font-family: Calibri, sans-serif;
            font-size: 12px;
            margin: 8px; /* Margin normal untuk elemen body */
            margin-top: 90px;
            margin-bottom: 50px;
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

        .expedition-info {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        h1 {
            text-align: center;
            font-family: Calibri, sans-serif;
            font-size: 18px;
            margin-bottom: 12px;
            color: #333;
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

        .expedition-info th, .expedition-info td {
            padding: 2px;
            text-align: left;
        }

        .expedition-info th {
            background-color: #f2f2f2;
            font-weight: normal;
        }

        .expedition-info tr:not(:last-child) {
            margin-top: 2px;
            margin-bottom: 2px;
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
            margin-bottom: 15px;
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
            margin-top: 10px;
            margin-bottom: 5px;
        }

        .shipment-info th, .shipment-info td {
            border: 1px solid #ccc;
            padding: 6px;
            text-align: left;
        }

        .underline {
            border-bottom: 10px solid #000; /* Adjust the color and thickness as desired */

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
        }

        .signatures td {
            text-align: left;
            vertical-align: top;
        }

        .signatures td[colspan="2"] {
            width: 25%;
            height: 60px; /* Ubah nilai height sesuai dengan keinginan Anda */
        }
        
        html{
            border: 1px solid transparent;
        }
        body{
            border: 1px solid transparent;
        }
        div{
            border: 1px solid transparent;
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
        <p>{{ $barang->pemasok }}</p>
        <p>Jakarta</p>
        <p>{{ $barang->telpon}}</p>
        <h1>Surat Jalan Penyerahan Barang</h1>
        <a>Dengan ini kami mohon untuk menyerahkan barang sebagai berikut:</a>
        <table class="shipment-info">
            <tr>
                <th>No.</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>No. PO PR</th>
            </tr>
            @php $i = 1; @endphp
            @foreach($barangChunks as $chunk)
                @foreach($chunk as $row)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $row->item }}</td>
                <td>{{ $row->jumlah }} {{ $row->unit }}</td>
                <td>{{ $row->nomor_po }}</td>
            </tr>
            @endforeach 
            @if ($loop->remaining > 0)
            </table>
            <div style="page-break-before: always; "></div>
            <table class="shipment-info">
                <tr>
                    <th>No.</th>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>No. PO PR</th>
                </tr>
            @endif
            @endforeach
            
            <!-- Isi tabel dengan data lainnya sesuai kebutuhan -->
        </table>
        
        <div style="page-break-inside: avoid;">
        <a>Atas nama <b>{{ $barang->perusahaan }}</b>, mohon barang tersebut diserahkan kepada:</a>
        <table class="expedition-info">
            <tr>
                <td>Nama Ekspedisi</td>
                <td>: {{ $barang->ekspedisi }}</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>: {{ $barang->alamat }}</td>
            </tr>
            <tr>
                <td>PIC</td>
                <td>: {{ $barang->pic_eks }}</td>
            </tr>
            <tr>
                <td>Telepon</td>
                <td>: {{ $barang->telpon_eks }}</td>
            </tr>
        </table>
        <br>
        <a>Demikianlah surat jalan ini kami buat, dan dapat dipergunakan sebagaimana mestinya.</a>
        <br></br>
        <p style="text-align: left;">Jakarta, {{ now()->format('d M Y') }}</p>
        <div class="signatures">
        <table>
            <tr>
                <td colspan="2">Hormat Kami:</td>
                <td colspan="2">Mengetahui:</td>
                <td colspan="2">Yang Menerima:</td>
            </tr>
            <tr>
                <td colspan="2" style="text-decoration: underline;">Fery Gunawan</td>
                <td colspan="2" style="text-decoration: underline;">Lianto</td>
                <td colspan="2">_________________</td>
            </tr>
            </table>

            <h2>Note: Surat jalan dilampirkan 3 rangkap ke pihak ekspedisi</h2>
        </div>
        </div>
    </div>
</body>
</html>