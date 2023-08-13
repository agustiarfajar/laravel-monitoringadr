<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link @yield('dashboard')" href="{{ url('admin-dashboard') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link @yield('master')" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide-fill"></i><span>Master</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="tables-nav" class="nav-content @yield('submaster')" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ url('perusahaan') }}" class="@yield('perusahaan')">
                        <i class="bi bi-circle-fill"></i><span>Perusahaan</span>
                    </a>
                </li>

                <li>
                    <a href="{{ url('ekspedisi') }}" class="@yield('ekspedisi')">
                        <i class="bi bi-circle-fill"></i><span>Ekspedisi</span>
                    </a>
                </li>

                <li>
                    <a href="{{ url('/user-access') }}" class="@yield('user')">
                        <i class="bi bi-circle-fill"></i><span>User</span>
                    </a>
                </li>

                <li>
                    <a href="{{ url('/role-access') }}" class="@yield('role')">
                        <i class="bi bi-circle-fill"></i><span>Role</span>
                    </a>
                </li>

            </ul>
        </li><!-- End Tables Nav -->

        <li class="nav-heading">Menu</li>

        <li class="nav-item">
            <a class="nav-link @yield('barangHO')" href="/daftar-barang">
                <i class="bi bi-box-seam"></i><span>Barang Diterima di HO</span>
            </a>

        </li><!-- End Ekspedisi Nav -->

        <li class="nav-item">
            <a class="nav-link @yield('pengiriman')" href="{{ url('adminstatus') }}">
                <i class="bi bi-ui-checks"></i><span>Pengiriman</span>
            </a>
        </li>





        <li class="nav-item">
            <a class="nav-link @yield('laporan')" href="/laporan">
                <i class="bi bi-file-earmark-bar-graph"></i><span>Laporan</span>
            </a>

        </li><!-- End Ekspedisi Nav -->

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
