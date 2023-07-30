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
    <a class="nav-link " href="{{ url('adminstatus') }}">
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
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Detail Surat Pengiriman</h5>
                
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-3 col-md-4"><b>Nomor Surat Jalan </b></div>
                    <div class="col-lg-9 col-md-8"> {{ $barang->no_faktur }}</div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-4"><b>Nama Perusahaan </b></div>
                    <div class="col-lg-9 col-md-8"> {{ $barang->perusahaan }}</div>
                </div>

                <div class="row">
                    <div class="col-lg-3 col-md-4"><b>PIC Perusahaan</b></div>
                    <div class="col-lg-9 col-md-8">{{ $barang->pic }}</div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-4"><b>Pemasok </b></div>
                    <div class="col-lg-9 col-md-8">{{ $barang->pemasok }}</div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-4"><b>Ekspedisi </b></div>
                    <div class="col-lg-9 col-md-8">{{ $barang->ekspedisi }}</div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-4"><b>Tanggal Surat Keluar </b></div>
                    <div class="col-lg-9 col-md-8">{{ $barang->tgl_surat_jalan }}</div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-4"><b>Tanggal Pemasok Kirim </b></div>
                    <div class="col-lg-9 col-md-8">{{ $barang->tgl_kirim_pemasok }}</div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-4"><b>Tanggal Diterima Site </b></div>
                    <div class="col-lg-9 col-md-8">{{ $barang->tgl_diterima_site }}</div>
                </div>
            </div>
            
            <div class="">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Diminta Oleh</th>
                            <th>Nama Barang</th>
                            <th>Jumlah</th>
                            <th>Unit</th>
                            <th>Nomor PO/PR</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($barang_detail as $row)
                        <tr>
                            <td>{{ $row->user }}</td>
                            <td>{{ $row->item }}</td>
                            <td>{{ $row->jumlah }}</td>
                            <td>{{ $row->unit }}</td>
                            <td>{{ $row->nomor_po }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6">Tidak ada data</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <a href="{{url('/adminstatus')}}"><i class="bi bi-arrow-left">Kembali</i></a>
@endsection