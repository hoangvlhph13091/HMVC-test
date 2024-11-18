<div class="d-flex flex-column flex-shrink-0 p-3 bg-light" style="width: 280px; position: absolute; bottom: 0; top: 0">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
        <svg class="bi me-2" width="40" height="32">
            <use xlink:href="#bootstrap"></use>
        </svg>
        <span class="fs-4">Sidebar</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="{{ route('dashboard') }}"
                class="nav-link {{ request()->is('dashboard*') ? 'active' : 'link-dark' }}">
                <svg class="bi me-2" width="16" height="16">
                    <use xlink:href="#home"></use>
                </svg>
                Trang Chủ
            </a>
        </li>
        <li>
            <a href="{{ route('category') }}"
                class="nav-link {{ request()->is('category*') ? 'active' : 'link-dark' }}">
                <svg class="bi me-2" width="16" height="16">
                    <use xlink:href="#speedometer2"></use>
                </svg>
                Quản Lý Phân Loại Sách
            </a>
        </li>
        <li>
            <a href="{{ route('book') }}" class="nav-link {{ request()->is('book*') ? 'active' : 'link-dark' }}">
                <svg class="bi me-2" width="16" height="16">
                    <use xlink:href="#table"></use>
                </svg>
                Quản Lý Sách
            </a>
        </li>
        <li>
            <a href="{{ route('customer') }}"
                class="nav-link {{ request()->is('customer*') ? 'active' : 'link-dark' }}">
                <svg class="bi me-2" width="16" height="16">
                    <use xlink:href="#grid"></use>
                </svg>
                Quản Lý Bạn Đọc
            </a>
        </li>
        <li>
            <a href="{{ route('borrowhistory') }}"
                class="nav-link {{ request()->is('borrowhistory*') ? 'active' : 'link-dark' }}">
                <svg class="bi me-2" width="16" height="16">
                    <use xlink:href="#people-circle"></use>
                </svg>
                Quản Lý Lịch Sử Mượn Sách
            </a>
        </li>
        <li>
            <a href="{{ route('area') }}" class="nav-link {{ request()->is('area*') ? 'active' : 'link-dark' }}">
                <svg class="bi me-2" width="16" height="16">
                    <use xlink:href="#people-circle"></use>
                </svg>
                Quản Lý Khu Vực Sách
            </a>
        </li>
        <li>
            <a href="{{ route('user') }}" class="nav-link {{ request()->is('user*') ? 'active' : 'link-dark' }}">
                <svg class="bi me-2" width="16" height="16">
                    <use xlink:href="#people-circle"></use>
                </svg>
                Quản Lý Thành Viên
            </a>
        </li>
        <hr>
        <li>
            <a href="{{ route('logout') }}"
                class="nav-link {{ request()->is('logout*') ? 'active' : 'link-dark' }}">
                <svg class="bi me-2" width="16" height="16">
                    <use xlink:href="#people-circle"></use>
                </svg>
                Đăng Xuất
            </a>
        </li>
    </ul>
</div>
