<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        @can('dashboard')
            <li class="nav-item">
                <a class="nav-link @yield('dashboard')" href="{{ url('admin-dashboard') }}">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li><!-- End Dashboard Nav -->
        @endcan
        @if (auth()->check())
            @php
                $user = auth()->user();
                $permissions = $user->getAllPermissions();
                $listPermission = [];
            @endphp
            @foreach ($permissions as $permission)
                @php
                    array_push($listPermission, $permission->name);
                @endphp
            @endforeach
            @php
                $master = ['perusahaan', 'ekspedisi', 'user', 'role'];
                $menu = ['barangHO', 'pengiriman', 'laporan'];
                $countPermissionMaster = 0;
                $countPermissionMenu = 0;
            @endphp
            @foreach ($listPermission as $item)
                @if (in_array($item, $master))
                    @php
                        $countPermissionMaster = $countPermissionMaster + 1;
                    @endphp
                @endif
                @if (in_array($item, $menu))
                    @php
                        $countPermissionMenu = $countPermissionMenu + 1;
                    @endphp
                @endif
            @endforeach
        @endif
        @if ($countPermissionMaster != 0)
            <li class="nav-item">
                <a class="nav-link @yield('master')" data-bs-target="#tables-nav" data-bs-toggle="collapse"
                    href="#">
                    <i class="bi bi-menu-button-wide-fill"></i><span>Master</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="tables-nav" class="nav-content @yield('submaster')" data-bs-parent="#sidebar-nav">
                    @can('perusahaan')
                        <li>
                            <a href="{{ url('perusahaan') }}" class="@yield('perusahaan')">
                                <i class="bi bi-circle-fill"></i><span>Perusahaan</span>
                            </a>
                        </li>
                    @endcan
                    @can('ekspedisi')
                        <li>
                            <a href="{{ url('ekspedisi') }}" class="@yield('ekspedisi')">
                                <i class="bi bi-circle-fill"></i><span>Ekspedisi</span>
                            </a>
                        </li>
                    @endcan
                    @can('user')
                        <li>
                            <a href="{{ url('/user-access') }}" class="@yield('user')">
                                <i class="bi bi-circle-fill"></i><span>User</span>
                            </a>
                        </li>
                    @endcan
                    @can('role')
                        <li>
                            <a href="{{ url('/role-access') }}" class="@yield('role')">
                                <i class="bi bi-circle-fill"></i><span>Role</span>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li><!-- End Tables Nav -->
        @endif
        @if ($countPermissionMenu != 0)
            <li class="nav-heading">Menu</li>
        @endif
        @can('barangHO')
            <li class="nav-item">
                <a class="nav-link @yield('barangHO')" href="/daftar-barang">
                    <i class="bi bi-box-fill"></i><span>Barang Diterima di HO</span>
                </a>

            </li><!-- End Ekspedisi Nav -->
        @endcan
        @can('pengiriman')
            <li class="nav-item">
                <a class="nav-link @yield('pengiriman')" href="{{ url('adminstatus') }}">
                    <i class="bi bi-ui-checks"></i><span>Pengiriman</span>
                </a>
            </li>
        @endcan



        @can('laporan')
            <li class="nav-item">
                <a class="nav-link @yield('laporan')" href="/laporan">
                    <i class="bi bi-file-earmark-bar-graph"></i><span>Laporan</span>
                </a>

            </li><!-- End Ekspedisi Nav -->
        @endcan
        <li class="nav-heading">Pages</li>



        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-in-right"></i>
                <span>Logout</span>
            </a>
        </li>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>


    </ul>

</aside>
