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
    <a class="nav-link " href="/daftar-barang">
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
    <div class="pagetitle">
      <h1>Tambah Barang Diterima di HO</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/admin-dashboard">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="/daftar-barang">Barang Diterima di HO</a></li>
          <li class="breadcrumb-item active">Tambah Barang Diterima di HO</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

        <div class="card">
            <div class="card-body">
              <h5 class="card-title">Tambah Barang Diterima di HO</h5>

              <!-- Multi Columns Form -->
              <form class="row g-3" action="{{ url('simpan-item') }}" method="POST">
                @csrf
                <div class="col-md-6">
                  <label for="user" class="form-label">Diminta Oleh</label>
                  <input type="text" name="user" class="form-control" id="user" placeholder="Nama pemesan" required autocomplete="off" oninput="this.value = this.value.toUpperCase()">
                </div>

                <div class="col-md-6">
                  <label for="perusahaan" class="form-label">Perusahaan Tujuan</label>
                  <select name="id_perusahaan" id="perusahaan" class="select-perusahaan form-select" required>
                    <option value="">Pilih Perusahaan Tujuan</option>
                    @foreach($perusahaan as $row)
                    <option value="{{ $row->id }}">{{ $row->perusahaan }}</option>
                    @endforeach
                  </select>
                </div>

                
                <div class="col-md-12">
                  <label for="pemasok" class="form-label">Pemasok</label>
                  <input type="text" class="form-control" name="pemasok" id="pemasok" placeholder="Nama Pemasok" required autocomplete="off" oninput="this.value = this.value.toUpperCase()">
                </div>

                <div class="col-md-8">
                  <label for="item" class="form-label">Nama Barang</label>
                  <input type="text" class="form-control" id="item" name="item" placeholder="Nama Barang" required autocomplete="off" oninput="this.value = this.value.toUpperCase()">
                </div>
                <div class="col-md-2">
                  <label for="jumlah" class="form-label">Jumlah</label>
                  <input type="number" class="form-control" min="1" id="jumlah" name="jumlah" placeholder="Qty" required autocomplete="off">
                </div>

                <div class="col-md-2">
                  <label for="unit" class="form-label">Unit</label>
                  <select id="unit" class="form-select" name="unit">
                    <option hidden>Pilih Satuan Unit</option>
                    <option>UNIT</option>
                    <option>PCS</option>
                    <option>SET</option>
                    <option>BOX</option>
                    <option>SHT</option>
                    <option>LTR</option>
                    <option>ROLL</option>
                    <option>PACK</option>
                    <option>BTG</option>
                    <option>MTR</option>
                    <option>BTL</option>
                    <option>KG</option>
                  </select>
                </div>

                <div class="col-md-6">
                  <label for="nomor_po" class="form-label">Nomor PO/PR</label>
                  <input type="text" class="form-control" name="nomor_po" id="nomor_po" placeholder="Nomor PO/PR" required autocomplete="off" oninput="this.value = this.value.toUpperCase()">
                </div>

                <div class="col-md-6">
                  <label for="tgl_kedatangan" class="form-label">Tanggal Kedatangan (HO)</label>
                  <input type="date" class="form-control transparent-date" id="tgl_kedatangan" name="tgl_kedatangan" autocomplete="off">
                </div>

                <div class="text-left">
                  <button type="button" class="btn btn-primary" onclick="konfirmasiSimpan()">Submit</button>
                  <button type="reset" id="btnReset" class="btn btn-secondary">Reset</button>
                </div>
              </form><!-- End Multi Columns Form -->                
            </div>
            </div>
            </div>
        </div>
        <a href="{{ url('/daftar-barang') }}"><i class="bi bi-arrow-left">Kembali</i></a>
<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script>
  $(document).ready(function(){
    $('.select-perusahaan').select2({
      theme: 'bootstrap-5'
    });

    // reset perusahaan
    $('#btnReset').click(function() {
      $(".select-perusahaan").val('').trigger('change');
    })
      
  })
  function dateNow()
  {
    const today = new Date();
    const yyyy = today.getFullYear();
    let mm = today.getMonth() + 1; // Months start at 0!
    let dd = today.getDate();

    if (dd < 10) dd = '0' + dd;
    if (mm < 10) mm = '0' + mm;

    const formattedToday = yyyy + '-' + mm + '-' + dd;

    return formattedToday;
  }
  // Sweetalert
  function konfirmasiSimpan()
  {
      event.preventDefault();
      var form = event.target.form;
      var user = $('#user').val();
      var perusahaan = $('#perusahaan').val();
      var pemasok = $('#pemasok').val();
      var item = $('#item').val();
      var jumlah = $('#jumlah').val();
      var unit = $('#unit').val();
      var no_po = $('#nomor_po').val();
      var tgl_kedatangan = $('#tgl_kedatangan').val();
      console.log(dateNow());

      if(user == '' || perusahaan == '' || pemasok == '' || item == '' || jumlah == '' || unit == '' || no_po == '' || tgl_kedatangan == '')
      {
        Swal.fire({
          icon: 'warning',
          title: 'Warning',
          text: 'Pastikan semua data terisi'
        });
      } else if(jumlah <= 0){
        Swal.fire({
            icon: 'warning',
            title: 'Warning',
            text: 'Isikan jumlah dengan minimal 1'
          });
      } else if(tgl_kedatangan > dateNow()) {
        Swal.fire({
            icon: 'warning',
            title: 'Warning',
            text: 'Isikan tanggal dengan benar'
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
                form.submit();
            } else {
                Swal.fire("Informasi","Data batal disimpan","error");
            }
        });
      } 
  }
</script>           
@endsection