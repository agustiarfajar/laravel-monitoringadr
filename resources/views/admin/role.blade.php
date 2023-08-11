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
        <a href="{{ url('ekspedisi') }}">
          <i class="bi bi-circle-fill"></i><span>Ekspedisi</span>
        </a>
      </li>
      <li>
        <a href="/user-access">
          <i class="bi bi-circle-fill"></i><span>User</span>
        </a>
      </li>
      <li>
        <a href="/role-access" class="active">
          <i class="bi bi-circle-fill"></i><span>Role</span>
        </a>
      </li>
    </ul>
  </li><!-- End Tables Nav -->

  <li class="nav-heading">Menu</li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="/daftar-barang">
      <i class="bi bi-box-seam"></i><span>Barang Diterima di HO</span>
    </a>
  
  </li><!-- End Ekspedisi Nav -->

  <li class="nav-item">
    <a class="nav-link collapsed" href="{{ url('adminstatus') }}">
      <i class="bi bi-ui-checks"></i><span>Pengiriman</span>
    </a>  
  </li>

  

  

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
<style>
    .hidden-form {
        display: none;
        opacity: 0;
        height: 0;
        overflow: hidden;
        transition: opacity 0.3s, height 0.3s;
    }
    
    .visible-form {
        display: block;
        opacity: 1;
        height: auto;
    }

    .btn-danger {
        background-color: #dc3545;
        color: white;
    }
</style>

    <div class="pagetitle">
      <h1>Daftar Role</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/admin-dashboard">Dashboard</a></li>
          <li class="breadcrumb-item active">Daftar Role</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Tambah Role</h5>
                <a type="button" id="tambahButton" class="btn btn-primary"><i id="icon" class="bi bi-plus"></i> Tambah</a>
                <br><br>

                <form id="tambahForm" class="hidden-form row g-3">
                    <!-- Elemen-elemen form Anda -->
                    @csrf
                    
                    <div class="col-md-6">
                      <label for="role" class="form-label">Role</label>
                      <input type="text" name="role" id="role" class="form-control" placeholder="Masukkan role" autocomplete="off">
                    </div>
                    
                    <div class="col-md-6">
                      <label for="role" class="form-label">Hak Akses</label>
                      <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                        <label class="form-check-label" for="flexSwitchCheckDefault">Master User Edit</label>
                      </div>
                      <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                        <label class="form-check-label" for="flexSwitchCheckDefault">Master User Delete</label>
                      </div>
                      <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                        <label class="form-check-label" for="flexSwitchCheckDefault">Master Role Edit</label>
                      </div>
                      <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                        <label class="form-check-label" for="flexSwitchCheckDefault">Master Role Delete</label>
                      </div>
                    </div>

                    

                    <div class="text-right">
                        <button type="button" class="btn btn-primary" id="btnSubmit">Submit</button>
                    </div>

                </form>
             
            </div>
        </div>
        
        <!-- Modal Edit >
        <div class="modal fade" id="modalEdit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="modalEditLabel">Form Edit User</h5>
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
        </div-->

        <div class="card">
            <div class="card-body">
              <h5 class="card-title">Daftar Role</h5>
              
              <!-- Daftar User -->
              <table class="datatable" id="tabel_ekspedisi">
                <thead>
                  <tr>
                    <th scope="col" style="width: 3%">#</th>
                    <th scope="col">Role</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody id="tbody">
                  <tr>
                    <td>1</td>
                    <td>User</td>
                    <td>
                        <button type="button" class="btn btn-warning btn-sm btnEdit"><i class="bi bi-pencil-square"></i></button>
                        <button type="button" class="btn btn-danger btn-sm btnHapus"><i class="bi bi-trash"></i></button>
                    </td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td>Admin</td>
                    <td>
                        <button type="button" class="btn btn-warning btn-sm btnEdit"><i class="bi bi-pencil-square"></i></button>
                        <button type="button" class="btn btn-danger btn-sm btnHapus"><i class="bi bi-trash"></i></button>
                    </td>
                  </tr>
                </tbody>
              </table>
              <!-- End Daftar Role -->

            </div>
        </div>
        <a href="{{ url('/admin-dashboard') }}"><i class="bi bi-arrow-left">Kembali</i></a>

<script>
    var tambahButton = document.getElementById("tambahButton");
    var tambahForm = document.getElementById("tambahForm");
    var icon = document.querySelector("#tambahButton i"); // Memilih elemen <i> dalam tombol

    tambahButton.addEventListener("click", function(event) {
        event.preventDefault();
        
        if (tambahForm.classList.contains("visible-form")) {
            tambahForm.classList.remove("visible-form");
            icon.classList.remove("bi-x");
            icon.classList.add("bi-plus");
            tambahButton.classList.remove("btn-danger");
            tambahButton.innerHTML = '<i class="bi bi-plus"></i> Tambah';
        } else {
            tambahForm.classList.add("visible-form");
            icon.classList.remove("bi-plus");
            icon.classList.add("bi-x");
            tambahButton.classList.add("btn-danger");
            tambahButton.innerHTML = '<i class="bi bi-x"></i> Batal';
        }
    });
</script>

@endsection