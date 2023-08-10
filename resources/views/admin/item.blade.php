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
    <a class="nav-link " href="/daftar-barang">
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
    <a class="nav-link collapsed" href="/">
      <i class="bi bi-box-arrow-in-right"></i>
      <span>Logout</span>
    </a>
  </li><!-- End Login Page Nav -->

</ul>

</aside>
@endsection

@section('content')
    <div class="pagetitle">
      <h1>Barang Diterima di HO</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/admin-dashboard">Dashboard</a></li>
          <li class="breadcrumb-item active">Barang Diterima di HO</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

                <div class="card">
                    <div class="card-body">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                    <h5 class="card-title">Daftar Barang Diterima di HO</h5><div style="text-align: left">
                <a type="button" href="/tambahitem" class="btn btn-primary"><i class="bi bi-plus"></i> Tambah</a>
                </div>
               
                </div>
                    <!-- Table with stripped rows -->
                    <table class="datatable" id="tabel_item">
                        <thead>
                        <tr>
                            <th scope="col" style="width: 3%;">#</th>
                            <th class="text-center" style="width: 10%;;">Diminta Oleh</th>
                            <th scope="col" style="width: 10%;">Tujuan</th>
                            <th class="text-center" style="width: 10%;;">Barang</th>
                            <th scope="col" style="width: 5%;">Sisa / <span class="badge rounded-pill bg-success"> Keluar</span></th>
                            <th scope="col" style="width: 7%;">Unit</th>
                            <th scope="col" style="width: 15%;">No PO/PR</th>
                            <th scope="col" style="width: 10%;">Pemasok</th>
                            <th scope="col" style="width: 15%;">Tgl Kedatangan</th>
                            <th scope="col" style="width: 3%;">Status</th>
                            <th scope="col" style="width: 3%;">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $no = 1; @endphp
                        @foreach($barang as $row)
                        @php 
                          $jml_detail_ho = DB::table('pengiriman_ho_detail as a')
                                          ->join('pengiriman_ho as b', 'a.no_faktur', '=', 'b.no_faktur')
                                          ->select('a.jumlah')
                                          ->where('a.id_barang', $row->id)
                                          ->where('b.status', '!=', 'dibatalkan')
                                          ->sum('jumlah');
                        @endphp
                        <tr>
                            <th scope="row" >{{ $no++ }}</th>
                            <td>{{ $row->user }}</td>
                            <td><span class="tooltip-perusahaan" data-perusahaan="{{ $row->perusahaan }}">{{ substr($row->perusahaan, 0, 10) }}...</span></td>
                            <td>{{ $row->item }}</td>
                            <td>{{ $row->jumlah }} / @if($jml_detail_ho > 0) <span class="badge rounded-pill bg-success">{{ $jml_detail_ho }}</span> @else <span class="badge rounded-pill bg-success">0</span> @endif</td>
                            <td>{{ $row->unit }}</td>
                            <td>{{ $row->nomor_po }}</td>
                            <td>{{ $row->pemasok }}</td>
                            <td>{{ ($row->tgl_kedatangan != null ? date('m/d/Y', strtotime($row->tgl_kedatangan)) : '') }}</td>
                            <td>
                              @if($row->jumlah == '0')
                              <span class="badge rounded-pill bg-success">Terkirim</span>
                              @endif
                              @php 
                                
                                $startDate = \Carbon\Carbon::parse($row->tgl_kedatangan);
                                $endDate = \Carbon\Carbon::parse(NOW());
                                $hasil = $endDate->diffInDays($startDate);
                                
                                $countDetail = DB::table('pengiriman_ho_detail')->where('id_barang', '=', $row->id)->count();
                              @endphp
                              @if($hasil < 1 && $row->jumlah > 0)
                                <span class="badge rounded-pill bg-secondary">{{ $hasil }} hari</span>
                              @elseif($hasil >= 1 && $hasil <= 2 && $row->jumlah > 0)
                                <span class="badge rounded-pill bg-primary">{{ $hasil }} hari</span>
                              @elseif($hasil > 2 && $hasil <= 4 && $row->jumlah > 0)
                                <span class="badge rounded-pill bg-warning">{{ $hasil }} hari</span>
                                @elseif($hasil >= 5 && $row->jumlah > 0)
                              <span class="badge rounded-pill bg-danger">{{ $hasil }} hari</span>
                              @endif
                            </td>
                            <td>
                              <button type="button" class="btn btn-primary btn-sm btnEdit {{ ($countDetail > 0) ? 'disabled' : '' }}" data-id="{{ $row->id }}"><i class="bi bi-pencil"></i></button>
                              <button type="button" class="btn btn-danger btn-sm btnDelete {{ ($countDetail > 0) ? 'disabled' : '' }}" data-id="{{ $row->id }}" onclick="konfirmasiHapus({{ $row->id }})"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>
                        @endforeach
                        
                        </tbody>
                    </table>
                    <!-- End Table with stripped rows -->
                    
                  </div>
              </div>
            </div>
        </div>
        <a href="/admin-dashboard"><i class="bi bi-arrow-left">Kembali</i></a>
<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script>
  $(document).ready(function() {
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

      // END ALERT
      $('.tooltip-perusahaan').each(function(){
        $(this).tooltip({
          title: $(this).data('perusahaan'),
          placement: 'top' // Adjust the placement as needed (top, bottom, left, right)
        });
      })

      $('.btnEdit').each(function() {
        $(this).on('click', function() {
            var id = $(this).data('id');
            var url = "{{ url('edit-item') }}/"+id+"";

            window.location.href = url;
        })
      })   
  })
  function konfirmasiHapus(id)
  {
    event.preventDefault();
    Swal.fire({
        icon: "question",
        title: "Konfirmasi",
        text: "Apakah anda yakin ingin menghapus data?",
        showCancelButton: true,
        confirmButtonText: "Hapus",
        cancelButtonText: "Batal"
    }).then((result) => {
        if(result.value) {
            $.ajax({
              url: "{{ url('delete-item') }}/"+id+"",
              type: "GET",
              data: {
                id: id,
                _token: '{{ csrf_token() }}'
              },
              success: function(response) {
                // alert(response);
                // var tbody = $('#tabel_item tbody');
                // Refresh tabel
                  // tbody.load(document.URL + ' #tabel_item tbody tr', function() {
                  //     deleteButton();
                  // });  
                var Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                });

                Toast.fire({
                    icon: 'success',
                    title: 'Data berhasil dihapus'
                })
                
                setTimeout(function() {
                  window.location.reload();
                }, 1500);
              },
              error: function(xhr, status, error) {
                console.log(xhr);
                
                var Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                });

                if(xhr.status == 422)
                {
                  Toast.fire({
                      icon: 'error',
                      title: 'Oops.. tidak dapat menghapus data ini karena sedang digunakan di entitas lain.'
                  })
                } else {
                  Toast.fire({
                      icon: 'error',
                      title: xhr.responseJSON.error
                  })
                }
      
              }
          });
        } else {
            Swal.fire("Informasi","Data batal dihapus","error");
        }
    });
  }
  
  function deleteButton()
  {
    $('.btnDelete').each(function() {
        $(this).click(function() {
          var id = $(this).data('id');
        })
      })
  }
</script>      
@endsection