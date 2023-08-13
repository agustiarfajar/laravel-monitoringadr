@extends('admin.master')

@section('dashboard', 'collapsed')
@section('master', 'collapsed')
@section('submaster', 'collapse')
@section('pengiriman', 'collapsed')
@section('laporan', 'collapsed')

@section('content')
    <div class="pagetitle">
      <h1>Edit Barang Diterima di HO</h1>
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
              <h5 class="card-title">Edit Barang Diterima di HO</h5>

              <!-- Multi Columns Form -->
              <form id="formEdit" class="row g-3" action="{{ url('update-item', $barang->id) }}" method="POST">
                @csrf
                <div class="col-md-6">
                  <label for="user" class="form-label">Diminta Oleh</label>
                  <input type="text" name="user" class="form-control" id="user" placeholder="Nama pemesan" value="{{ $barang->user }}" required>
                </div>

                <div class="col-md-6">
                  <label for="perusahaan" class="form-label">Perusahaan Tujuan</label>
                  <select name="id_perusahaan" id="perusahaan" class="select-perusahaan form-select" required>
                    <option value="">Pilih Perusahaan Tujuan</option>
                    @foreach($perusahaan as $row)
                    <option value="{{ $row->id }}" {{ ($row->id == $barang->id_perusahaan) ? 'selected' : '' }}>{{ $row->perusahaan }}</option>
                    @endforeach
                  </select>
                </div>


                <div class="col-md-12">
                  <label for="pemasok" class="form-label">Pemasok</label>
                  <input type="text" class="form-control" name="pemasok" id="pemasok" placeholder="Nama Supplier" value="{{ $barang->pemasok }}" required>
                </div>

                <div class="col-md-8">
                  <label for="item" class="form-label">Nama Barang</label>
                  <input type="text" class="form-control" id="item" name="item" placeholder="Nama Item"  value="{{ $barang->item }}" required>
                </div>
                <div class="col-md-2">
                  <label for="jumlah" class="form-label">Jumlah</label>
                  <input type="number" class="form-control" min="1" id="jumlah" name="jumlah" placeholder="Qty" value="{{ $barang->jumlah }}" required>
                </div>

                <div class="col-md-2">
                  <label for="unit" class="form-label">Unit</label>
                  <select id="unit" class="form-select" name="unit">
                    <option hidden>Pilih Satuan Unit</option>
                    <option {{($barang->unit == 'UNIT') ? 'selected' : ''}}>UNIT</option>
                    <option {{($barang->unit == 'PCS') ? 'selected' : ''}}>PCS</option>
                    <option {{($barang->unit == 'SET') ? 'selected' : ''}}>SET</option>
                    <option {{($barang->unit == 'BOX') ? 'selected' : ''}}>BOX</option>
                    <option {{($barang->unit == 'SHT') ? 'selected' : ''}}>SHT</option>
                    <option {{($barang->unit == 'LTR') ? 'selected' : ''}}>LTR</option>
                    <option {{($barang->unit == 'ROLL') ? 'selected' : ''}}>ROLL</option>
                    <option {{($barang->unit == 'PACK') ? 'selected' : ''}}>PACK</option>
                    <option {{($barang->unit == 'BTG') ? 'selected' : ''}}>BTG</option>
                    <option {{($barang->unit == 'MTR') ? 'selected' : ''}}>MTR</option>
                    <option {{($barang->unit == 'BTL') ? 'selected' : ''}}>BTL</option>
                  </select>
                </div>

                <div class="col-md-6">
                  <label for="nomor_po" class="form-label">Nomor PO/PR</label>
                  <input type="text" class="form-control" name="nomor_po" id="nomor_po" placeholder="Nomor PO/PR" value="{{ $barang->nomor_po }}" required>
                </div>

                <div class="col-md-6">
                  <label for="tgl_kedatangan" class="form-label">Tanggal Kedatangan (HO)</label>
                  <input type="date" class="form-control transparent-date" id="tgl_kedatangan" value="{{ $barang->tgl_kedatangan }}" name="tgl_kedatangan">
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

      if(user == '' || perusahaan == '' || pemasok == '' || item == '' || jumlah == '' || unit == '' || no_po == '')
      {
        alert('Pastikan data terisi');
      } else if(jumlah <= 0){
        alert('Isikan jumlah dengan minimal 1');
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
                form.submit();
            } else {
                Swal.fire("Informasi","Data batal diubah","error");
            }
        });
      }
  }
</script>
@endsection
