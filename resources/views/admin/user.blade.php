@extends('admin.master')
@section('dashboard', 'collapsed')
@section('user', 'active')
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
        <h1>Daftar User</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/admin-dashboard">Dashboard</a></li>
                <li class="breadcrumb-item active">Daftar User</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Tambah User</h5>
            {{-- <a type="button" id="tambahButton" class="btn btn-primary"><i id="icon" class="bi bi-plus"></i> Tambah</a> --}}

            <form id="tambahForm" action="{{ url('createUsers') }}" method="POST" class="row g-3">
                <!-- Elemen-elemen form Anda -->
                @csrf

                <div class="col-md-6">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" name="name" id="name"
                        class="form-control @error('name') is-invalid
                    @enderror"
                        placeholder="Masukkan Nama" autocomplete="off">
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" name="email" id="email"
                        class="form-control @error('email') is-invalid
                    @enderror"
                        placeholder="Masukkan Email" autocomplete="off">
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="pass" class="form-label">Password</label>
                    <input type="password" name="password" id="pass" class="form-control"
                        placeholder="Masukkan Password" autocomplete="off">
                    <div class="invalid-feedback">
                        Minimal 8 karakter, mengandung angka, dan huruf kecil.
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="confirm" class="form-label">Konfirmasi Password</label>
                    <input type="password" name="confirm" id="confirm" class="form-control" placeholder="Ulangi Password"
                        autocomplete="off">
                    <div class="invalid-feedback">
                        Konfirmasi password tidak sesuai dengan password.
                    </div>
                </div>

                <!-- ... elemen-elemen lainnya ... -->


                <div class="col-md-6">
                    <label for="role" class="form-label">Role</label>
                    <select name="role" id="role"
                        class="select-role form-select @error('role') is-invalid
                    @enderror" required>
                        <option value="">Pilih Role User</option>
                        @foreach ($roles as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                    @error('role')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="text-right">
                    <button type="button" class="btn btn-primary" id="btnSubmit">Tambah User</button>
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
                    <h5 class="modal-title" id="modalEditLabel">Form Edit Users</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="ubahForm" class="row g-3" method="POST">
                        <!-- Elemen-elemen form Anda -->
                        @csrf

                        <div class="form-group">
                            <label for="nameEdit" class="form-label">Nama</label>
                            <input type="text" name="name" id="nameEdit"
                                class="form-control @error('name') is-invalid
                    @enderror"
                                placeholder="Masukkan Nama" autocomplete="off">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="emailEdit" class="form-label">Email</label>
                            <input type="text" name="email" id="emailEdit"
                                class="form-control @error('email') is-invalid
                    @enderror"
                                placeholder="Masukkan Email" autocomplete="off">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="Edit" class="form-label">Password</label>
                            <input type="password" name="password" id="passEdit" class="form-control"
                                placeholder="Masukkan Password" autocomplete="off">
                            <div class="invalid-feedback">
                                Minimal 8 karakter, mengandung angka, dan huruf kecil.
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="confirmEdit" class="form-label">Konfirmasi Password</label>
                            <input type="password" name="confirm" id="confirmEdit" class="form-control"
                                placeholder="Ulangi Password" autocomplete="off">
                            <div class="invalid-feedback">
                                Konfirmasi password tidak sesuai dengan password.
                            </div>
                        </div>

                        <!-- ... elemen-elemen lainnya ... -->


                        <div class="form-group">
                            <label for="roleEdit" class="form-label">Role</label>
                            <select name="role" id="roleEdit"
                                class="select-role form-select @error('role') is-invalid
                    @enderror"
                                required>
                                <option value="">Pilih Role User</option>
                                @foreach ($roles as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('role')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="text-right">
                            <button type="button" class="btn btn-primary" id="btnSubmitEdit">Simpan</button>
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
                    <h5 class="modal-title" id="modalHapusLabel">Konfirmasi Hapus Users</h5>
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
            <h5 class="card-title">Daftar User</h5>

            <!-- Daftar Role -->
            <table class="datatable" id="tabel_ekspedisi">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Username</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody id="tbody">
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($users as $item)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>
                                @if (!empty($item->getRoleNames()))
                                    @foreach ($item->getRoleNames() as $role)
                                        {{ $role }}
                                    @endforeach
                                @endif
                            </td>
                            <td>
                                <button type="button" class="btn btn-warning btn-sm btnEdit"
                                    data-id="{{ $item->id }}"><i class="bi bi-pencil-square"></i></button>
                                @if (auth()->check() && auth()->user()->id == $item->id)
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
            $('#btnSubmit').on('click', function() {
                var password = $('#pass').val();
                var confirm = $('#confirm').val();
                var confirmInput = $('#confirm');
                var passwordInput = $('#pass');

                const passwordRegex = /^(?=.*\d)(?=.*[a-z]).{8,}$/;


                if (!password.match(passwordRegex)) {
                    passwordInput.addClass("is-invalid");
                    return;
                }
                if (password !== confirm) {
                    confirmInput.addClass('is-invalid');
                    return;
                }

                // Jika konfirmasi password sesuai, submit formulir
                $('#tambahForm').submit();
            });
            $('#btnSubmitEdit').on('click', function() {
                var password = $('#passEdit').val();
                var confirm = $('#confirmEdit').val();
                var confirmInput = $('#confirmEdit');
                var passwordInput = $('#passEdit');
                const passwordRegex = /^(?=.*\d)(?=.*[a-z]).{8,}$/;


                if (!password.match(passwordRegex)) {
                    passwordInput.addClass("is-invalid");
                    return;
                }
                if (password !== confirm) {
                    confirmInput.addClass('is-invalid');
                    return;
                }

                // Jika konfirmasi password sesuai, submit formulir
                $('#ubahForm').submit();
            });

            // Clear invalid state saat konfirmasi password diubah
            $('#confirm').on('input', function() {
                $(this).removeClass('is-invalid');
            });
            $('.btnEdit').on('click', function() {
                var id = $(this).data('id');

                $('#ubahForm').attr('action', 'updateUsers/' + id)
                $('#modalEdit').modal('show');

                $.ajax({
                    url: '/getUserDetailJson/' +
                        id, // Ganti dengan URL rute yang sesuai di aplikasi Anda
                    type: 'GET',
                    success: function(data) {

                        var nameEdit = $('#nameEdit');
                        var emailEdit = $('#emailEdit');
                        var roleEdit = $('#roleEdit');
                        var selectedRoleId = data.users.roles[0].id;
                        nameEdit.val(data.users.name)
                        emailEdit.val(data.users.email)
                        roleEdit.find('option').each(function() {
                            // Jika nilai value opsi sama dengan selectedRoleId, set elemen sebagai selected
                            if ($(this).val() == selectedRoleId) {
                                $(this).prop('selected', true);
                            }
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
                    url: '/getUserDetailJson/' + id,
                    type: 'GET',
                    success: function(data) {
                        var deleteModalMessage = $('.deleteModalMessage');
                        deleteModalMessage.empty();

                        var msgContainer = $('<div class="delete-modal-message text-center">');
                        var icon = $(
                            '<i class="bi bi-question-circle-fill text-warning" style="font-size: 3rem;"></i>'
                        );
                        var msgText =
                            `<p class="mb-3">Apakah Anda yakin akan menghapus user dengan username <strong>${data.users.name}</strong>?</p>`;
                        var msgButtons = `
            <div class="d-flex justify-content-center">

                <form action="/deleteUsers/${id}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Ya</button>
                    <button type="button" class="btn btn-secondary mr-3" data-bs-dismiss="modal" aria-label="Close">Batal</button>
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
    </script>
@endsection
