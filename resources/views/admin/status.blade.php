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
    <a class="nav-link " href="{{ url('adminstatus') }}">
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
    <h1>Status Pengiriman</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin-dashboard">Dashboard</a></li>
            <li class="breadcrumb-item active">Status Pengiriman</li>
        </ol>
    </nav>
</div>


<div class="col-12">
    <div class="card recent-sales overflow-auto">
        <div class=""></div>
        <div class="card-body"><div style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
            <h5 class="card-title">Pengiriman</h5><div style="text-align: left">
                <!-- <a type="button" href="/tambah-pengiriman" class="btn btn-primary"><i class="bi bi-plus"></i> Tambah</a>
               -->
               <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Tambah
                </button>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="{{ url('tambah-pengiriman') }}">Pengiriman HO</a></li>
                  <li><a class="dropdown-item" href="{{ url('tambah-pengiriman-site') }}">Pengiriman Pemasok</a></li>
                </ul>
              </div>
            </div>
        </div>
        <div class="row mb-2">
          <div class="col-3">
            <select name="filter_pengiriman" id="filter_pengiriman" class="form-select">
              <option hidden>Filter Pengiriman</option>
              <?php 
              if(isset($_GET['pengiriman'])) {
                ?>
                  <option value="all" <?= ($_GET['pengiriman'] == 'all') ? 'selected' : '' ?>>Pengiriman Keseluruhan</option>
                  <option value="ho" <?= ($_GET['pengiriman'] == 'ho') ? 'selected' : '' ?>>Pengiriman dari HO</option>
                  <option value="pemasok" <?= ($_GET['pengiriman'] == 'pemasok') ? 'selected' : '' ?>>Pengiriman ke Pemasok</option>
                <?php
              } else {
                ?>
                <option value="all">Pengiriman Keseluruhan</option>
                <option value="ho">Pengiriman dari HO</option>
                <option value="pemasok">Pengiriman ke Pemasok</option>
                <?php
              }

              ?>
            </select>
          </div>
        </div>
          <table class="table table-borderless datatable" id="myTable">
              <thead>
                  <tr>
                      <th scope="col">#</th>
                      <th scope="col">No Surat Jalan</th>
                      <th scope="col">Perusahaan</th>
                      <th scope="col">Ekspedisi</th>
                      <th scope="col">Tgl Surat Jalan</th>
                      <th scope="col">Tgl Pemasok Kirim</th>
                      <th scope="col">Tgl Diterima Site</th>
                      <th scope="col">Status</th>
                      <th scope="col">Action</th>
                  </tr>
              </thead>
              <tbody>
              @php $no = 1; @endphp
                  <?php 
                    if(isset($_GET['pengiriman']))
                    {
                      if($_GET['pengiriman'] == 'all')
                      {
                        $pengiriman = $result;
                      } else if($_GET['pengiriman'] == 'ho')
                      {
                        $pengiriman = $ho;
                      } else if($_GET['pengiriman'] == 'pemasok')
                      {
                        $pengiriman = $pemasok;
                      }

                      ?>
                      @forelse($pengiriman as $row)
                        <tr>
                          <th scope="row">{{ $no++ }}</th>
                          <td>{{ $row->no_faktur }}</td>
                          <td><span class="tooltip-perusahaan" data-perusahaan="{{$row->perusahaan}}">{{ substr($row->perusahaan, 0, 10) }}...</span></td>
                          <td>{{ $row->ekspedisi }}</td>
                          <td>{{ date('m/d/Y', strtotime($row->tgl_surat_jalan)) }}</td>
                          <td> 
                            @if(substr($row->no_faktur, 0, 2) == 'SP')
                              <input type="date" data-id="{{$row->id}}" class="form-control tanggal_dikirim_site" value="{{ $row->tgl_kirim_pemasok }}" 
                              {{ ($row->status == 'dikirim' || $row->status == 'diterima' || $row->status == 'dibatalkan') ? 'readonly' : '' }}>
                            @else 
                            -  
                            @endif
                          </td>
                          <td>
                            @if(substr($row->no_faktur, 0, 2) == 'SJ')
                              <input type="date" data-id="{{$row->id}}" class="form-control tanggal_diterima_ho" value="{{ $row->tgl_diterima_site }}" {{ ($row->status == 'diterima' || $row->status == 'dibatalkan') ? 'readonly' : '' }}>
                            @elseif(substr($row->no_faktur, 0, 2) == 'SP')
                              <input type="date" data-id="{{$row->id}}" class="form-control tanggal_diterima_site" value="{{ $row->tgl_diterima_site }}" 
                              {{ ($row->status == 'diterima' || $row->status == 'diproses' || $row->status == 'dibatalkan') ? 'readonly' : '' }}>
                            @endif
                          </td>
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
                            @if(substr($row->no_faktur, 0, 2) == 'SJ')
                            <a href="{{ url('detail/pengiriman-ho/'.$row->id) }}" class="btn btn-primary btn-sm"><i class="bi bi-eye"></i></a>
                            <!-- <button type="button" class="btn btn-warning btn-sm" id="printButton" onclick="print(1)"><i class="bi bi-printer"></i></button> -->
                            <button type="button" data-id="{{ $row->id }}" data-nosurat="{{ $row->no_faktur }}" class="btn btn-danger btn-sm btnBatalHo {{ ($row->status == 'diproses') ? '' : 'disabled' }}"><i class="bi bi-x-lg"></i></button>
                            @elseif(substr($row->no_faktur, 0, 2) == 'SP')
                            <a href="{{ url('detail/pengiriman-site/'.$row->id) }}" class="btn btn-primary btn-sm"><i class="bi bi-eye"></i></a>
                            <!-- <button type="button" class="btn btn-warning btn-sm" id="printButton" onclick="print(1)"><i class="bi bi-printer"></i></button> -->
                            <button type="button" data-id="{{ $row->id }}" data-nosurat="{{ $row->no_faktur }}" class="btn btn-danger btn-sm btnBatalSite {{ ($row->status == 'diproses') ? '' : 'disabled' }}"><i class="bi bi-x-lg"></i></button>
                            @endif
                          </td>
                        </tr>
                      @empty
                      @endforelse
                      <?php
                    } else {
                      ?>
                      @forelse($result as $row)
                        <tr>
                          <th scope="row">{{ $no++ }}</th>
                          <td>{{ $row->no_faktur }}</td>
                          <td><span class="tooltip-perusahaan" data-perusahaan="{{$row->perusahaan}}">{{ substr($row->perusahaan, 0, 10) }}...</span></td>
                          <td>{{ $row->ekspedisi }}</td>
                          <td>{{ date('m/d/Y', strtotime($row->tgl_surat_jalan)) }}</td>
                          <td> 
                            @if(substr($row->no_faktur, 0, 2) == 'SP')
                              <input type="date" data-id="{{$row->id}}" class="form-control tanggal_dikirim_site" value="{{ $row->tgl_kirim_pemasok }}" 
                              {{ ($row->status == 'dikirim' || $row->status == 'diterima' || $row->status == 'dibatalkan') ? 'readonly' : '' }}>
                            @else 
                            -  
                            @endif
                          </td>
                          <td>
                            @if(substr($row->no_faktur, 0, 2) == 'SJ')
                              <input type="date" data-id="{{$row->id}}" class="form-control tanggal_diterima_ho" value="{{ $row->tgl_diterima_site }}" {{ ($row->status == 'diterima' || $row->status == 'dibatalkan') ? 'readonly' : '' }}>
                            @elseif(substr($row->no_faktur, 0, 2) == 'SP')
                              <input type="date" data-id="{{$row->id}}" class="form-control tanggal_diterima_site" value="{{ $row->tgl_diterima_site }}" 
                              {{ ($row->status == 'diterima' || $row->status == 'diproses' || $row->status == 'dibatalkan') ? 'readonly' : '' }}>
                            @endif
                          </td>
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
                            @if(substr($row->no_faktur, 0, 2) == 'SJ')
                            <a href="{{ url('detail/pengiriman-ho/'.$row->id) }}" class="btn btn-primary btn-sm"><i class="bi bi-eye"></i></a>
                            <button class="btn btn-warning btn-sm printButtonHo" data-id="{{ $row->id }}"><i class="bi bi-printer"></i></button>
                            <button type="button" data-id="{{ $row->id }}" data-nosurat="{{ $row->no_faktur }}" class="btn btn-danger btn-sm btnBatalHo {{ ($row->status == 'diproses') ? '' : 'disabled' }}"><i class="bi bi-x-lg"></i></button>
                            @elseif(substr($row->no_faktur, 0, 2) == 'SP')
                            <a href="{{ url('detail/pengiriman-site/'.$row->id) }}" class="btn btn-primary btn-sm"><i class="bi bi-eye"></i></a>
                            <button class="btn btn-warning btn-sm printButton" data-id="{{ $row->id }}"><i class="bi bi-printer"></i></button>
                            <button type="button" data-id="{{ $row->id }}" data-nosurat="{{ $row->no_faktur }}" class="btn btn-danger btn-sm btnBatalSite {{ ($row->status == 'diproses') ? '' : 'disabled' }}"><i class="bi bi-x-lg"></i></button>
                            @endif
                          </td>
                        </tr>
                      @empty
                      @endforelse
                      <?php
                    }
                  ?>
                 
              </tbody>
          </table>
        </div>
    </div>
