@extends('admin.master')

@section('sidebar')
<aside id="sidebar" class="sidebar">

<ul class="sidebar-nav" id="sidebar-nav">

  <li class="nav-item">
    <a class="nav-link collapsed" href="{{ url('admin-dashboard') }}">
      <i class="bi bi-grid"></i>
      <span>Dashboard</span>
    </a>
  </li><!-- End Dashboard Nav -->

  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-menu-button-wide-fill"></i><span>Master</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      <li>
        <a href="{{ url('perusahaan') }}">
          <i class="bi bi-circle-fill"></i><span>Perusahaan</span>
        </a>
      </li>
    </ul>
  </li><!-- End Tables Nav -->

  <li class="nav-heading">Menu</li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="{{ url('adminstatus') }}">
      <i class="bi bi-ui-checks"></i><span>Pengiriman</span>
    </a>  
  </li>

  

  <li class="nav-item">
    <a class="nav-link collapsed" href="/daftar-barang">
      <i class="bi bi-box-seam"></i><span>Barang Diterima di HO</span>
    </a>
  
  </li><!-- End Ekspedisi Nav -->

  <li class="nav-item">
    <a class="nav-link " href="/laporan">
      <i class="bi bi-file-earmark-bar-graph"></i><span>Laporan</span>
    </a>
  
  </li><!-- End Ekspedisi Nav -->

  <li class="nav-heading">Pages</li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="users-profile.html">
      <i class="bi bi-person"></i>
      <span>Profile</span>
    </a>
  </li><!-- End Profile Page Nav -->

  <li class="nav-item">
    <a class="nav-link collapsed" href="/adminfaq">
      <i class="bi bi-question-circle"></i>
      <span>F.A.Q</span>
    </a>
  </li><!-- End F.A.Q Page Nav -->

  <li class="nav-item">
    <a class="nav-link collapsed" href="pages-contact.html">
      <i class="bi bi-envelope"></i>
      <span>Contact</span>
    </a>
  </li><!-- End Contact Page Nav -->

  <li class="nav-item">
    <a class="nav-link collapsed" href="pages-login.html">
      <i class="bi bi-box-arrow-in-right"></i>
      <span>Logout</span>
    </a>
  </li><!-- End Login Page Nav -->

</ul>

</aside>
@endsection

@section('content')
<div class="pagetitle">
    <h1>Laporan KPI Bulanan</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin-dashboard">Dashboard</a></li>
            <li class="breadcrumb-item active">Laporan KPI Bulanan</li>
        </ol>
    </nav>
</div>

