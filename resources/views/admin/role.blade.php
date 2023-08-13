@extends('admin.master')
@section('dashboard', 'collapsed')
@section('role', 'active')
@section('barangHO', 'collapsed')
@section('pengiriman', 'collapsed')
@section('laporan', 'collapsed')
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

            <form id="tambahForm" class="hidden-form row g-3" action="{{ url('saveRole') }}" method="POST">
                <!-- Elemen-elemen form Anda -->
                @csrf

                <div class="col-md-6">
                    <label for="role" class="form-label">Role</label>
                    <input type="text" name="name" id="role" class="form-control" placeholder="Masukkan role"
                        autocomplete="off">
                </div>

                <div class="col-md-6">
                    <label for="role" class="form-label">Hak Akses</label>
                    @php
                        $master = ['perusahaan', 'ekspedisi', 'user', 'role'];
                    @endphp
                    @foreach ($permission as $item)
                        @if (in_array($item->name, $master))
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" value="{{ $item->id }}"
                                    name="permission[]" role="switch" id="flexSwitchCheckDefault">
                                <label class="form-check-label" for="flexSwitchCheckDefault">Master
                                    {{ $item->name }}</label>
                            </div>
                        @else
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" value="{{ $item->id }}"
                                    name="permission[]" role="switch" id="flexSwitchCheckDefault">
                                <label class="form-check-label" for="flexSwitchCheckDefault">{{ $item->name }}</label>
                            </div>
                        @endif
                    @endforeach
                </div>



                <div class="text-right">
                    <button type="submit" class="btn btn-primary" id="btnSubmit">Submit</button>
                </div>

            </form>

        </div>
    </div>

    {{-- <!-- Modal Edit >  --}}
    <div class="modal fade" id="modalEdit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="modalEditLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditLabel">Form Role</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="ubahForm" class="row g-3" method="POST">
                        <!-- Elemen-elemen form Anda -->
                        @csrf
                        <div class="form-group">
                            <label for="role" class="form-label">Role</label>
                            <input type="text" name="name" id="roleEdit" class="form-control"
                                placeholder="Masukkan role" autocomplete="off">
                        </div>
                        <div class="form-group formHakAkses">
                            <label for="role" class="form-label">Hak Akses</label>
                            @php
                                $master = ['perusahaan', 'ekspedisi', 'user', 'role'];
                            @endphp
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary" id="btnSubmit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal Hapus --}}
    <div class="modal fade" id="modalHapus" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="modalHapusLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalHapusLabel">Hapus Role</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="modal-body">
                        <div class="deleteModalMessage">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Daftar Role</h5>

            <!-- Daftar User -->
            <table class="datatable" id="tabel_ekspedisi">
                <thead>
                    <tr>
                        <th scope="col" style="width: 3%">#</th>
                        <th scope="col">Role {{ \Auth::user()->role }}</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody id="tbody">
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($role as $item)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $item->name }}</td>
                            <td>
                                <button type="button" class="btn btn-warning btn-sm btnEdit"
                                    data-id="{{ $item->id }}" data-role="{{ $item->name }}"><i
                                        class="bi bi-pencil-square"></i></button>
                                @if (auth()->check() &&
                                        auth()->user()->hasRole($item->name))
                                    <button type="button" class="btn btn-danger btn-sm btnHapus"
                                        data-id="{{ $item->id }}" disabled><i class="bi bi-trash"></i></button>
                                @else
                                    <button type="button" class="btn btn-danger btn-sm btnHapus"
                                        data-id="{{ $item->id }}"><i class="bi bi-trash"></i></button>
                                @endif
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
            <!-- End Daftar Role -->
        </div>
    </div>
    <a href="{{ url('/admin-dashboard') }}"><i class="bi bi-arrow-left">Kembali</i></a>

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

            $('.btnEdit').on('click', function() {
                var id = $(this).data('id');
                var role = $(this).data('role');

                $('#roleEdit').val(role);
                $('#ubahForm').attr('action', 'updateRole/' + id)
                $('#modalEdit').modal('show');

                $.ajax({
                    url: '/getRole/json/' +
                        id, // Ganti dengan URL rute yang sesuai di aplikasi Anda
                    type: 'GET',
                    success: function(data) {

                        var formHakAkses = $('.formHakAkses');

                        formHakAkses.empty(); // Hapus elemen-elemen sebelumnya jika ada

                        $.each(data.allpermission, function(index, permission) {
                            var isChecked = data.permission.hasOwnProperty(permission
                                .id) ? 'checked' : '';

                            var checkbox = `
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" value="${permission.id}" name="permission[]" role="switch"
                            id="flexSwitchCheckDefault${permission.id}" ${isChecked}>
                        <label class="form-check-label" for="flexSwitchCheckDefault${permission.id}">
                            ${permission.name}
                        </label>
                    </div>
                `;

                            formHakAkses.append(checkbox);
                        });


                    },
                    error: function(error) {
                        console.error(error);
                    }
                });
            })
            $('.btnHapus').on('click', function() {
                var id = $(this).data('id');

                // $('#roleEdit').val(role);
                // $('#ubahForm').attr('action', 'updateRole/' + id)
                $('#modalHapus').modal('show');

                $.ajax({
                    url: '/getCountUser/json/' + id,
                    type: 'GET',
                    success: function(data) {
                        var deleteModalMessage = $('.deleteModalMessage');
                        deleteModalMessage.empty();

                        var msgContainer = $('<div class="delete-modal-message text-center">');
                        var icon = $(
                            '<i class="bi bi-question-circle-fill text-warning" style="font-size: 3rem;"></i>'
                        );
                        var msgText =
                            `<p class="mb-3">Apakah Anda yakin akan menghapus role <strong>${data.role}</strong> dan <strong>${data.total_user}</strong> user?</p>`;
                        var msgButtons = `
            <div class="d-flex justify-content-center">

                <form action="/deleteRole/${id}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Ya</button>
                    <button type="button" class="btn btn-secondary mr-3" data-dismiss="modal">Batal</button>
                </form>
            </div>
        `;

                        msgContainer.append(icon);
                        msgContainer.append(msgText);
                        msgContainer.append(msgButtons);

                        deleteModalMessage.append(msgContainer);
                    },
                    error: function(error) {
                        console.error(error);
                    }
                });
            })
        });
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
