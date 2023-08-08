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
      <li>
        <a href="{{ url('ekspedisi') }}">
          <i class="bi bi-circle-fill"></i><span>Ekspedisi</span>
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

<div class="card">
  <div class="card-body">
  <div class="row mb-2">
    <div class="col-4">
        <label for="laporan_type" class="form-label card-title">Pilih Jenis Laporan</label>
        <select name="laporan_type" id="laporan_type" class="form-select">
            <option value="barang_bulanan">Laporan Barang Bulanan</option>
            <option value="laporan2">Laporan Barang Aging</option>
            <option value="laporan3">Laporan 3</option>
            <!-- Add more options here as needed -->
        </select>
    </div>
  </div>
  </div>
</div>

<div class="col-12">
    <div class="card recent-sales overflow-auto">
        <div class="card-body"><div style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
            <h5 class="card-title">Laporan</h5>
                <div style="text-align: left">
                  <!-- Tombol Export to Excel -->
                      <?php 
                      if(isset($_GET['start-date']))
                      {
                          $tgl_mulai = $_GET['start-date'];
                          $tgl_selesai = $_GET['end-date'];

                          ?>
                          <a href="{{ url('export-laporan-kpi?start-date=') }}<?= $tgl_mulai; ?>&end-date=<?= $tgl_selesai; ?>">
                            <button class="btn btn-success">Export to Excel</button>
                          </a>
                          <?php
                      } else {
                        ?>
                          <a href="{{ url('export-laporan-kpi') }}">
                            <button class="btn btn-success">Export to Excel</button>
                          </a>
                        <?php
                      }
                      ?>
                </div>
        </div>

            <!-- Form filter bulan dan tanggal -->
            <form method="GET" action="" onsubmit="validateDateRange(event)">
                <div class="row">
                    <div class="col-md-6">
                              <h5 class="card-title">Filter Tanggal Laporan</h5>
                          <div class="card-body">
                              <div class="mb-3">
                                  <label for="date-range" class="form-label">Rentang Tanggal</label>
                                  <div class="input-group">
                                        <input type="date" class="form-control" name="start-date" id="start-date" placeholder="From">
                                        <span class="input-group-text"><i class="bi bi-arrow-right"></i></span>
                                        <input type="date" class="form-control" name="end-date" id="end-date" placeholder="To">
                                        <button type="submit" id="btnFilter" class="btn btn-primary" onclick="validateDateRange(event)">Pilih</button>
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
                <table class="datatable" id="table_laporan">
                    <thead>
                          <tr>
                              <th scope="col">#</th>
                              <th>Tgl Diproses <span class="badge rounded-pill bg-warning">Dikirim</span></th>
                              <th>Tgl Surat Jalan <span class="badge rounded-pill bg-primary">Diproses</span></th>
                              <th>Tgl Diterima Site <span class="badge rounded-pill bg-success">Diterima</span></th>
                              <th>Status</th>
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
                      <?php 
                        if(isset($_GET['start-date']))
                        {
                            ?>
                            @foreach($result_filter as $row)
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
                              @if($row->status == 'diproses')
                              <span class="badge rounded-pill bg-primary">Diproses</span>
                              @elseif($row->status == 'dikirim')
                              <span class="badge rounded-pill bg-warning">Dikirim</span>
                              @elseif($row->status == 'diterima')
                              <span class="badge rounded-pill bg-success">Diterima</span>
                              @elseif($row->status == 'dibatalkan')
                              <span class="badge rounded-pill bg-danger">Dibatalkan</span>
                              @endif
                              </td>
                              <td>
                                {{ (substr($row->no_faktur, 0, 2) == 'SJ' ? 'SHO' : 'SSP') }}
                              </td>
                              <td>{{ $row->no_faktur }}</td>
                              <td>{{ $row->perusahaan }}</td>
                              <td>{{ $row->item }}</td>
                              <td>{{ $row->pemasok }}</td>
                              <td>{{ $row->ekspedisi }}</td>
                              <td>{{ $row->nomor_po }}</td>
                              <td>{{ $row->jumlah }}</td>
                              <td>{{ $row->unit }}</td>
                            </tr>
                            @endforeach
                            <?php
                        } else {
                          ?>
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
                              @if($row->status == 'diproses')
                              <span class="badge rounded-pill bg-primary">Diproses</span>
                              @elseif($row->status == 'dikirim')
                              <span class="badge rounded-pill bg-warning">Dikirim</span>
                              @elseif($row->status == 'diterima')
                              <span class="badge rounded-pill bg-success">Diterima</span>
                              @elseif($row->status == 'dibatalkan')
                              <span class="badge rounded-pill bg-danger">Dibatalkan</span>
                              @endif
                            </td>
                            <td>
                              {{ (substr($row->no_faktur, 0, 2) == 'SJ' ? 'SHO' : 'SSP') }}
                            </td>
                            <td>{{ $row->no_faktur }}</td>
                            <td><span class="tooltip-perusahaan" data-perusahaan="{{ $row->perusahaan }}">{{ substr($row->perusahaan, 0, 10) }}...</span></td>
                            <td>{{ $row->item }}</td>
                            <td>{{ $row->pemasok }}</td>
                            <td>{{ $row->ekspedisi }}</td>
                            <td>{{ $row->nomor_po }}</td>
                            <td>{{ $row->jumlah }}</td>
                            <td>{{ $row->unit }}</td>
                          </tr>
                          @endforeach
                          <?php
                        }   
                      ?>

                    </tbody>
                </table>
                <!-- End Table with stripped rows -->
            </div>
        </div>

        <div class="row mb-2" id="laporan2_content" style="display: none;">
            <!-- Content specific to "Laporan Barang Aging" -->
            <!-- Add content for "Laporan Barang Aging" here -->
            <div class="col-12">
            <table class="datatable" id="table_laporan">
                    <thead>
                    <tr>
                            <th scope="col" style="width: 3%;">#</th>
                            <th scope="col" style="width: 15%;">Tgl Kedatangan</th>
                            <th scope="col" style="width: 3%;">Status</th>
                            <th class="text-center" style="width: 10%;;">Diminta Oleh</th>
                            <th scope="col" style="width: 10%;">Perusahaan</th>
                            <th class="text-center" style="width: 10%;;">Barang</th>
                            <th scope="col" style="width: 10%;">Pemasok</th>
                            <th scope="col" style="width: 15%;">No PO/PR</th>
                            <th scope="col" style="width: 5%;">Jumlah</th>
                            <th scope="col" style="width: 7%;">Unit</th>
                        </tr>
                    </thead>
                    <tbody>
                      <!-- content -->
                    </tbody>
                </table>
                <!-- End Table with stripped rows -->
            </div>
        </div>

        <div class="row mb-2" id="laporan3_content" style="display: none;">
            <!-- Content specific to "Laporan 3" -->
            <!-- Add content for "Laporan 3" here -->
            <div class="col-12">
                <table class="datatable">
                    <!-- Table content for "Laporan Barang Bulanan" -->
                </table>
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
        downloadLink.download = 'Laporan_KPI_Bulanan.xls';
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
            // Menyimpan rentang tanggal yang dipilih dalam sesi
            sessionStorage.setItem('selectedStartDate', startDate);
            sessionStorage.setItem('selectedEndDate', endDate);
            // Simpan status laporan sebagai "generated" dalam sessionStorage
            sessionStorage.setItem('laporanGenerated', 'true');
        
            // Mengirimkan formulir
            event.target.form.submit();
        }
    }

    $(document).ready(function() {
      // Mengambil rentang tanggal yang dipilih dari sesi
      var selectedStartDate = sessionStorage.getItem('selectedStartDate');
      var selectedEndDate = sessionStorage.getItem('selectedEndDate');

      // Menetapkan nilai kolom input tanggal dari nilai yang diambil dari sesi
      $('#start-date').val(selectedStartDate);
      $('#end-date').val(selectedEndDate);

      // Menghapus data sesi setelah mengisikan nilai ke kolom input tanggal
      sessionStorage.removeItem('selectedStartDate');
      sessionStorage.removeItem('selectedEndDate');

      var tbody_laporan = $('#table_laporan tbody');
      $('#btnFilter').on('click', function(e) {
          e.preventDefault();

          var form = $('#form-filter');
          var tgl_mulai = $('#start-date').val();
          var tgl_selesai = $('#end-date').val();
          if(tgl_mulai == "" || tgl_selesai == "")
          {
            Swal.fire({
                icon: 'error',
                title: 'Isi rentang tanggal jangan kosong.',
                text: 'Masukkan rentang tanggal yang sesuai.',
            });
          } else if(tgl_mulai > tgl_selesai)
          {
            Swal.fire({
                icon: 'error',
                title: 'Rentang Tanggal Tidak Valid',
                text: 'Masukkan rentang tanggal yang sesuai.',
            });
          } else {
              window.location.href = "{{ url('laporan?start-date=') }}"+tgl_mulai+"&end-date="+tgl_selesai+"";
          }
      })

      // END ALERT
      $('.tooltip-perusahaan').each(function(){
        $(this).tooltip({
          title: $(this).data('perusahaan'),
          placement: 'top' // Adjust the placement as needed (top, bottom, left, right)
        });
      })
    })
