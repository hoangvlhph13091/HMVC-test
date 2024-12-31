  <!-- Sidebar user panel (optional) -->
  <div class="user-panel mt-3 pb-3 mb-3 d-flex">
    <div class="image">
        {{-- <img src="{{ asset('assets/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image"> --}}
    </div>
    <div class="info">
        <a href="#" class="d-block">{{ Auth::user()->name; }}</a>
    </div>
</div>

<!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
        data-accordion="false">
        <li class="nav-item">
            <a href="{{ route('dashboard') }}"
                class="nav-link {{ request()->is('dashboard*') ? 'active' : 'link-dark' }}">
                <i class="nav-icon fas fa-th"></i>
                <p>
                    Trang Chủ
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('category') }}"
                class="nav-link {{ request()->is('category*') ? 'active' : 'link-dark' }}">
                <i class="nav-icon fas fa-tag"></i>
                <p>
                    Quản Lý Phân Loại Sách
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('book') }}"
                class="nav-link {{ request()->is('book*') ? 'active' : 'link-dark' }}">
                <i class="nav-icon fas fa-book"></i>
                <p>
                    Quản Lý Sách
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('customer') }}"
                class="nav-link {{ request()->is('customer*') ? 'active' : 'link-dark' }}">
                <i class="nav-icon fas fa-glasses"></i>
                <p>
                    Quản Lý Bạn Đọc
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('borrowhistory') }}"
                class="nav-link {{ request()->is('borrowhistory*') ? 'active' : 'link-dark' }}">
                <i class="nav-icon fas fa-book"></i>
                <p>
                    Quản Lý Lịch Sử Mượn Sách
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('area') }}"
                class="nav-link {{ request()->is('area*') ? 'active' : 'link-dark' }}">
                <i class="nav-icon fas fa-book"></i>
                <p>
                    Quản Lý Khu Vực Sách
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('user') }}"
                class="nav-link {{ request()->is('user*') ? 'active' : 'link-dark' }}">
                <i class="nav-icon fas fa-user"></i>
                <p>
                    Quản Lý Thành Viên
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('setting') }}"
                class="nav-link {{ request()->is('setting*') ? 'active' : 'link-dark' }}">
                <i class="nav-icon fas fa-hammer"></i>
                <p>
                    Cài Đặt Hệ Thống
                </p>
            </a>
        </li>
    </ul>
</nav>
<!-- /.sidebar-menu -->
