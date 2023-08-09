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
        <a href="{{ url('perusahaan') }}">
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
                <form class="row g-3" method="post">
                  @csrf
                <div class="col-md-12">
                  <label for="ekspedisi" class="form-label">Nama Ekspedisi</label>
                  <input type="text" name="ekspedisi" id="ekspedisi" class="form-control" placeholder="Masukkan nama ekspedisi" autocomplete="off" oninput="this.value = this.value.toUpperCase()">
                </div>
                <div class="col-md-6">
                  <label for="pic_eks" class="form-label">PIC Ekspedisi</label>
                  <input type="text" name="pic_eks" id="pic_eks" class="form-control" placeholder="Masukkan nama PIC ekspedisi" autocomplete="off" oninput="this.value = this.value.toUpperCase()">
                </div>
                <div class="col-md-6">
                  <label for="telpon" class="form-label">Nomor Telepon</label>
                  <input type="text" name="telpon" id="telpon" maxlength="13" class="form-control" placeholder="Masukkan nomor telepon ekspedisi" autocomplete="off">
                </div>
                <div class="col-md-12">
                  <label for="alamat" class="form-label">Alamat Ekspedisi</label>
                  <input type="text" name="alamat" id="alamat" class="form-control" placeholder="Masukkan alamat ekspedisi" autocomplete="off" oninput="this.value = this.value.toUpperCase()">
                </div>
                <div style="text-align: right">
                <button type="button" onclick="konfirmasiSimpan()" class="btn btn-primary col-md-1"><i class="bi bi-plus"></i> Tambah</button>
                </div>
                
                </form>
            </div>  
            </div>
        </div>
        <!-- Modal Edit -->
        <div class="modal fade" id="modalEdit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="modalEditLabel">Form ubah ekspedisi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form id="formUbah" method="post">
                @csrf
                <input type="hidden" id="id_edit">
              <div class="modal-body">
                <div class="form-group mb-3">
                    <label for="ekspedisi" class="form-label">Nama Ekspedisi</label>
                    <input type="text" name="ekspedisi" id="ekspedisi_edit" class="form-control" placeholder="Masukkan nama ekspedisi" autocomplete="off" oninput="this.value = this.value.toUpperCase()">
                  </div>
                  <div class="form-group mb-3">
                    <label for="pic_eks" class="form-label">PIC Ekspedisi</label>
                    <input type="text" name="pic_eks" id="pic_eks_edit" class="form-control" placeholder="Masukkan nama PIC ekspedisi" autocomplete="off" oninput="this.value = this.value.toUpperCase()">
                  </div>
                  <div class="form-group mb-3">
                    <label for="telpon" class="form-label">Nomor Telepon</label>
                    <input type="text" name="telpon" id="telpon_edit" maxlength="13" class="form-control" placeholder="Masukkan nomor telepon ekspedisi" autocomplete="off">
                  </div>
                  <div class="form-group mb-3">
                    <label for="alamat" class="form-label">Alamat Ekspedisi</label>
                    <input type="text" name="alamat" id="alamat_edit" class="form-control" placeholder="Masukkan alamat ekspedisi" autocomplete="off" oninput="this.value = this.value.toUpperCase()">
                  </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" id="btnUbah" class="btn btn-primary">Ubah</button>
              </div>
              </form>
            </div>
          </div>
        </div>
        <div class="card">
            <div class="card-body">
              <h5 class="card-title">Daftar Ekspedisi</h5>
              
              <!-- Daftar Perusahaan -->
              <table class="table table-hover" id="tabel_ekspedisi">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama Ekspedisi</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">PIC Ekspedisi</th>
                    <th scope="col">Nomor Telepon</th>
                    <th scope="col">Edit</th>
                  </tr>
                </thead>
                <tbody id="tbody">
                  @php $no = 1; @endphp
                  @forelse($ekspedisi as $row)
                  <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $row->ekspedisi }}</td>
                    <td>{{ $row->alamat }}</td>
                    <td>{{ $row->pic_eks }}</td>
                    <td>{{ $row->telpon }}</td>
                    <td><button type="button" class="btn btn-warning btn-sm btnEdit"
                        data-id="{{ $row->id }}"
                        data-ekspedisi="{{ $row->ekspedisi }}"
                        data-pic_eks="{{ $row->pic_eks }}"
                        data-telpon="{{ $row->telpon }}"
                        data-alamat="{{ $row->alamat }}">                        
                        <i class="bi bi-pencil-square"></i></button>
                        <button type="button" class="btn btn-danger btn-sm btnHapus" onclick="konfirmasiHapus({{ $row->id }})"><i class="bi bi-trash"></i></button>
                    </td>
                  </tr>
                  @empty
                  <tr>
                    <td align="center" colspan="6">Tidak ada data</td>
                  </tr>
                  @endforelse 
                </tbody>
              </table>
              <!-- End Daftar Ekspedisi -->

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

      $('#btnUbah').on('click', function() {
          var id = $('#id_edit').val();
          var ekspedisi = $('#ekspedisi_edit').val();
          var pic_eks = $('#pic_eks_edit').val();
          var telpon = $('#telpon_edit').val();
          var alamat = $('#alamat_edit').val();

          if(ekspedisi == '' || pic_eks == '' || alamat == '' || telpon == '')
          {
            return alert('Data masih kosong, silahkan isi data dengan benar');
          } else {
            Swal.fire({
              icon: "question",
              title: "Konfirmasi",
              text: "Apakah anda yakin ingin mengubah data?",
              showCancelButton: true,
              confirmButtonText: "Ubah",
              cancelButtonText: "Batal"
            }).then((result) => {
              if(result.value) {
                $.ajax({
                  url: "{{ url('ekspedisi/update') }}/"+id+"",
                  type: "POST",
                  data: {
                    id: id,
                    ekspedisi: ekspedisi,
                    pic_eks: pic_eks,
                    alamat: alamat,
                    telpon: telpon,
                    _token: '{{ csrf_token() }}'
                  },
                  success: function(response) {
                    // alert(response);
                    var tabel = $('#tabel_ekspedisi');
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

                $('#modalEdit').modal('hide');
              }
            })
          }
      });
  });

  function konfirmasiSimpan()
  {
    event.preventDefault();
    var form = event.target.form;
    var ekspedisi = $('#ekspedisi').val();
    var pic_eks = $('#pic_eks').val();
    var alamat = $('#alamat').val();
    var telpon = $('#telpon').val();
    if(ekspedisi == '' || pic_eks == '' || alamat == '' || telpon == '')
    {
      Swal.fire({
        icon: 'warning',
        title: 'Warning',
        text: 'Pastikan semua data terisi'
      });
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
              url: "{{ url('ekspedisi/save') }}",
              type: "POST",
              data: {
                ekspedisi: ekspedisi,
                pic_eks: pic_eks,
                alamat: alamat,
                telpon: telpon,
                _token: '{{ csrf_token() }}'
              },
              success: function(response) {
                // alert(response);
                var tabel = $('#tabel_ekspedisi');
                // Refresh tabel
                  $('#tbody').load(document.URL + ' #tbody tr', function() {
                      editButton();
                      deleteButton();
                  });

                  // reset data tambah ekspedisi
                  $('#ekspedisi').val('');
                  $('#pic_eks').val('');
                  $('#alamat').val('');
                  $('#telpon').val('');

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
              url: "{{ url('ekspedisi/delete') }}/"+id+"",
              type: "GET",
              data: {
                id: id,
                _token: '{{ csrf_token() }}'
              },
              success: function(response) {
                // alert(response);
                var tabel = $('#tabel_ekspedisi');
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

  async function modalEdit(id, ekspedisi, pic_eks, telpon, alamat)
  {
    const { value: formValues } = await Swal.fire({
      title: 'Multiple inputs',
      html:
        '<input id="swal-input1" class="swal2-input">' +
        '<input id="swal-input2" class="swal2-input">',
      focusConfirm: false,
      preConfirm: () => {
        return [
          document.getElementById('swal-input1').value,
          document.getElementById('swal-input2').value
        ]
      },
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
            var tabel = $('#tabel_ekspedisi');
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
          var ekspedisi = $(this).data('ekspedisi');
          var pic_eks = $(this).data('pic_eks');
          var telpon = $(this).data('telpon');
          var alamat = $(this).data('alamat');
          // modalEdit(id, ekspedisi, pic_eks, telpon, alamat);
          $('#modalEdit').modal('show');

          $('#id_edit').val(id);
          $('#ekspedisi_edit').val(ekspedisi);
          $('#pic_eks_edit').val(pic_eks);
          $('#telpon_edit').val(telpon);
          $('#alamat_edit').val(alamat);
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