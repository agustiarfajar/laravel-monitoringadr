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

              <!-- Multi Columns Form -->
              <form class="row g-3" action="" method="POST">
                
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

                <div class="col-md-6">
                  <label for="inputUser5" class="form-label">User Purchase</label>
                  <input type="text" class="form-control" id="inputUser5" placeholder="Nama pemesan">
                </div>
                <div class="col-md-6">
                  <label for="inputSup5" class="form-label">Pemasok</label>
                  <input type="text" class="form-control" id="inputSup5">
                </div>
                <div class="col-md-8">
                  <label for="inputItem5" class="form-label">Item Barang</label>
                  <input type="text" class="form-control" id="inputItem5">
                </div>
                <div class="col-md-2">
                  <label for="inputJumlah5" class="form-label">Jumlah</label>
                  <input type="number" class="form-control" id="inputJumlah5">
                </div>
                <div class="col-md-2">
                  <label for="inputUnit5" class="form-label">Unit</label>
                  <select id="inputUnit5" class="form-select">
                    <option selected>...</option>
                    <option>unit</option>
                    <option>pcs</option>
                    <option>set</option>
                    <option>box</option>
                    <option>sht</option>
                    <option>ltr</option>
                    <option>roll</option>
                    <option>pack</option>
                  </select>
                </div>
                <div class="col-md-12">
                  <label for="inputPO5" class="form-label">Nomor PO/PR</label>
                  <input type="text" class="form-control" id="inputPO5">
                </div>
            
                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
              </form><!-- End Multi Columns Form -->                
            </div>
            
        </div>
            
@endsection