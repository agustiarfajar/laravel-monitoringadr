@extends('admin.master')

@section('sidebar')
<aside id="sidebar" class="sidebar">

<ul class="sidebar-nav" id="sidebar-nav">

  <li class="nav-item">
    <a class="nav-link " href="{{ url('admin-dashboard') }}">
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
    <a class="nav-link collapsed" href="/laporan">
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
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item active">Status Barang di HO</li>
        </ol>
      </nav>
    </div>
    <!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">
        <!-- Left side columns -->

            <div class="col-xxl-3 col-md-3" style="width: 18 rem;">
              <div class="card info-card acc-card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>
                    <li><a class="dropdown-item filter-periode-barang-masuk" data-periode="today" data-text="| Today" style="cursor:pointer">Today</a></li>
                    <li><a class="dropdown-item filter-periode-barang-masuk" data-periode="month" data-text="| This Month" style="cursor:pointer">This Month</a></li>
                    <li><a class="dropdown-item filter-periode-barang-masuk" data-periode="year" data-text="| This Year" style="cursor:pointer">This Year</a></li>
                  </ul>
                </div>

                <div class="card-body" >
                  <h5 class="card-title"><a href="/daftar-barang" class="card-title">Barang Masuk</a> <span class="txtBarangMasuk">| This Month</span> <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Total jumlah barang dalam Qty yang diterima di HO"></i></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-box-fill"></i>
                    </div>
                    <div class="ps-3 barangMasuk">
                      <h6>{{ $countTotalBarangHo }}</h6>
                    <span class="text-muted small pt-2 ps-1">barang</span>

                    </div>
                  </div>
                </div>

              </div>
            </div>

            <!-- Sales Card -->
            <div class="col-xxl-3 col-md-3">
              <div class="card info-card letter-card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>
                    <li><a class="dropdown-item filter-periode-barang-keluar" data-periode="today" data-text="| Today" style="cursor:pointer">Today</a></li>
                    <li><a class="dropdown-item filter-periode-barang-keluar" data-periode="month" data-text="| This Month" style="cursor:pointer">This Month</a></li>
                    <li><a class="dropdown-item filter-periode-barang-keluar" data-periode="year" data-text="| This Year" style="cursor:pointer">This Year</a></li>
                  </ul>
                </div>

                <div class="card-body" >
                  <h5 class="card-title">Barang Keluar <span class="txtBarangKeluar">| This Month</span> <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Jumlah barang dalam Qty yang sudah keluar dari HO"></i></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-box-seam"></i>
                    </div>
                    <div class="ps-3 barangKeluar">
                      <h6>{{ $countBarangKeluarHo }}</h6>
                      <span class="text-muted small pt-2 ps-1">barang</span>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->



            <!-- Sales Card -->
            <div class="col-xxl-3 col-md-3">
              <div class="card info-card sales-card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>
                    <li><a class="dropdown-item filter-periode-barang-ho" data-periode="today" data-text="| Today" style="cursor:pointer">Today</a></li>
                    <li><a class="dropdown-item filter-periode-barang-ho" data-periode="month" data-text="| This Month" style="cursor:pointer">This Month</a></li>
                    <li><a class="dropdown-item filter-periode-barang-ho" data-periode="year" data-text="| This Year" style="cursor:pointer">This Year</a></li>
                  </ul>
                </div>

                <div class="card-body" >
                  <h5 class="card-title">Sisa Barang <span class="txtSisaBarangHoPeriode">| This Month</span> <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Jumlah barang dalam Qty yang belum keluar dari HO"></i></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-box-seam"></i>
                    </div>
                    <div class="ps-3 sisaBarangHo">
                      <h6>{{ $sisaBarang }}</h6>
                      <span class="text-muted small pt-2 ps-1">barang</span>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->


        


            <!-- Customers Card -->
            <div class="col-xxl-3 col-md-3">

              <div class="card info-card void-card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item filter-periode-barang-aging" data-periode="today" data-text="| Today" style="cursor:pointer">Today</a></li>
                    <li><a class="dropdown-item filter-periode-barang-aging" data-periode="month" data-text="| This Month" style="cursor:pointer">This Month</a></li>
                    <li><a class="dropdown-item filter-periode-barang-aging" data-periode="year" data-text="| This Year" style="cursor:pointer">This Year</a></li>
                  </ul>
                </div>

                <div class="card-body" >
                  <h5 class="card-title">Barang Aging <span class="txtBarangAging">| This Month</span> <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Jumlah barang dalam Qty yang mengendap > 5 hari di HO"></i></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-flag-fill"></i>
                    </div>
                    <div class="ps-3 barangAging">
                      <h6>{{ $countBarangAging }}</h6>
                      <span class="text-muted small pt-2 ps-1">barang</span>

                    </div>
                  </div>

                </div>
              </div>

            </div><!-- End Customers Card -->

            <div class="pagetitle">
              <br>
              <nav>
                <ol class="breadcrumb">
                  <li class="breadcrumb-item active">Status Pengiriman </li>
                </ol>
              </nav>
            </div>
            <!-- End Page Title -->
            
            <!-- Sales Card -->
            <div class="col-xxl-3 col-md-3">
              <div class="card info-card sales-card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item filter-periode-surat-jalan" data-periode="today" data-text="| Today" style="cursor:pointer">Today</a></li>
                    <li><a class="dropdown-item filter-periode-surat-jalan" data-periode="month" data-text="| This Month" style="cursor:pointer">This Month</a></li>
                    <li><a class="dropdown-item filter-periode-surat-jalan" data-periode="year" data-text="| This Year" style="cursor:pointer">This Year</a></li>
                  </ul>
                </div>

                <div class="card-body" >
                  <h5 class="card-title">Surat Pengiriman <span class="txtSuratJalan">| This Month</span> <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Total pengiriman berdasarkan status pengiriman dari HO dan Pemasok"></i></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-send-fill"></i>
                    </div>
                    <div class="ps-3 suratJalan">
                      <h6>{{ $countPengirimanAll }}</h6>
                      <span class="text-muted small pt-2 ps-1">pengiriman</span>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->

            <!-- Customers Card -->
            <div class="col-xxl-3 col-md-3">

              <div class="card info-card acc-card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item filter-periode-belum-kirim-pemasok" data-periode="today" data-text="| Today" style="cursor:pointer">Today</a></li>
                    <li><a class="dropdown-item filter-periode-belum-kirim-pemasok" data-periode="month" data-text="| This Month" style="cursor:pointer">This Month</a></li>
                    <li><a class="dropdown-item filter-periode-belum-kirim-pemasok" data-periode="year" data-text="| This Year" style="cursor:pointer">This Year</a></li>
                  </ul>
                </div>

                <div class="card-body" >
                  <h5 class="card-title">Diproses <span class="txtBelumKirimPemasok">| This Month</span> <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Pengiriman yang dibuat dari HO dan Pemasok"></i></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-boxes"></i>
                    </div>
                    <div class="ps-3 belumKirimPemasok">
                      <h6>{{ $countPengirimanDiproses }}</h6>
                      <span class="text-muted small pt-2 ps-1">pengiriman</span>

                    </div>
                  </div>

                </div>
              </div>

            </div><!-- End Customers Card -->

            <!-- Customers Card -->
            <div class="col-xxl-3 col-md-3">

              <div class="card info-card letter-card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item filter-periode-belum-terima-site" data-periode="today" data-text="| Today" style="cursor:pointer">Today</a></li>
                    <li><a class="dropdown-item filter-periode-belum-terima-site" data-periode="month" data-text="| This Month" style="cursor:pointer">This Month</a></li>
                    <li><a class="dropdown-item filter-periode-belum-terima-site" data-periode="year" data-text="| This Year" style="cursor:pointer">This Year</a></li>
                  </ul>
                </div>

                <div class="card-body" >
                  <h5 class="card-title">Dikirim <span class="txtBelumTerimaSite">| This Month</span> <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Pengiriman yang dilakukan Pemasok"></i></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-truck"></i>
                    </div>
                    <div class="ps-3 belumTerimaSite">
                      <h6>{{ $countPengirimanDikirim }}</h6>
                      <span class="text-muted small pt-2 ps-1">pengiriman</span>

                    </div>
                  </div>

                </div>
              </div>

            </div><!-- End Customers Card -->

            <!-- Void Card -->
            <div class="col-xxl-3 col-md-3">
              <div class="card info-card confirm-card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item filter-periode-batal-proses" data-periode="today" data-text="| Today" style="cursor:pointer">Today</a></li>
                    <li><a class="dropdown-item filter-periode-batal-proses" data-periode="month" data-text="| This Month" style="cursor:pointer">This Month</a></li>
                    <li><a class="dropdown-item filter-periode-batal-proses" data-periode="year" data-text="| This Year" style="cursor:pointer">This Year</a></li>
                  </ul>
                </div>

                <div class="card-body" >
                  <h5 class="card-title">Diterima <span class="txtBatalProses">| This Month</span> <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Pengiriman dari HO dan Pemasok yang sudah selesai"></i></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-send-check-fill"></i>
                    </div>
                    <div class="ps-3 batalProses">
                      <h6>{{ $countTerima }}</h6>
                      <span class="text-muted small pt-2 ps-1">pengiriman</span>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Revenue Card -->

            

            <!-- Website Traffic >
          <div class="col-xxl-12 col-md-12">
            <div class="card">
              <div class="filter">
                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                  <li class="dropdown-header text-start">
                    <h6>Filter</h6>
                  </li>
                      <li><a class="dropdown-item filter-periode-chart" data-periode="today" data-text="| Today" style="cursor:pointer">Today</a></li>
                      <li><a class="dropdown-item filter-periode-chart" data-periode="month" data-text="| This Month" style="cursor:pointer">This Month</a></li>
                      <li><a class="dropdown-item filter-periode-chart" data-periode="year" data-text="| This Year" style="cursor:pointer">This Year</a></li>
                </ul>
              </div>
  
              <div class="card-body pb-0">
                <h5 class="card-title">Chart Surat Pengiriman <span class="txtChart">| This Month</span> <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Chart pengiriman dari HO dan Pemasok"></i></h5>
  
                <div id="trafficChart" style="min-height: 400px;" class="echart"></div>  
  
              </div>
            </div>
          </div><-- End Website Traffic -->

        <div class="col-xxl-12 col-md-12">
          <div class="card">
              <div class="filter">
                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                  <li class="dropdown-header text-start">
                    <h6>Filter</h6>
                  </li>
  
                      <li><a class="dropdown-item filter-periode-pengiriman-chart" data-periode="today" data-text="| Today" style="cursor:pointer">Today</a></li>
                      <li><a class="dropdown-item filter-periode-pengiriman-chart" data-periode="month" data-text="| This Month" style="cursor:pointer">This Month</a></li>
                      <li><a class="dropdown-item filter-periode-pengiriman-chart" data-periode="year" data-text="| This Year" style="cursor:pointer">This Year</a></li>
                </ul>
              </div>
  
              <div class="card-body pb-0">
                <h5 class="card-title">Chart Pengiriman Perusahaan <span class="txtPengirimanChart">| This Month</span> <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Chart pengiriman dari HO dan Pemasok ke perusahaan tujuan"></i></h5>
  
                <div id="pieChart" style="min-height: 400px;"></div>
                
              </div>
          </div>
        </div><!-- End Pie Chart -->   
             
      </div>
    </section>

