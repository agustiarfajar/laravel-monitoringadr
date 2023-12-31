@extends('admin.master')

@section('dashboard', 'collapsed')
@section('master', 'collapsed')
@section('submaster', 'collapse')
@section('barangHO', 'collapsed')
@section('laporan', 'collapsed')

@section('content')
    <div class="pagetitle">
      <h1>Tambah Pengiriman</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/admin-dashboard">Dashboard</a></li>
          <li class="breadcrumb-item active"><a href="/adminstatus">Status Pengiriman</a></li>
          <li class="breadcrumb-item active">Tambah Pengiriman</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <form action="{{ url('simpan-pengiriman-site') }}" method="POST" id="">
      @csrf
        <div class="card">
            <div class="card-body">
              <h5 class="card-title">Informasi Pengiriman</h5>

              <!-- Multi Columns Form -->
                  <div class="row g-3">
                    <!-- end of hidden input -->



                    <div class="col-md-6">
                      <label for="inputUnit5" class="form-label">Nama Perusahaan Tujuan</label>
                      <select id="inputUnit5" name="id_perusahaan" class="select-perusahaan form-select" required>
                        <option hidden>Pilih Perusahaan Tujuan</option>
                        @foreach($perusahaan as $row)
                        <option value="{{ $row->id }}">{{ $row->perusahaan }}</option>
                        @endforeach
                      </select>
                    </div>

                    <div class="col-md-6">
                      <label for="pic" class="form-label">PIC Perusahaan</label>
                      <input type="text" class="form-control" list="dataOptions" id="pic" name="pic" placeholder="Nama Penerima" required oninput="this.value = this.value.toUpperCase()">
                      <datalist id="dataOptions">
                          <option value="R. Basuki">
                          <option value="Wasis">
                          <option value="Rizki">
                          <option value="Ridwan">
                          <option value="Wulan">
                          <option value="Dian">
                          <option value="Desika">
                          <option value="Akbar">
                        </datalist>
                    </div>

                    <div class="col-md-6 ">
                      <label for="suplier" class="form-label">Pemasok</label>
                      <input type="text" class="form-control" id="pemasok" name="pemasok" placeholder="Nama Pemasok" required autocomplete="off" oninput="this.value = this.value.toUpperCase()">
                    </div>
                    <div class="col-md-6">
                      <label for="telp" class="form-label">No Telepon</label>
                      <input type="text" class="form-control" id="telp" name="telpon" maxlength="13" placeholder="Nomor Telepon Pemasok" required autocomplete="off" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                    </div>

                    <div class="col-md-12">
                      <!-- <label for="ekspedisi" class="form-label">Ekspedisi</label>
                      <input type="text" class="form-control" id="ekspedisi" name="ekspedisi" placeholder="Nama Ekspedisi" required> -->
                      <label for="ekspedisi" class="form-label">Ekspedisi</label>
                      <select id="ekspedisi" name="id_ekspedisi" class="select-ekspedisi form-select">
                        <option hidden value="">Pilih Ekspedisi</option>
                        @foreach($ekspedisi as $row)
                        <option value="{{ $row->id }}">{{ $row->ekspedisi }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
              </div>
          </div>




      <div class="card">
        <div class="card-body">
                <h5 class="card-title">Tambah Barang</h5>
                  <div class="row g-3">
                    <div class="col-md-12 ">
                      <label for="user" class="form-label">Diminta Oleh</label>
                      <input type="text" class="form-control" id="user" placeholder="Nama Pemesan" autocomplete="off" oninput="validateInput(this); this.value = this.value.toUpperCase();" >
                    </div>

                    <div class="col-md-8 ">
                      <label for="item" class="form-label">Nama Barang</label>
                      <input type="text" class="form-control" id="item" placeholder="Nama Barang" autocomplete="off" oninput="this.value = this.value.toUpperCase()">
                    </div>
                    <div class="col-md-2 ">
                      <label for="jumlah" class="form-label">Jumlah</label>
                      <input type="number" min="1" class="form-control" id="jumlah" placeholder="Qty" autocomplete="off">
                    </div>
                    <div class="col-md-2 ">
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
                    <div class="col-md-12 ">
                      <label for="nomor" class="form-label">Nomor PO/PR</label>
                      <input type="text" class="form-control" id="nomor" placeholder="Nomor PO/PR" autocomplete="off" oninput="this.value = this.value.toUpperCase()">
                    </div>
                    <div style="text-align: right">
                      <button type="button" id="btnTambah" class="btn btn-primary"><i class="bi bi-plus"></i> Tambah</button>
                    </div>
                  </div>
          </div>
        </div>

        <div class="card">
            <div class="card-body">
              <h5 class="card-title">Daftar Item</h5>
                <div class="">
                    <table class="table" id="table_detail">
                        <thead>
                            <tr>
                                <th>Diminta Oleh</th>
                                <!-- <th>Pemasok</th> -->
                                <th>Nama Barang</th>
                                <th>Jumlah</th>
                                <th>Unit</th>
                                <th>Nomor PO/PR</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="table-body">

                        </tbody>
                    </table>
                </div>

                <div style="text-align: right">
                    <!--button type="reset" class="btn btn-outline-danger" onclick="resetTable()">Reset</button-->
                    <button type="button" class="btn btn-primary" onclick="konfirmasiSimpan()">Submit</button>
                </div>
            </div>
        </div>
        <a href="/adminstatus"><i class="bi bi-arrow-left">Kembali</i></a>

      </form>
    <!--script>
        function resetTable() {
            document.getElementById('form-submit').reset();
            var tableBody = document.getElementById('table-body');
            tableBody.innerHTML = '';
        }
    </script-->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script>
      var no = 0;
      var totalJumlah = 0;
      var id_barang_db = new Array();

      $(document).ready(function() {
        $('.select-perusahaan').select2({
          theme: 'bootstrap-5'
        });

        $('#pic').on('input', function() {	
        var sanitizedInput = $(this).val().replace(/[^a-zA-Z\s]/g, ''); // Hapus karakter selain huruf dan spasi	
        $(this).val(sanitizedInput);	
        });	

        $('.select-ekspedisi').select2({
          theme: 'bootstrap-5'
        });

        $('#btnTambah').click(function() {
          var user = $('#user').val();
          var item = $('#item').val();
          var jumlah = $('#jumlah').val();
          var unit = $('#unit').val();
          var no_po = $('#nomor').val();

          if(user == '' || item == '' || jumlah == '' || unit == '' || no_po == '')
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
          } else if (unit == '' || !["UNIT", "PCS", "SET", "BOX", "SHT", "LTR", "ROLL", "PACK", "BTG", "MTR", "BTL", "KG"].includes(unit)) {
            Swal.fire({
                icon: 'warning',
                title: 'Warning',
                text: 'Pilih unit yang valid'
            });
          } else {
              jumlah = parseInt(jumlah);
              no = no+1;
              totalJumlah += jumlah;
              $('#table_detail tbody').append(
                  "<tr id='data-index"+no+"'><td><input type='hidden' name='id_barang[]' value='"+no+"'><input type='hidden' name='user[]' value='"+user+"' id='user"+no+"'><input type='hidden' name='item[]' value='"+item+"'' id='item"+no+"'><input type='hidden' name='jumlah[]' value='"+jumlah+"' id='jumlah"+no+"'><input type='hidden' name='unit[]' value='"+unit+"' id='unit"+no+"'><input type='hidden' name='nomor_po[]' value='"+no_po+"' id='nomor_po"+no+"'>"+user+"</td><td>"+item+"</td><td>"+jumlah+"</td><td>"+unit+"</td><td>"+no_po+"</td><td><button type='button' class='btn btn-sm btn-danger btnHapusKeranjang' onclick='hapusBarang("+no+")'><i class='bi bi-trash'></i></button></td></tr>"
              );

              // reset data tambah barang
              $('#user').val('');
              $('#item').val('');
              $('#jumlah').val('');
              $('#unit').val('');
              $('#nomor').val('');
          }
        })
      });

      function hapusBarang(id)
      {
          $('#data-index'+id).remove();
      }

      function validateInput(inputElement) {
        const inputValue = inputElement.value;
        const onlyLetters = /^[A-Za-z\s]+$/; // Regular expression for letters and spaces

        if (!onlyLetters.test(inputValue)) {
            inputElement.value = inputValue.replace(/[^A-Za-z\s]/g, ''); // Remove non-letter characters
        }
      }

      // Sweetalert
      function konfirmasiSimpan() {
    event.preventDefault();
    var form = event.target.form;
    // var id = $('name').val();
    var perusahaan = $('#perusahaan').val();
    var pic = $('#pic').val();
    var id_ekspedisi = $('#ekspedisi').val();
    var pemasok = $('#pemasok').val();
    var telp = $('#telpon').val();
    var id_barang_db = $('#id_barang').val();
    var user = $('#user').val();
    var item = $('#item').val();
    var jumlah = $('#jumlah').val();
    var unit = $('#unit').val();
    var no_po = $('#nomor').val();
    var jmlDetail = $('#table_detail tbody tr').length;

    if (perusahaan == '' || pic == '' || id_ekspedisi == '' || pemasok == '' || telp == '' || id_barang_db == '' || jmlDetail < 1) {
        Swal.fire({
            icon: 'warning',
            title: 'Warning',
            text: 'Pastikan data terisi'
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
            if (result.value) {
                form.submit();
            } else {
                Swal.fire("Informasi", "Data batal disimpan", "error");
            }
        });
    }
}

    </script>




@endsection