<div class="col-12">
    <div class="card recent-sales overflow-auto">
        <div class="card-body"><div style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
            <h5 class="card-title">Laporan KPI Bulanan</h5>
                <div style="text-align: left">
                  <!-- Tombol Export to Excel -->
                      <a href="{{ url('export-laporan-kpi') }}">
                        <button class="btn btn-success">Export to Excel</button>
                      </a>
                </div>
        </div>

            <!-- Form filter bulan dan tanggal -->
            <form method="GET" action="">
                <div class="row">
                    <div class="col-md-6">
                              <h5 class="card-title">Filter Tanggal Laporan</h5>
                          <div class="card-body">
                              <div class="mb-3">
                                  <label for="date-range" class="form-label">Rentang Tanggal</label>
                                  <div class="input-group">
                                      <input type="date" class="form-control " name="start-date" id="start-date" placeholder="From">
                                      <span class="input-group-text"><i class="bi bi-arrow-right"></i></span>
                                      <input type="date" class="form-control " name="end-date" id="end-date" placeholder="To">
                                      <button type="submit" name="submit" class="btn btn-primary" onclick="validateDateRange(event)">Buat</button>
                                  </div>
                                  <div id="date-error" class="text-danger"></div>
                                  
                              </div>
                          </div>
                    </div>
                </div>
            </form>
            
        <div class="row mb-2" id="barang_bulanan_content">
            <!-- Content specific to "Laporan Barang Bulanan" -->
                <div class="col-12">
                <table class="table datatable">
                    <thead>
                          <tr>
                              <th scope="col">#</th>
                              <th>Tgl Diproses</th>
                              <th>Tgl Surat Jalan</th>
                              <th>Tgl Diterima Site</th>
                              <th>Jenis</th>
                              <th>No Surat Jalan</th>
                              <th>Perusahaan</th>
                              <th>Barang</th>
                              <th>Pemasok</th>
                              <th>Ekspedisi</th>
                              <th>No PO/PR</th>
                              <th>Jumlah</th>
                              <th>Unit</th>
                          </tr>
                    </thead>
                    <tbody>
                      @php $i = 1; @endphp
                      @foreach($result as $row)
                      <tr>
                        <td>{{ $i++ }}</td>
                        <td>
                          @if(substr($row->no_faktur, 0, 2) == 'SJ')
                            {{ ($row->tgl_diterima_site != null) ?  $row->tgl_diterima_site : '-'}}
                          @elseif(substr($row->no_faktur, 0, 2) == 'SP')
                            {{ ($row->tgl_kirim_pemasok != null) ? $row->tgl_kirim_pemasok : '-' }}
                          @endif
                        </td>
                        <td>{{ $row->tgl_surat_jalan }}</td>
                        <td>{{ ($row->tgl_diterima_site != null) ?  $row->tgl_diterima_site : '-'}}</td>
                        <td>
                          {{ (substr($row->no_faktur, 0, 2) == 'SJ' ? 'SHO' : 'SSP') }}
                        </td>
                        <td>{{ $row->no_faktur }}</td>
                        <td>{{ $row->perusahaan }}</td>
                        <td>{{ $row->item }}</td>
                        <td>{{ $row->supplier }}</td>
                        <td>{{ $row->ekspedisi }}</td>
                        <td>{{ $row->nomor_po }}</td>
                        <td>{{ $row->jumlah }}</td>
                        <td>{{ $row->unit }}</td>
                      </tr>
                      @endforeach
                          <!-- <tr>
                              <td>1</td>
                              <td>2023-07-02</td>
                              <td>2023-07-03</td>
                              <td>2023-07-04</td>
                              <td>SJ/2023/0001</td>
                              <td>PT KASIH AGRO MANDIRI PKS</td>
                              <td>RELAY RXM4AB2P7 6A 230Vac SCHNEIDER</td>
                              <td>CV.DJAKARTA ELETRIKAL CENTRE</td>
                              <td>Bus Laju Prima</td>
                              <td>PO:WE001592 PR:WE001016</td>
                              <td>10</td>
                              <td>Pcs</td>
                          </tr>
                          <tr>
                              <td>2</td>
                              <td>2023-07-05</td>
                              <td>2023-07-06</td>
                              <td>2023-07-07</td>
                              <td>SJ/2023/0002</td>
                              <td>PT KASIH AGRO MANDIRI 1</td>
                              <td>ALE RXM4AB2P7 6A 230Vac SCHNEIDER</td>
                              <td>CV.DJAKARTA ELEKTRIKAL CENTER</td>
                              <td>Bus Laju Prima</td>
                              <td>PO:WE001592 PR:WE001016</td>
                              <td>90</td>
                              <td>BOX</td>
                          </tr>
                          <tr>
                              <td>3</td>
                              <td>2023-07-12</td>
                              <td>2023-07-15</td>
                              <td>2023-07-17</td>
                              <td>SP/2023/0001</td>
                              <td>PT KASIH AGRO MANDIRI PKS</td>
                              <td>AIR MINERAL SCHNEIDER</td>
                              <td>Tokopedia</td>
                              <td>DHL</td>
                              <td>PO:WE001592 PR:WE001016</td>
                              <td>100</td>
                              <td>BTL</td>
                          </tr> -->
                    </tbody>
                </table>
                <!-- End Table with stripped rows -->
            </div>
        </div>

        </div>
    </div>
</div>
<a href="{{ url('/admin-dashboard') }}"><i class="bi bi-arrow-left">Kembali</i></a>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function exportToExcel() {
        var table = document.querySelector('.table');
        var html = table.outerHTML.replace(/ /g, '%20');
        var uri = 'data:application/vnd.ms-excel;charset=utf-8,' + html;

        var downloadLink = document.createElement('a');
        document.body.appendChild(downloadLink);
        downloadLink.href = uri;
        downloadLink.download = 'laporan_kpi_bulanan.xls';
        downloadLink.click();
        document.body.removeChild(downloadLink);
    }

    function validateDateRange(event) {
        event.preventDefault();
        var startDate = document.getElementById('start-date').value;
        var endDate = document.getElementById('end-date').value;

        if (startDate > endDate) {
            Swal.fire({
                icon: 'error',
                title: 'Rentang Tanggal Tidak Valid',
                text: 'Masukkan rentang tanggal yang sesuai.',
            });
        } else {
            // Submit the form
            event.target.form.submit();
        }
    }
</script>

@endsection