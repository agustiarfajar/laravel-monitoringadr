@extends('admin.master')
@section('dashboard', 'collapsed')
@section('master', 'collapsed')
@section('submaster', 'collapse')
@section('barangHO', 'collapsed')
@section('laporan', 'collapsed')
@section('content')
    <div class="pagetitle">
        <h1>Status Pengiriman</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/admin-dashboard">Dashboard</a></li>
                <li class="breadcrumb-item active">Status Pengiriman</li>
            </ol>
        </nav>
    </div>


    <div class="col-12">
        <div class="card recent-sales overflow-auto">
            <div class=""></div>
            <div class="card-body">
                <div style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
                    <h5 class="card-title">Pengiriman</h5>
                    <div style="text-align: left">
                        <!-- <a type="button" href="/tambah-pengiriman" class="btn btn-primary"><i class="bi bi-plus"></i> Tambah</a> -->
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Tambah
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ url('tambah-pengiriman') }}">Pengiriman HO</a></li>
                                <li><a class="dropdown-item" href="{{ url('tambah-pengiriman-site') }}">Pengiriman
                                        Pemasok</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-3">
                        <select name="filter_pengiriman" id="filter_pengiriman" class="form-select">
                            <option value="" hidden>Filter Pengiriman</option>
                            <?php
              if(isset($_GET['pengiriman'])) {
                ?>
                            <option value="all" <?= $_GET['pengiriman'] == 'all' ? 'selected' : '' ?>>Pengiriman
                                Keseluruhan</option>
                            <option value="ho" <?= $_GET['pengiriman'] == 'ho' ? 'selected' : '' ?>>Pengiriman dari HO
                            </option>
                            <option value="pemasok" <?= $_GET['pengiriman'] == 'pemasok' ? 'selected' : '' ?>>Pengiriman ke
                                Pemasok</option>
                            <?php
              } else {
                ?>
                            <option value="all">Pengiriman Keseluruhan</option>
                            <option value="ho">Pengiriman dari HO</option>
                            <option value="pemasok">Pengiriman ke Pemasok</option>
                            <?php
              }
              ?>
                        </select>
                    </div>

                    <div class="col-3">
                        <select name="filter_status" id="filter_status" class="form-select">
                            <option value="" hidden>Filter Status</option>
                            <?php
              if(isset($_GET['status'])) {
                ?>
                            <option value="all" <?= $_GET['status'] == 'all' ? 'selected' : '' ?>>Semua</option>
                            <option value="diproses" <?= $_GET['status'] == 'diproses' ? 'selected' : '' ?>>Diproses</option>
                            <option value="dikirim" <?= $_GET['status'] == 'dikirim' ? 'selected' : '' ?>>Dikirim</option>
                            <option value="diterima" <?= $_GET['status'] == 'diterima' ? 'selected' : '' ?>>Diterima
                            <option value="dibatalkan" <?= $_GET['status'] == 'dibatalkan' ? 'selected' : '' ?>>Dibatalkan</option>
                            <?php
              } else {
                ?>
                            <option value="all">Semua</option>
                            <option value="diproses">Diproses</option>
                            <option value="dikirim">Dikirim</option>
                            <option value="diterima">Diterima</option>
                            <option value="dibatalkan">Dibatalkan</option>
                            <?php
              }

              ?>
                        </select>
                    </div>
                </div>
                <br>
                <table class="table table-borderless datatable" id="myTable">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">No Surat Jalan</th>
                            <th scope="col">Perusahaan</th>
                            <th scope="col">Ekspedisi</th>
                            <th scope="col">Tgl Surat Jalan</th>
                            <th scope="col">Tgl Pemasok Kirim</th>
                            <th scope="col">Tgl Diterima Site</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($result as $row)
                            <tr>
                                <th scope="row">{{ $no++ }}</th>
                                <td>{{ $row->no_faktur }}</td>
                                <td><span class="tooltip-perusahaan"
                                        data-perusahaan="{{ $row->perusahaan }}">{{ substr($row->perusahaan, 0, 10) }}...</span>
                                </td>
                                <td>{{ $row->ekspedisi }}</td>
                                <td>{{ date('m/d/Y', strtotime($row->tgl_surat_jalan)) }}</td>
                                <td>
                                    @if (substr($row->no_faktur, 0, 2) == 'SP')
                                        <input type="date" data-id="{{ $row->id }}"
                                            class="form-control tanggal_dikirim_sitexxx"
                                            onchange="konfirmasiTglKirimSite({{ $row->id }}, $(this).val())"
                                            value="{{ $row->tgl_kirim_pemasok }}"
                                            {{ $row->status == 'dikirim' || $row->status == 'diterima' || $row->status == 'dibatalkan' ? 'readonly' : '' }} min="{{ date('Y-m-d') }}">
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    @if (substr($row->no_faktur, 0, 2) == 'SJ')
                                        <input type="date" data-id="{{ $row->id }}"
                                            class="form-control tanggal_diterima_hoxx"
                                            onchange="konfirmasiTglHO({{ $row->id }}, $(this).val())"
                                            value="{{ $row->tgl_diterima_site }}"
                                            {{ $row->status == 'diterima' || $row->status == 'dibatalkan' ? 'readonly' : '' }} min="{{ date('Y-m-d') }}">
                                    @elseif(substr($row->no_faktur, 0, 2) == 'SP')
                                        <input type="date" data-id="{{ $row->id }}"
                                            class="form-control tanggal_diterima_sitexxx"
                                            onchange="konfirmasiTglSite({{ $row->id }}, $(this).val())"
                                            value="{{ $row->tgl_diterima_site }}"
                                            {{ $row->status == 'diterima' || $row->status == 'diproses' || $row->status == 'dibatalkan' ? 'readonly' : '' }} min="{{ date('Y-m-d') }}">
                                    @endif
                                </td>
                                <td>
                                    @if ($row->status == 'diproses')
                                        <span class="badge rounded-pill bg-primary">Diproses</span>
                                    @elseif($row->status == 'dikirim')
                                        <span class="badge rounded-pill bg-warning">Dikirim</span>
                                    @elseif($row->status == 'diterima')
                                        <span class="badge rounded-pill bg-success">Diterima</span>
                                    @elseif($row->status == 'dibatalkan')
                                        <span class="badge rounded-pill bg-danger">Dibatalkan</span>
                                    @endif
                                </td>
                                <td>
                                    @if (substr($row->no_faktur, 0, 2) == 'SJ')
                                        <a href="{{ url('detail/pengiriman-ho/' . $row->id) }}"
                                            class="btn btn-primary btn-sm"><i class="bi bi-eye"></i></a>
                                        <button
                                            class="btn btn-warning btn-sm printButtonHo {{ $row->status == 'dibatalkan' ? 'disabled' : '' }}"
                                            onclick="printHo({{ $row->id }})" data-id="{{ $row->id }}"><i
                                                class="bi bi-printer"></i></button>
                                        <button type="button" data-id="{{ $row->id }}"
                                            data-nosurat="{{ $row->no_faktur }}"
                                            class="btn btn-danger btn-sm btnBatalHo {{ $row->status == 'diproses' ? '' : 'disabled' }}"><i
                                                class="bi bi-x-lg"></i></button>
                                    @elseif(substr($row->no_faktur, 0, 2) == 'SP')
                                        <a href="{{ url('detail/pengiriman-site/' . $row->id) }}"
                                            class="btn btn-primary btn-sm"><i class="bi bi-eye"></i></a>
                                        <button
                                            class="btn btn-warning btn-sm printButton {{ $row->status == 'dibatalkan' ? 'disabled' : '' }}"
                                            onclick="printPemasok({{ $row->id }})" data-id="{{ $row->id }}"><i
                                                class="bi bi-printer"></i></button>
                                        <button type="button" data-id="{{ $row->id }}"
                                            data-nosurat="{{ $row->no_faktur }}"
                                            class="btn btn-danger btn-sm btnBatalSite {{ $row->status == 'diproses' ? '' : 'disabled' }}"><i
                                                class="bi bi-x-lg"></i></button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <a href="{{ url('/admin-dashboard') }}"><i class="bi bi-arrow-left">Kembali</i></a>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });

            @if (session()->has('success'))
                Toast.fire({
                    icon: 'success',
                    title: '{{ Session::get('success') }}'
                })
            @elseif (session()->has('error'))
                Toast.fire({
                    icon: 'error',
                    title: '{{ Session::get('error') }}'
                })
            @endif

            $('.tooltip-perusahaan').each(function() {
                $(this).tooltip({
                    title: $(this).data('perusahaan'),
                    placement: 'top' // Adjust the placement as needed (top, bottom, left, right)
                });
            })

            // Update HO tanggal diterima
            $('.tanggal_diterima_ho').each(function() {
                $(this).on('change', function() {
                    const id = $(this).data('id');
                    const tgl = $(this).val();
                    konfirmasiTglHO(id, tgl);
                })
            })

            // Update site tanggal dikirim
            $('.tanggal_dikirim_site').each(function() {
                $(this).on('change', function() {
                    const id = $(this).data('id');
                    const tgl = $(this).val();
                    konfirmasiTglKirimSite(id, tgl);
                })
            })

            // Update site tanggal diterima
            $('.tanggal_diterima_site').each(function() {
                $(this).on('change', function() {
                    const id = $(this).data('id');
                    const tgl = $(this).val();
                    konfirmasiTglSite(id, tgl);
                })
            })

            // Update batal ho
            $('.btnBatalHo').each(function() {
                $(this).on('click', function() {
                    const id = $(this).data('id');
                    const no_surat = $(this).data('nosurat');
                    konfirmasiBatalHO(id, no_surat);
                })
            })

            // Update batal pemasok
            $('.btnBatalSite').each(function() {
                $(this).on('click', function() {
                    const id = $(this).data('id');
                    const no_surat = $(this).data('nosurat');
                    konfirmasiBatalPemasok(id, no_surat);
                })
            })
        });

        function printPemasok(id) {
            window.location.href = "{{ url('print') }}/" + id + "";
        }

        function printHo(id) {
            window.location.href = "{{ url('printho') }}/" + id + "";
        }

        function inputTglDiterimaHO() {
            // Update HO tanggal diterima
            $('.tanggal_diterima_ho').each(function() {
                $(this).attr('min', new Date().toISOString().split('T')[0]);
                $(this).on('change', function() {
                    const id = $(this).data('id');
                    const tgl = $(this).val();
                    konfirmasiTglHO(id, tgl);
                })
            })
        }

        function inputTglDikirimSite() {
            // Update HO tanggal diterima
            $('.tanggal_dikirim_site').each(function() {
                $(this).attr('min', new Date().toISOString().split('T')[0]);
                $(this).on('change', function() {
                    const id = $(this).data('id');
                    const tgl = $(this).val();
                    konfirmasiTglKirimSite(id, tgl);
                })
            })
        }

        function inputTglDiterimaSite() {
            // Update HO tanggal diterima
            $('.tanggal_diterima_site').each(function() {
                $(this).attr('min', new Date().toISOString().split('T')[0]);
                $(this).on('change', function() {
                    const id = $(this).data('id');
                    const tgl = $(this).val();
                    konfirmasiTglSite(id, tgl);
                })
            })
        }

        function statusBatalHo() {
            $('.btnBatalHo').each(function() {
                $(this).on('click', function() {
                    const id = $(this).data('id');
                    const no_surat = $(this).data('nosurat');
                    konfirmasiBatalHO(id, no_surat);
                })
            })
        }

        function statusBatalPemasok() {
            $('.btnBatalSite').each(function() {
                $(this).on('click', function() {
                    const id = $(this).data('id');
                    const no_surat = $(this).data('nosurat');
                    konfirmasiBatalPemasok(id, no_surat);
                })
            })
        }
        // Sweetalert
        function konfirmasiTglHO(id, tgl) {
            event.preventDefault();
            var form = event.target.form;
            Swal.fire({
                icon: "question",
                title: "Konfirmasi",
                text: "Apakah anda yakin ingin menyimpan data?",
                showCancelButton: true,
                confirmButtonText: "Simpan",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "{{ url('update-status-ho/terima') }}/" + id + "",
                        type: "POST",
                        data: {
                            tgl_diterima: tgl,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            // alert(response);
                            // Refresh tabel
                            $('#myTable tbody').load(document.URL + ' #myTable tbody tr', function() {
                                inputTglDikirimSite();
                                inputTglDiterimaHO();
                                inputTglDiterimaSite();
                                statusBatalHo();
                                statusBatalPemasok();
                            });

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
                    Swal.fire("Informasi", "Data batal disimpan", "error");
                }
            });
        }

        function konfirmasiTglKirimSite(id, tgl) {
            event.preventDefault();
            var form = event.target.form;
            Swal.fire({
                icon: "question",
                title: "Konfirmasi",
                text: "Apakah anda yakin ingin menyimpan data?",
                showCancelButton: true,
                confirmButtonText: "Simpan",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "{{ url('update-status/kirim') }}/" + id + "",
                        type: "POST",
                        data: {
                            tgl_kirim_pemasok: tgl,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            // alert(response);
                            // Refresh tabel
                            $('#myTable tbody').load(document.URL + ' #myTable tbody tr', function() {
                                inputTglDikirimSite();
                                inputTglDiterimaHO();
                                inputTglDiterimaSite();
                                statusBatalHo();
                                statusBatalPemasok();
                            });

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
                    Swal.fire("Informasi", "Data batal disimpan", "error");
                }
            });
        }

        function konfirmasiTglSite(id, tgl) {
            event.preventDefault();
            var form = event.target.form;
            Swal.fire({
                icon: "question",
                title: "Konfirmasi",
                text: "Apakah anda yakin ingin menyimpan data?",
                showCancelButton: true,
                confirmButtonText: "Simpan",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "{{ url('update-status/terima') }}/" + id + "",
                        type: "POST",
                        data: {
                            tgl_diterima_site: tgl,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            // alert(response);
                            // Refresh tabel
                            $('#myTable tbody').load(document.URL + ' #myTable tbody tr', function() {
                                inputTglDikirimSite();
                                inputTglDiterimaHO();
                                inputTglDiterimaSite();
                                statusBatalHo();
                                statusBatalPemasok();
                            });

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
                    Swal.fire("Informasi", "Data batal disimpan", "error");
                }
            });
        }

        function konfirmasiBatalHO(id, no_surat) {
            event.preventDefault();
            var form = event.target.form;
            Swal.fire({
                icon: "question",
                title: "Konfirmasi",
                text: "Apakah anda yakin ingin membatalkan pengiriman?",
                showCancelButton: true,
                confirmButtonText: "Simpan",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "{{ url('update-status-ho/batal') }}/" + id + "",
                        type: "POST",
                        data: {
                            id: id,
                            no_faktur: no_surat,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            // alert(response);
                            // Refresh tabel
                            $('#myTable tbody').load(document.URL + ' #myTable tbody tr', function() {
                                inputTglDikirimSite();
                                inputTglDiterimaHO();
                                inputTglDiterimaSite();
                                statusBatalHo();
                                statusBatalPemasok();
                            });

                            var Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000
                            });

                            Toast.fire({
                                icon: 'success',
                                title: 'Data berhasil dibatalkan'
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
                    Swal.fire("Informasi", "Data gagal dibatalkan", "error");
                }
            });
        }

        function konfirmasiBatalPemasok(id, no_surat) {
            event.preventDefault();
            var form = event.target.form;
            Swal.fire({
                icon: "question",
                title: "Konfirmasi",
                text: "Apakah anda yakin ingin membatalkan pengiriman?",
                showCancelButton: true,
                confirmButtonText: "Simpan",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "{{ url('update-status/batal') }}/" + id + "",
                        type: "POST",
                        data: {
                            id: id,
                            no_faktur: no_surat,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            // alert(response);
                            // Refresh tabel
                            $('#myTable tbody').load(document.URL + ' #myTable tbody tr', function() {
                                inputTglDikirimSite();
                                inputTglDiterimaHO();
                                inputTglDiterimaSite();
                                statusBatalHo();
                                statusBatalPemasok();
                            });

                            var Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000
                            });

                            Toast.fire({
                                icon: 'success',
                                title: 'Data berhasil dibatalkan'
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
                    Swal.fire("Informasi", "Data gagal dibatalkan", "error");
                }
            });
        }

        function updateStatus(status, tanggalDiterimaId, statusSupplierId, statusBarangId) {
            const tanggalDiterima = document.getElementById(tanggalDiterimaId);
            const today = new Date().toISOString().slice(0, 10);
            tanggalDiterima.value = today;
            tanggalDiterima.readOnly = true;
            const button = tanggalDiterima.closest('tr').querySelector('button.btn-primary');
            button.disabled = true;
            button.innerText = status;
            button.classList.remove('btn-primary');
            button.classList.add('btn-success');

            const statusSupplierElement = document.getElementById(statusSupplierId);
            statusSupplierElement.innerText = status;
            statusSupplierElement.classList.remove('text-primary');
            statusSupplierElement.classList.add('text-success');

            const statusBarangElement = document.getElementById(statusBarangId);
            if (statusBarangElement.innerText !== 'Diterima') {
                statusBarangElement.innerText = status;
                statusBarangElement.classList.remove('text-primary');
                statusBarangElement.classList.add('text-success');
            }
        }

        // Filtering
        $(document).ready(function() {
            // Pasang handler peristiwa perubahan pada kedua dropdown filter
            $(document).ready(function() {
                $('#filter_pengiriman, #filter_status').on('change', function() {
                    applyFilters();
                });
            });

            // Fungsi untuk menerapkan filter dan mengarahkan
            function applyFilters() {
                var pengiriman = $('#filter_pengiriman').val();
                var status = $('#filter_status').val();
                var url = "{{ url('adminstatus') }}";

                if (pengiriman !== "" && status !== "") {
                    url += "?pengiriman=" + pengiriman + "&status=" + status;
                } else if (pengiriman !== "") {
                    url += "?pengiriman=" + pengiriman;
                } else if (status !== "") {
                    url += "?status=" + status;
                }

                // Arahkan pengguna ke URL yang sudah dibuat
                window.location.href = url;
            }

        });
    </script>
@endsection
