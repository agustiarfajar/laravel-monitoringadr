@extends('admin.master')
@section('dashboard', 'collapsed')
@section('master', 'collapsed')
@section('submaster', 'collapse')
@section('barangHO', 'collapsed')
@section('laporan', 'collapsed')

@section('content')
    <div class="pagetitle">
      <h1>Buat Surat Pengiriman</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/admin-dashboard">Dashboard</a></li>
          <li class="breadcrumb-item active"><a href="/adminstatus">Status Pengiriman</a></li>
          <li class="breadcrumb-item active">Buat Surat Pengiriman</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <form action="{{ url('simpan-pengiriman-ho') }}" method="POST">
      @csrf
        <div class="card">
            <div class="card-body">
              <h5 class="card-title">Informasi Pengiriman</h5>
              <div class="row g-3">
                <div class="col-md-6">
                  <label for="perusahaan" class="form-label">Nama Perusahaan Tujuan</label>
                  <select id="perusahaan" name="id_perusahaan" class="select-perusahaan form-select" onchange="getItem()">
                    <option hidden value="">Pilih Perusahaan Tujuan</option>
                    @foreach($perusahaan as $row)
                    <option value="{{ $row->id }}">{{ $row->perusahaan }}</option>
                    @endforeach
                  </select>
              </div>

              <div class="col-md-6">
                <label for="pic" class="form-label">PIC Perusahaan</label>
                <input type="text" class="form-control" list="dataOptions" id="pic" name="pic" placeholder="Nama Penerima" oninput="this.value = this.value.toUpperCase()">
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
              <div class="">
                <h5 class="card-title">Tambah Barang</h5>
              </div>
              <div style="text-align: left">
                <button type="button" id="btnTambah" class="btn btn-primary"><i class="bi bi-plus"></i> Tambah</button>
                <i class="">* menambahkan dari modul "Barang Diterima di HO"</i>
              </div>
        </div>
              </div>
              <!-- Multi Columns Form -->

        </div>

      <!-- Full Screen Modal -->

              <div class="modal fade" id="ExtralargeModal" tabindex="-1">
                <div class="modal-dialog modal-xl">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="card-title">Tambah Barang</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <!-- Table with stripped rows -->
                    <table class="table" id="table_item">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama Barang</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">Unit</th>
                            <th scope="col">No PO/PR</th>
                            <th scope="col">Pemasok</th>
                            <th scope="col">Tgl Kedatangan</th>
                            <th scope="col">Perusahaan Tujuan</th>
                            <th scope="col">Actions</th>
                            <th scope="col">Jumlah Kirim</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                    <!-- End Table with stripped rows -->
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary" id="btnSubmit"></i> Submit</button>
                    </div>
                  </div>
                </div>
              </div><!-- End Full Screen Modal-->

        <div class="card">
            <div class="card-body">
              <h5 class="card-title">Daftar Item</h5>
                <div class="">
                    <table class="table" id="table_delivery">
                        <thead>
                            <tr>
                                <th>Diminta Oleh</th>
                                <th>Pemasok</th>
                                <th>Nama Barang</th>
                                <th>Jumlah</th>
                                <th>Unit</th>
                                <th>Nomor PO/PR</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>

                <div style="text-align: right">

                    <!--button type="reset" class="btn btn-outline-danger" onclick="resetTable()">Reset</button-->
                    <button type="button" class="btn btn-primary" onclick="konfirmasiSimpan()">Submit</button>
                </div>
            </div>
        </div>
        <a href="{{url('/adminstatus')}}"><i class="bi bi-arrow-left">Kembali</i></a>
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

      var myObject = {};
      $(document).ready(function() {
        $('.select-perusahaan').select2({
          theme: 'bootstrap-5'
        });

        $('.select-ekspedisi').select2({
          theme: 'bootstrap-5'
        });

        $('#table_item').on('click', '.cek-barang', function() {
          var row = $(this).closest('tr'); // Get the closest table row
          var input = row.find('.jml_kirim'); // Find the input field in the row
          if ($(this).is(':checked')) {
            var id = $(this).data('id');
            input.prop('disabled', false); // Disable the input field
          } else {
            input.prop('disabled', true); // Enable the input field
          }
        });

        $('#btnTambah').on('click', function() {
            if($('#perusahaan').val() == '')
            {
              $('#ExtralargeModal').modal('hide');
              return Swal.fire({
                icon: 'warning',
                title: 'Warning',
                text: 'Pilih perusahaan tujuan'
              });
            }

            $('#ExtralargeModal').modal('show');
        })

        $('#btnSubmit').on('click', function() {
    $('.cek-barang').each(function() {
        if($(this).is(':checked')) {
            var row = $(this).closest('tr');
            var id_barang = row.find('#id_barang');
            var user = row.find('#user');
            var pemasok = row.find('#pemasok');
            var item = row.find('#item');
            var jumlah = row.find('.jml_kirim');
            var unit = row.find('#unit');
            var nomor_po = row.find('#nomor_po');
            var tgl_kedatangan = row.find('#tgl_kedatangan');
            var jumlahTersedia = parseFloat(jumlah.attr('max')); // Ambil nilai maksimum dari atribut max

            if(jumlah.val() == '') {
                return Swal.fire({
                    icon: 'warning',
                    title: 'Warning',
                    text: 'Isi jumlah barang yang akan dikirim'
                });
            } else if(jumlah.val() <= 0) {
                return Swal.fire({
                    icon: 'warning',
                    title: 'Warning',
                    text: 'Isikan jumlah dengan minimal 1'
                });
            } else if(parseFloat(jumlah.val()) > jumlahTersedia) {
                return Swal.fire({
                    icon: 'warning',
                    title: 'Warning',
                    text: 'Jumlah kirim melebihi jumlah yang tersedia'
                });
            } else {
                var items = {
                    id: id_barang.val(),
                    user: user.val(),
                    pemasok: pemasok.val(),
                    item: item.val(),
                    jumlah: jumlah.val(),
                    unit: unit.val(),
                    nomor_po: nomor_po.val(),
                    tgl_kedatangan: tgl_kedatangan.val()
                }


                var uniqueKey = Object.keys(myObject).length;
                myObject[uniqueKey] = items;
                console.log(myObject);
                var tbody_delivery = $('#table_delivery tbody');
                tbody_delivery.empty();

                for (var i = 0; i <= uniqueKey; i++)
                {
                  var row = '<tr id="data-index'+myObject[i].id+'">';
                  row += '<td><input type="hidden" name="id_barang[]" value="'+myObject[i].id+'"><input type="hidden" name="user[]" value="'+myObject[i].user+'">' + myObject[i].user + '</td>';
                  row += '<td><input type="hidden" name="pemasok[]" value="'+myObject[i].pemasok+'">' + myObject[i].pemasok + '</td>';
                  row += '<td><input type="hidden" name="item[]" value="'+myObject[i].item+'">' + myObject[i].item + '</td>';
                  row += '<td><input type="hidden" name="jumlah[]" value="'+myObject[i].jumlah+'">' + myObject[i].jumlah + '</td>';
                  row += '<td><input type="hidden" name="unit[]" value="'+myObject[i].unit+'">' + myObject[i].unit + '</td>';
                  row += '<td><input type="hidden" name="nomor_po[]" value="'+myObject[i].nomor_po+'"><input type="hidden" name="tgl_kedatangan[]" value="'+myObject[i].tgl_kedatangan+'">' + myObject[i].nomor_po + '</td>';
                  row += '<td><button type="button" class="btn btn-sm btn-danger btnHapusKeranjang" onclick="hapusBarang('+myObject[i].id+')"><i class="bi bi-trash"></i></button></td>';
                  row += '</tr>';
                  tbody_delivery.append(row);
                }
              }
                $('#ExtralargeModal').modal('hide');

              }
          });

          myObject = {};
        });
      })

      $('#pic').on('input', function() {
        var sanitizedInput = $(this).val().replace(/[^a-zA-Z\s]/g, ''); // Hapus karakter selain huruf dan spasi
        $(this).val(sanitizedInput);
    });

      function hapusBarang(id)
      {
          $('#data-index'+id).remove();
          delete myObject[id];
      }

      function getItem() {
        var perusahaan = $('#perusahaan').val();

        $.ajax({
              url: "{{ url('get-item') }}",
              type: 'POST',
              data: {
                  perusahaan: perusahaan,
                  _token: '{{ csrf_token() }}'
              },
              success: function(response) {
                  var tbody = $('#table_item tbody');
                  tbody.empty();

                  if(response.data.length == 0)
                  {
                    var row = '<tr>';
                    row += '<td align="center" colspan="10">Tidak ada data</td>';
                    row += '</tr>';
                    tbody.append(row);
                  }

                  for (var i = 0; i < response.data.length; i++) {
                      var row = '<tr>';
                      row += '<td><input type="hidden" id="id_barang" value="'+response.data[i].id+'"><input type="hidden" id="user" value="'+response.data[i].user+'">' + (i+1) + '</td>';
                      row += '<td><input type="hidden" id="item" value="'+response.data[i].item+'">' + response.data[i].item + '</td>';
                      row += '<td>' + response.data[i].jumlah + '</td>';
                      row += '<td><input type="hidden" id="unit" value="'+response.data[i].unit+'">' + response.data[i].unit + '</td>';
                      row += '<td><input type="hidden" id="nomor_po" value="'+response.data[i].nomor_po+'">' + response.data[i].nomor_po + '</td>';
                      row += '<td><input type="hidden" id="pemasok" value="'+response.data[i].pemasok+'">' + response.data[i].pemasok + '</td>';
                      row += '<td><input type="hidden" id="tgl_kedatangan" value="'+response.data[i].tgl_kedatangan+'">' + response.data[i].tgl_kedatangan + '</td>';
                      row += '<td>' + response.data[i].perusahaan + '</td>';
                      row += '<td><input type="checkbox" class="form-check cek-barang" data-id='+response.data[i].id+'></td>';
                      row += '<td><input type="number" min="1" max="'+response.data[i].jumlah+'" name="jumlah_kirim[]" class="form-control jml_kirim" style="width:100px" disabled></td>';
                      row += '</tr>';
                      tbody.append(row);
                  }
              },
              error: function(xhr) {
                  console.log(xhr.responseText);
              }
          });
      }

        // Mengambil semua elemen tombol delete
        var deleteButtons = document.querySelectorAll('.btn-danger');

        // Membuat event listener untuk setiap tombol delete
        deleteButtons.forEach(function(button) {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                var row = this.closest('tr'); // Mendapatkan elemen baris terdekat
                var id = this.getAttribute('data-id'); // Mendapatkan ID atau identifier dari atribut data-id
                deleteRow(row, id); // Memanggil fungsi deleteRow dengan memberikan elemen baris dan ID
            });
        });

        // Fungsi untuk menghapus baris dan melakukan tindakan lain yang diperlukan
        function deleteRow(row, id) {
            // Lakukan tindakan penghapusan data sesuai dengan kebutuhan Anda, seperti mengirim permintaan AJAX ke server untuk menghapus data dari database

            // Contoh tindakan penghapusan data:
            // Kirim permintaan AJAX ke server dengan menggunakan URL atau endpoint yang sesuai
            // Misalnya, menggunakan jQuery AJAX:
            // $.ajax({
            //     url: '/delete-data/' + id,
            //     type: 'DELETE',
            //     success: function(response) {
            //         // Sukses - hapus baris dari tabel
            //         row.remove();
            //         alert('Data berhasil dihapus');
            //     },
            //     error: function(xhr, status, error) {
            //         // Gagal - tampilkan pesan kesalahan
            //         alert('Terjadi kesalahan saat menghapus data');
            //         console.log(xhr.responseText);
            //     }
            // });

            // Contoh tindakan penghapusan data menggunakan JavaScript murni:
            row.remove();
            alert('Data berhasil dihapus');
        }

        // Sweetalert
      function konfirmasiSimpan()
      {
          event.preventDefault();
          var form = event.target.form;
          var perusahaan = $('#perusahaan').val();
          var pic = $('#pic').val();
          var id_ekspedisi = $('#ekspedisi').val();
          var jmlDetail = $('#table_delivery tbody tr').length;

        if(perusahaan == '' || pic == '' || id_ekspedisi == '' || jmlDetail < 1)
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
                  form.submit();
              } else {
                  Swal.fire("Informasi","Data batal disimpan","error");
              }
          });
        }
      }
    </script>
@endsection