</script>

<script>
  function resetDateFilter() {
    document.getElementById('start-date').value = '';
    document.getElementById('end-date').value = '';
  }

  function hideAllReportContents() {
    document.getElementById('barang_bulanan_content').style.display = 'none';
    document.getElementById('laporan2_content').style.display = 'none';
    document.getElementById('laporan3_content').style.display = 'none';
  }

  const laporanTypeDropdown = document.getElementById('laporan_type');
  laporanTypeDropdown.addEventListener('change', function() {
    resetDateFilter();
    hideAllReportContents();
    const selectedValue = laporanTypeDropdown.value;
    if (selectedValue === 'barang_bulanan') {
      document.getElementById('barang_bulanan_content').style.display = 'block';
    } else if (selectedValue === 'laporan2') {
      document.getElementById('laporan2_content').style.display = 'block';
    } else if (selectedValue === 'laporan3') {
      document.getElementById('laporan3_content').style.display = 'block';
    }
  });
</script>

<script>
    const laporanTypeDropdown = document.getElementById('laporan_type');
    const barangBulananContent = document.getElementById('barang_bulanan_content');
    const laporan2Content = document.getElementById('laporan2_content');
    const laporan3Content = document.getElementById('laporan3_content');

    laporanTypeDropdown.addEventListener('change', function() {
        const selectedValue = laporanTypeDropdown.value;
        if (selectedValue === 'barang_bulanan') {
            barangBulananContent.style.display = 'block';
            laporan2Content.style.display = 'none';
            laporan3Content.style.display = 'none';
        } else if (selectedValue === 'laporan2') {
            barangBulananContent.style.display = 'none';
            laporan2Content.style.display = 'block';
            laporan3Content.style.display = 'none';
        } else if (selectedValue === 'laporan3') {
            barangBulananContent.style.display = 'none';
            laporan2Content.style.display = 'none';
            laporan3Content.style.display = 'block';
        }
    });
</script>

@endsection