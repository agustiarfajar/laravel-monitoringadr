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
    <a class="nav-link " data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-menu-button-wide-fill"></i><span>Master</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      <li>
        <a href="{{ url('perusahaan') }}" class="active">
          <i class="bi bi-circle-fill"></i><span>Perusahaan</span>
        </a>
      </li>
      <li>
        <a href="{{ url('ekspedisi') }}" class="active">
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
      <h1>Daftar Ekspedisi</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/admin-dashboard">Dashboard</a></li>
          <li class="breadcrumb-item active">Daftar Ekspedisi</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Tambah Ekspedisi</h5>

                <!-- Tambah Ekspedisi -->
            <div class="">
                <form class="row g-3" method="post" action="{{ url('ekspedisi/save') }}">
                  @csrf
                <div class="col-md-11">
                  <input type="text" name="perusahaan" id="perusahaan" class="form-control" placeholder="Masukkan nama perusahaan">
                </div>
                <button type="button" onclick="konfirmasiSimpan()" class="btn btn-primary col-md-1"><i class="bi bi-plus-lg"></i></button>
                </form>
            </div>  
            </div>
        </div>

        <div class="card">
            <div class="card-body">
              <h5 class="card-title">Daftar Ekspedisi</h5>
              
              <!-- Daftar Perusahaan -->
              <table class="table table-hover" id="tabel_perusahaan">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Perusahaan</th>
                    <th scope="col">Edit</th>
                  </tr>
                </thead>
                <tbody id="tbody">
                  @php $no = 1; @endphp
                  @forelse($perusahaan as $row)
                  <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $row->perusahaan }}</td>
                    <td><button type="button" class="btn btn-warning btn-sm btnEdit"
                        data-id="{{ $row->id }}"
                        data-perusahaan="{{ $row->perusahaan }}">
                        <i class="bi bi-pencil-square"></i></button>
                        <button type="button" class="btn btn-danger btn-sm btnHapus" onclick="konfirmasiHapus({{ $row->id }})"><i class="bi bi-trash"></i></button>
                    </td>
                  </tr>
                  @empty
                  <tr>
                    <td align="center" colspan="3">Tidak ada data</td>
                  </tr>
                  @endforelse 
                </tbody>
              </table>
              <!-- End Daftar Perusahaan -->

            </div>
        </div>
        <a href="{{ url('/admin-dashboard') }}"><i class="bi bi-arrow-left">Kembali</i></a>

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
      
      editButton();
  });

  function konfirmasiSimpan()
  {
    event.preventDefault();
    var form = event.target.form;
    var input = $('#perusahaan').val();
    if(input == '')
    {
      return alert('Perusahaan masih kosong, silahkan isi data dengan benar');
    } else {
      Swal.fire({
        icon: "question",
        title: "Konfirmasi",
        text: "Apakah anda yakin ingin menyimpan data?",
        showCancelButton: true,
        confirmButtonText: "Simpan",
        cancelButtonText: "Batal"
    }).then((result) => {
        if(result.value) {
            // form.submit();
            $.ajax({
              url: "{{ url('perusahaan/save') }}",
              type: "POST",
              data: {
                perusahaan: input,
                _token: '{{ csrf_token() }}'
              },
              success: function(response) {
                // alert(response);
                var tabel = $('#tabel_perusahaan');
                // Refresh tabel
                  $('#tbody').load(document.URL + ' #tbody tr', function() {
                      editButton();
                      deleteButton();
                  });

                  // reset data tambah barang
                  $('#perusahaan').val('');

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
  }

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
              url: "{{ url('perusahaan/delete') }}/"+id+"",
              type: "GET",
              data: {
                id: id,
                _token: '{{ csrf_token() }}'
              },
              success: function(response) {
                // alert(response);
                var tabel = $('#tabel_perusahaan');
                // Refresh tabel
                  $('#tbody').load(document.URL + ' #tbody tr', function() {
                      editButton();
                      deleteButton();
                  });

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

  async function modalEdit(id, perusahaan)
  {
    const { value: perusahaanDB } = await Swal.fire({
      title: 'Ubah Perusahaan',
      input: 'text',
      inputLabel: 'Nama Perusahaan',
      inputValue: perusahaan,
      showCancelButton: true,
      confirmButtonText: "Simpan",
      cancelButtonText: "Batal",
      inputValidator: (value) => {
        if (!value) {
          return 'Data tidak boleh kosong'
        }
      }
    })

    if(perusahaanDB) {
        $.ajax({
          url: "{{ url('perusahaan/update') }}/"+id+"",
          type: "POST",
          data: {
            perusahaan: perusahaanDB,
            _token: '{{ csrf_token() }}'
          },
          success: function(response) {
            // alert(response);
            var tabel = $('#tabel_perusahaan');
            // Refresh tabel
              $('#tbody').load(document.URL + ' #tbody tr', function() {
                  editButton();
                  deleteButton();
              });

            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });

            Toast.fire({
                icon: 'success',
                title: 'Data berhasil diubah'
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
  } 

  function editButton()
  {
    $('.btnEdit').each(function() {
        $(this).click(function() {
          // alert('ok');
          var id = $(this).data('id');
          var perusahaan = $(this).data('perusahaan');
          modalEdit(id, perusahaan);

        })
      })
  }

  function deleteButton()
  {
    $('.btnHapus').each(function() {
        $(this).click(function() {
          // alert('ok');
          var id = $(this).data('id');
        })
      })
  }
</script>
@endsection