</div>
<a href="{{ url('/admin-dashboard') }}"><i class="bi bi-arrow-left">Kembali</i></a>

<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

<script>
  $(document).ready(function(){
    var Toast = Swal.mixin({
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          timer: 3000
      });
      
      @if(session()->has('success'))
      Toast.fire({
          icon: 'success',
          title: '{{Session::get("success")}}'
      })
      @elseif(session()->has('error'))
      Toast.fire({
          icon: 'error',
          title: '{{Session::get("error")}}'
      })
      @endif
      
      $('.tooltip-perusahaan').each(function(){
        $(this).tooltip({
          title: $(this).data('perusahaan'),
          placement: 'top' // Adjust the placement as needed (top, bottom, left, right)
        });
      })

      // Update HO tanggal diterima
      $('.tanggal_diterima_ho').each(function() {
         $(this).on('change', function() {
            const id = $(this).data('id');
            const tgl = $(this).val();
            konfirmasiTglHO(id, tgl);
         })
      })

      // Update site tanggal dikirim
      $('.tanggal_dikirim_site').each(function() {
         $(this).on('change', function() {
            const id = $(this).data('id');
            const tgl = $(this).val();
            konfirmasiTglKirimSite(id, tgl);
         })
      })

      // Update site tanggal diterima
      $('.tanggal_diterima_site').each(function() {
         $(this).on('change', function() {
            const id = $(this).data('id');
            const tgl = $(this).val();
            konfirmasiTglSite(id, tgl);
         })
      })

      // Update batal ho
      $('.btnBatalHo').each(function() {
        $(this).on('click', function() {
          const id = $(this).data('id');
          const no_surat = $(this).data('nosurat');
          konfirmasiBatalHO(id, no_surat);
        })
      })

      // Update batal pemasok
      $('.btnBatalSite').each(function() {
        $(this).on('click', function() {
          const id = $(this).data('id');
          const no_surat = $(this).data('nosurat');
          konfirmasiBatalPemasok(id, no_surat);
        })
      })

      $('.printButton').each(function(){
          $(this).on('click', function() {
              var id = $(this).data('id');
              window.location.href = "{{ url('print') }}/"+id+"";
          })
      })

      $('.printButtonHo').each(function(){
          $(this).on('click', function() {
              var id = $(this).data('id');
              window.location.href = "{{ url('printho') }}/"+id+"";
          })
      })
  });

  function inputTglDiterimaHO()
  {
    // Update HO tanggal diterima
    $('.tanggal_diterima_ho').each(function() {
         $(this).on('change', function() {
            const id = $(this).data('id');
            const tgl = $(this).val();
            konfirmasiTglHO(id, tgl);
         })
      })
  }

  function inputTglDikirimSite()
  {
    // Update HO tanggal diterima
    $('.tanggal_dikirim_site').each(function() {
         $(this).on('change', function() {
            const id = $(this).data('id');
            const tgl = $(this).val();
            konfirmasiTglKirimSite(id, tgl);
         })
      })
  }

  function inputTglDiterimaSite()
  {
    // Update HO tanggal diterima
    $('.tanggal_diterima_site').each(function() {
        $(this).on('change', function() {
            const id = $(this).data('id');
            const tgl = $(this).val();
            konfirmasiTglSite(id, tgl);
         })
      })
  }
  
  function statusBatalHo()
  {
    $('.btnBatalHo').each(function() {
      $(this).on('click', function() {
        const id = $(this).data('id');
        const no_surat = $(this).data('nosurat');
        konfirmasiBatalHO(id, no_surat);
      })
    })
  }

  function statusBatalPemasok()
  {
    $('.btnBatalSite').each(function() {
      $(this).on('click', function() {
        const id = $(this).data('id');
        const no_surat = $(this).data('nosurat');
        konfirmasiBatalPemasok(id, no_surat);
      })
    })
  }
  // Sweetalert
  function konfirmasiTglHO(id, tgl)
  {
      event.preventDefault();
      var form = event.target.form;
      Swal.fire({
          icon: "question",
          title: "Konfirmasi",
          text: "Apakah anda yakin ingin menyimpan data?",
          showCancelButton: true,
          confirmButtonText: "Simpan",
          cancelButtonText: "Batal"
      }).then((result) => {
          if(result.value) {
              $.ajax({
                url: "{{ url('update-status-ho/terima') }}/"+id+"",
                type: "POST",
                data: {
                  tgl_diterima: tgl,
                  _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                  // alert(response);
                  // Refresh tabel
                  $('#myTable tbody').load(document.URL + ' #myTable tbody tr', function() {
                    inputTglDikirimSite();
                    inputTglDiterimaHO();
                    inputTglDiterimaSite();
                    statusBatalHo();
                    statusBatalPemasok();
                  });

                  var Toast = Swal.mixin({
                      toast: true,
                      position: 'top-end',
                      showConfirmButton: false,
                      timer: 3000
                  });

                  Toast.fire({
                      icon: 'success',
                      title: 'Data berhasil disimpan'
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
          } else {
              Swal.fire("Informasi","Data batal disimpan","error");
          }
      });
    }

  function konfirmasiTglKirimSite(id, tgl)
  {
      event.preventDefault();
      var form = event.target.form;
      Swal.fire({
          icon: "question",
          title: "Konfirmasi",
          text: "Apakah anda yakin ingin menyimpan data?",
          showCancelButton: true,
          confirmButtonText: "Simpan",
          cancelButtonText: "Batal"
      }).then((result) => {
          if(result.value) {
              $.ajax({
                url: "{{ url('update-status/kirim') }}/"+id+"",
                type: "POST",
                data: {
                  tgl_kirim_pemasok: tgl,
                  _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                  // alert(response);
                  // Refresh tabel
                  $('#myTable tbody').load(document.URL + ' #myTable tbody tr', function() {
                    inputTglDikirimSite();
                    inputTglDiterimaHO();
                    inputTglDiterimaSite();
                    statusBatalHo();
                    statusBatalPemasok();
                  });

                  var Toast = Swal.mixin({
                      toast: true,
                      position: 'top-end',
                      showConfirmButton: false,
                      timer: 3000
                  });

                  Toast.fire({
                      icon: 'success',
                      title: 'Data berhasil disimpan'
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
          } else {
              Swal.fire("Informasi","Data batal disimpan","error");
          }
      });
  }

  function konfirmasiTglSite(id, tgl)
  {
      event.preventDefault();
      var form = event.target.form;
      Swal.fire({
          icon: "question",
          title: "Konfirmasi",
          text: "Apakah anda yakin ingin menyimpan data?",
          showCancelButton: true,
          confirmButtonText: "Simpan",
          cancelButtonText: "Batal"
      }).then((result) => {
          if(result.value) {
              $.ajax({
                url: "{{ url('update-status/terima') }}/"+id+"",
                type: "POST",
                data: {
                  tgl_diterima_site: tgl,
                  _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                  // alert(response);
                  // Refresh tabel
                  $('#myTable tbody').load(document.URL + ' #myTable tbody tr', function() {
                    inputTglDikirimSite();
                    inputTglDiterimaHO();
                    inputTglDiterimaSite();
                    statusBatalHo();
                    statusBatalPemasok();
                  });

                  var Toast = Swal.mixin({
                      toast: true,
                      position: 'top-end',
                      showConfirmButton: false,
                      timer: 3000
                  });

                  Toast.fire({
                      icon: 'success',
                      title: 'Data berhasil disimpan'
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
          } else {
              Swal.fire("Informasi","Data batal disimpan","error");
          }
      });
    }

  function konfirmasiBatalHO(id, no_surat)
  {
      event.preventDefault();
      var form = event.target.form;
      Swal.fire({
          icon: "question",
          title: "Konfirmasi",
          text: "Apakah anda yakin ingin membatalkan pengiriman?",
          showCancelButton: true,
          confirmButtonText: "Simpan",
          cancelButtonText: "Batal"
      }).then((result) => {
          if(result.value) {
              $.ajax({
                url: "{{ url('update-status-ho/batal') }}/"+id+"",
                type: "POST",
                data: {
                  id: id,
                  no_faktur: no_surat,
                  _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                  // alert(response);
                  // Refresh tabel
                  $('#myTable tbody').load(document.URL + ' #myTable tbody tr', function() {
                    inputTglDikirimSite();
                    inputTglDiterimaHO();
                    inputTglDiterimaSite();
                    statusBatalHo();
                    statusBatalPemasok();
                  });

                  var Toast = Swal.mixin({
                      toast: true,
                      position: 'top-end',
                      showConfirmButton: false,
                      timer: 3000
                  });

                  Toast.fire({
                      icon: 'success',
                      title: 'Data berhasil dibatalkan'
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
          } else {
              Swal.fire("Informasi","Data gagal dibatalkan","error");
          }
      });
    }

  function konfirmasiBatalPemasok(id, no_surat)
  {
      event.preventDefault();
      var form = event.target.form;
      Swal.fire({
          icon: "question",
          title: "Konfirmasi",
          text: "Apakah anda yakin ingin membatalkan pengiriman?",
          showCancelButton: true,
          confirmButtonText: "Simpan",
          cancelButtonText: "Batal"
      }).then((result) => {
          if(result.value) {
              $.ajax({
                url: "{{ url('update-status/batal') }}/"+id+"",
                type: "POST",
                data: {
                  id: id,
                  no_faktur: no_surat,
                  _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                  // alert(response);
                  // Refresh tabel
                  $('#myTable tbody').load(document.URL + ' #myTable tbody tr', function() {
                    inputTglDikirimSite();
                    inputTglDiterimaHO();
                    inputTglDiterimaSite();
                    statusBatalHo();
                    statusBatalPemasok();
                  });

                  var Toast = Swal.mixin({
                      toast: true,
                      position: 'top-end',
                      showConfirmButton: false,
                      timer: 3000
                  });

                  Toast.fire({
                      icon: 'success',
                      title: 'Data berhasil dibatalkan'
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
          } else {
              Swal.fire("Informasi","Data gagal dibatalkan","error");
          }
      });
    }

  function updateStatus(status, tanggalDiterimaId, statusSupplierId, statusBarangId) {
      const tanggalDiterima = document.getElementById(tanggalDiterimaId);
      const today = new Date().toISOString().slice(0, 10);
      tanggalDiterima.value = today;
      tanggalDiterima.readOnly = true;
      const button = tanggalDiterima.closest('tr').querySelector('button.btn-primary');
      button.disabled = true;
      button.innerText = status;
      button.classList.remove('btn-primary');
      button.classList.add('btn-success');
      
      const statusSupplierElement = document.getElementById(statusSupplierId);
      statusSupplierElement.innerText = status;
      statusSupplierElement.classList.remove('text-primary');
      statusSupplierElement.classList.add('text-success');
      
      const statusBarangElement = document.getElementById(statusBarangId);
      if (statusBarangElement.innerText !== 'Diterima') {
          statusBarangElement.innerText = status;
          statusBarangElement.classList.remove('text-primary');
          statusBarangElement.classList.add('text-success');
      }
  }

  // Filtering
  $('#filter_pengiriman').on('change', function() {
    var value = $(this).val();
    window.location.href = "{{ url('adminstatus?pengiriman=') }}"+value+"";
  });
  // window.onscroll = function() {myFunction()};

  // var button = document.querySelector('.floating-button');
  // var buttonOffset = button.offsetTop;

  // function myFunction() {
  //   if (window.pageYOffset > buttonOffset) {
  //     button.classList.add('fixed-button');
  //   } else {
  //     button.classList.remove('fixed-button');
  //   }
  // }


    // Fungsi untuk mencetak halaman saat tombol diclick
//    function printPage() {
//    //  window.print();
//    alert()
//  }
//
//  //   // Mendapatkan referensi tombol print
//  //   const printButton = document.getElementById('printButton');
//  //   // console.log(printButton)
//
//  //   // // Menambahkan event listener untuk tombol print
//  //   // printButton.addEventListener('click', function(){
//  //   //   alert()
//  //   // });
//
//  //   $('#printButton').on('click', function() {
//  //   alert();
//  // });
//
//  //function print(a)
//  //{
//  //  alert(a)
//  //}
//
//  $.ajax({
//    method: "GET",
//    url: "/print/{id}"
//    })
//    .done(function(msg) {
//    alert("Data Saved: " + msg );
//    });
//
//    $(document).ready(function print() {
//      $("#printButton").click(function() {
//        var fileUrl = "/print/{id}";
//        window.location.href = fileUrl;
//      });
//    });
//  
//  
//
//    $(document).ready(function () {
//        $("#printButton").click(function () {
//            // Ganti "http://example.com/path/to/your/file.pdf" dengan URL PDF Anda
//            var pdfUrl = "/print/{id}"
//            // Menggunakan metode Ajax untuk mengambil data PDF
//            $.ajax({
//                url: pdfUrl,
//                type: "GET",
//                xhrFields: {
//                    responseType: 'blob' // Menentukan bahwa responsnya akan berupa Blob
//                },
//                success: function (data) {
//                    // Membuat objek URL dari Blob PDF
//                    var pdfBlob = new Blob([data], { type: 'application/pdf' });
//                    var pdfUrl = URL.createObjectURL(pdfBlob)
//                    // Membuat link sementara untuk diunduh
//                    var downloadLink = document.createElement('a');
//                    downloadLink.href = pdfUrl;
//                    downloadLink.download = 'downloaded_file.pdf';
//                    document.body.appendChild(downloadLink)
//                    // Simulasi klik pada link untuk memulai unduhan
//                    downloadLink.click()
//                    // Membersihkan objek URL dan link
//                    URL.revokeObjectURL(pdfUrl);
//                    document.body.removeChild(downloadLink);
//                },
//                error: function () {
//                    alert('Gagal mengunduh PDF.');
//                }
//            });
//        });
//    });
//</script>

@endsection