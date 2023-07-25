@extends('admin.master')

@section('sidebar')
@endsection

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

        <div class="card">
            <div class="card-body">
              <h5 class="card-title">Multi Columns Form</h5>

              <nav class="d-flex justify-content-center">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                  <li class="breadcrumb-item"><a href="#">Library</a></li>
                  <li class="breadcrumb-item active">Centered Position</li>
                </ol>
              </nav>

              <!-- Multi Columns Form -->
              <form id="form-submit" class="row g-3" action="{{ route('form.submit') }}" method="POST">
                    @csrf
                    <div class="col-md-6">
                        <label for="exampleDataList" class="form-label">Nama Perusahaan</label>
                        <input type="text" class="form-control" list="datalistOptions" id="exampleDataList" placeholder="Perusahaan tujuan">
                        <datalist id="datalistOptions">
                          <option value="PT INDONESIA FIBREBOARD INDUSTRY">
                          <option value="PT WAHANA LESTARI MAKMUR SUKSES">
                          <option value="PT KASIH AGRO MANDIRI 1">
                          <option value="PT KASIH AGRO MANDIRI PKS">
                          <option value="PT BAYUNG AGRO SAWITA">
                          <option value="PT MUSI AGRO SEJAHTERA">
                          <option value="PT AGRONUSA BUMI LESTARI (MJE)">
                        </datalist>
                    </div>
                    <div class="col-md-6">
                      <label for="inputPIC5" class="form-label">Person In Charge</label>
                      <input type="text" class="form-control" list="dataOptions" id="inputPIC5" placeholder="Nama penerima">
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
                      <label for="inputExp" class="form-label">Ekspedisi</label>
                      <select id="inputExp" class="form-select">
                        <option selected>Pilih</option>
                        <option>...</option>
                      </select>
                    </div>

                    <div class="text-center">
                      <a href="/tambah-pengiriman" type="button" class="btn btn-primary">Next</a>
                      <button type="reset" class="btn btn-secondary" onclick="resetTable()">Reset</button>

                    </div>

                </form>

                
            </div>
        </div>

    <script>
        function resetTable() {
            document.getElementById('form-submit').reset();
            var tableBody = document.getElementById('table-body');
            tableBody.innerHTML = '';
        }
    </script>
      

@endsection