<script>
function updatePeriode(url, periode, kelas, txt)
  {
    $.ajax({
      url: url,
      type: "POST",
      data: {
        periode: periode,
        _token: '{{ csrf_token() }}'
      },
      success: function(response) {
        // alert(response);
        // Refresh angka
        if(kelas == 'sisaBarangHo'){
          $('.sisaBarangHo h6').text(response.data);
          $('.txtSisaBarangHoPeriode').text(txt);

        } else if(kelas == 'barangMasuk')
        {
          $('.barangMasuk h6').text(response.data);
          $('.txtBarangMasuk').text(txt);

        } else if(kelas == 'barangKeluar')
        {
          $('.barangKeluar h6').text(response.data);
          $('.txtBarangKeluar').text(txt);

        } else if(kelas == 'suratJalan')
        {
          $('.suratJalan h6').text(response.data);
          $('.txtSuratJalan').text(txt);
        } else if(kelas == 'barangAging')
        {
          $('.barangAging h6').text(response.data);
          $('.txtBarangAging').text(txt);
        } else if(kelas == 'belumKirimPemasok')
        {
          $('.belumKirimPemasok h6').text(response.data);
          $('.txtBelumKirimPemasok').text(txt);
        } else if(kelas == 'belumTerimaSite')
        {
          $('.belumTerimaSite h6').text(response.data);
          $('.txtBelumTerimaSite').text(txt);
        } else if(kelas == 'batalProses')
        {
          $('.batalProses h6').text(response.data);
          $('.txtBatalProses').text(txt);
        } else if(kelas == 'chart')
        {
          $('.txtChart').text(txt);
          chartPeriode(response.data[0],response.data[1],response.data[2]);
        } else if(kelas == 'chartPengiriman')
        {
          $('.txtPengirimanChart').text(txt);
          if (response.status === 200) {
            var labels = response.labelPerusahaan;
            var data = response.dataPerusahaan;

            // Check if the response contains valid data
            if (Array.isArray(labels) && Array.isArray(data) && labels.length === data.length) {
              chartPengiriman(labels, data);
            } else {
              console.error("Invalid data format in the response.");
            }
          } else {
            console.error("Request failed with status: " + response.status);
          }
        }                          
      
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });
      
        Toast.fire({
            icon: 'success',
            title: 'Periode berhasil diubah'
        })
        
        
      },
      error: function(xhr, status, error) {
        console.log(xhr);
        
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });
      
          Toast.fire({
              icon: 'error',
              title: xhr.responseJSON.error
          })
        
      }
  });
  }
  $('#document').ready(() => {
    // Sisa Barang Ho
      $('.filter-periode-barang-ho').each(function() {
          $(this).on('click', () => {
              var periode = $(this).data('periode');
              var url = "{{ url('sisa-barang-ho-update/periode') }}";
              var kelas = 'sisaBarangHo';
              var txt = $(this).data('text');
              updatePeriode(url, periode, kelas, txt);
          });
      })
      // Barang Masuk
      $('.filter-periode-barang-masuk').each(function() {
          $(this).on('click', () => {
              var periode = $(this).data('periode');
              var url = "{{ url('barang-masuk-update/periode') }}";
              var kelas = 'barangMasuk';
              var txt = $(this).data('text');
              updatePeriode(url, periode, kelas, txt);
          });
      })
      // Barang Keluar
      $('.filter-periode-barang-keluar').each(function() {
          $(this).on('click', () => {
              var periode = $(this).data('periode');
              var url = "{{ url('barang-keluar-update/periode') }}";
              var kelas = 'barangKeluar';
              var txt = $(this).data('text');
              updatePeriode(url, periode, kelas, txt);
          });
      })
      // Surat Jalan
      $('.filter-periode-surat-jalan').each(function() {
          $(this).on('click', () => {
              var periode = $(this).data('periode');
              var url = "{{ url('surat-jalan-update/periode') }}";
              var kelas = 'suratJalan';
              var txt = $(this).data('text');
              updatePeriode(url, periode, kelas, txt);
          });
      })
      // Barang Aging
      $('.filter-periode-barang-aging').each(function() {
          $(this).on('click', () => {
              var periode = $(this).data('periode');
              var url = "{{ url('barang-aging-update/periode') }}";
              var kelas = 'barangAging';
              var txt = $(this).data('text');
              updatePeriode(url, periode, kelas, txt);
          });
      })
      // Batal Kirim Pemasok
      $('.filter-periode-belum-kirim-pemasok').each(function() {
          $(this).on('click', () => {
              var periode = $(this).data('periode');
              var url = "{{ url('belum-kirim-pemasok-update/periode') }}";
              var kelas = 'belumKirimPemasok';
              var txt = $(this).data('text');
              updatePeriode(url, periode, kelas, txt);
          });
      })
      // Belum Terima Site
      $('.filter-periode-belum-terima-site').each(function() {
          $(this).on('click', () => {
              var periode = $(this).data('periode');
              var url = "{{ url('belum-terima-site-update/periode') }}";
              var kelas = 'belumTerimaSite';
              var txt = $(this).data('text');
              updatePeriode(url, periode, kelas, txt);
          });
      })
      // Batal diproses
      $('.filter-periode-batal-proses').each(function() {
          $(this).on('click', () => {
              var periode = $(this).data('periode');
              var url = "{{ url('batal-proses-update/periode') }}";
              var kelas = 'batalProses';
              var txt = $(this).data('text');
              updatePeriode(url, periode, kelas, txt);
          });
      })
      // Chart
      // Batal diproses
      $('.filter-periode-chart').each(function() {
          $(this).on('click', () => {
              var periode = $(this).data('periode');
              var url = "{{ url('chart-update/periode') }}";
              var kelas = 'chart';
              var txt = $(this).data('text');
              updatePeriode(url, periode, kelas, txt);
          });
      })
      // Pengiriman perusahaan
      $('.filter-periode-pengiriman-chart').each(function() {
          $(this).on('click', () => {
              var periode = $(this).data('periode');
              var url = "{{ url('chart-pengiriman-update/periode') }}";
              var kelas = 'chartPengiriman';
              var txt = $(this).data('text');
              updatePeriode(url, periode, kelas, txt);
          });
      })
  })
  
  document.addEventListener("DOMContentLoaded", () => {
    // Chart surat
    //echarts.init(document.querySelector("#trafficChart")).setOption({
    //  tooltip: {
    //    trigger: 'item'
    //  },
    //  legend: {
    //    top: '5%',
    //    left: 'center'
    //  },
    //  series: [{
    //    name: 'Monitoring HO',
    //    type: 'pie',
    //    radius: ['40%', '70%'],
    //    avoidLabelOverlap: false,
    //    label: {
    //      show: false,
    //      position: 'center'
    //    },
    //    emphasis: {
    //      label: {
    //        show: true,
    //        fontSize: '18',
    //        fontWeight: 'bold'
    //      }
    //    },
    //    labelLine: {
    //      show: false
    //    },
    //    data: [{
    //        value: '{{ $countProses }}',
    //        name: 'Pengiriman Diproses'
    //      },   
    //      {
    //        value: '{{ $countTerima }}',
    //        name: 'Pengiriman Diterima'
    //      },
    //      {
    //        value: '{{ $countKirimPemasok }}',
    //        name: 'Pengiriman Dikirim'
    //      },
    //    ]
    //  }]
    //});

    // Chart pengiriman
      var labels = @json($labelPerusahaan);
      var data = @json($dataPerusahaan);
      echarts.init(document.querySelector("#pieChart")).setOption({
        title: {
          text: 'Pengiriman by Perusahaan',
          subtext: 'Data Pengiriman',
          left: 'center'
        },
        tooltip: {
          trigger: 'item'
        },
        legend: {
          orient: 'vertical',
          left: 'left'
        },
        series: [{
          name: 'Access From',
          type: 'pie',
          radius: '50%',
          data: data.map((value, index) => ({
                  value: value,
                  name: labels[index]
              })),
          emphasis: {
            itemStyle: {
              shadowBlur: 10,
              shadowOffsetX: 0,
              shadowColor: 'rgba(0, 0, 0, 0.5)'
            }
          }
        }]
      });
  });

  function chartPeriode(data0, data1, data2)
  {
    echarts.init(document.querySelector("#trafficChart")).setOption({
        tooltip: {
          trigger: 'item'
        },
        legend: {
          top: '5%',
          left: 'center'
        },
        series: [{
          name: 'Monitoring HO',
          type: 'pie',
          radius: ['40%', '70%'],
          avoidLabelOverlap: false,
          label: {
            show: false,
            position: 'center'
          },
          emphasis: {
            label: {
              show: true,
              fontSize: '18',
              fontWeight: 'bold'
            }
          },
          labelLine: {
            show: false
          },
          data: [{
            value: data0,
            name: 'Pengiriman Diproses'
          },   
          {
            value: data1,
            name: 'Pengiriman Diterima'
          },
          {
            value: data2,
            name: 'Pengiriman Dikirim'
          },
        ]
        }]
      });
  }

  function chartPengiriman(labels, data)
  {
    echarts.init(document.querySelector("#pieChart")).setOption({
        title: {
          text: 'Pengiriman by Perusahaan',
          subtext: 'Data Pengiriman',
          left: 'center'
        },
        tooltip: {
          trigger: 'item'
        },
        legend: {
          orient: 'vertical',
          left: 'left'
        },
        series: [{
          name: 'Access From',
          type: 'pie',
          radius: '50%',
          data: data.map((value, index) => ({
                  value: value,
                  name: labels[index]
              })),
          emphasis: {
            itemStyle: {
              shadowBlur: 10,
              shadowOffsetX: 0,
              shadowColor: 'rgba(0, 0, 0, 0.5)'
            }
          }
        }]
      });
  }
</script>
@endsection