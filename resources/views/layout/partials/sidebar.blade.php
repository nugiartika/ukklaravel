<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo ">
        <a href="index.html" class="app-brand-link">
            <span class="app-brand-logo demo">
                <svg width="32" height="22" viewBox="0 0 32 22" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M0.00172773 0V6.85398C0.00172773 6.85398 -0.133178 9.01207 1.98092 10.8388L13.6912 21.9964L19.7809 21.9181L18.8042 9.88248L16.4951 7.17289L9.23799 0H0.00172773Z"
                        fill="#7367F0" />
                    <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd"
                        d="M7.69824 16.4364L12.5199 3.23696L16.5541 7.25596L7.69824 16.4364Z"
                        fill="#161616" />
                    <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd"
                        d="M8.07751 15.9175L13.9419 4.63989L16.5849 7.28475L8.07751 15.9175Z"
                        fill="#161616" />
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M7.77295 16.3566L23.6563 0H32V6.88383C32 6.88383 31.8262 9.17836 30.6591 10.4057L19.7824 22H13.6938L7.77295 16.3566Z"
                        fill="#7367F0" />
                </svg>
            </span>
            <span class="app-brand-text demo menu-text fw-bold">Vuexy</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="ti menu-toggle-icon d-none d-xl-block align-middle"></i>
            <i class="ti ti-x d-block d-xl-none ti-md align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>



    <ul class="menu-inner py-1">
        @php
            $role = Auth::user()->role;
        @endphp

        @if($role === 'Admin')
        <li class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <a href="{{ route('admin.dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-smart-home"></i>
                <div data-i18n="Beranda">Beranda</div>
            </a>
        </li>
        <li class="menu-item {{ request()->routeIs('admin.category.*') ? 'active' : '' }}">
            <a href="{{ route('admin.category.index') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-category"></i>
                <div data-i18n="Kategori">Kategori</div>
            </a>
        </li>
        <li class="menu-item {{ request()->routeIs('admin.product.*') ? 'active' : '' }}">
            <a href="{{ route('admin.product.index') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-devices-2"></i>
                <div data-i18n="Produk">Produk</div>
            </a>
        </li>
        <li class="menu-item {{ request()->routeIs('admin.supplier.*') ? 'active' : '' }}">
            <a href="{{ route('admin.supplier.index') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-truck"></i>
                <div data-i18n="Supplier">Supplier</div>
            </a>
        </li>
        <li class="menu-item {{ request()->routeIs('admin.purchases.*') ? 'active' : '' }}">
            <a href="{{ route('admin.purchases.index') }}" class="menu-link">
                <i class="menu-icon ti ti-shopping-bag-check"></i>
                <div data-i18n="Pembelian">Pembelian</div>
            </a>
        </li>
        @elseif ($role === 'Kasir')
        <li class="menu-item {{ request()->routeIs('kasir.dashboard') ? 'active' : '' }}">
            <a href="{{ route('kasir.dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-smart-home"></i>
                <div data-i18n="Beranda">Beranda</div>
            </a>
        </li>
        <li class="menu-item {{ request()->routeIs('kasir.product') ? 'active' : '' }}">
            <a href="{{ route('kasir.product') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-devices-2"></i>
                <div data-i18n="Produk">Produk</div>
            </a>
        </li>
        <li class="menu-item {{ request()->routeIs('kasir.index') ? 'active' : '' }}">
            <a href="{{ route('kasir.index') }}" class="menu-link">
                <i class="menu-icon ti ti-shopping-bag-check"></i>
                <div data-i18n="Penjualan">Penjualan</div>
            </a>
        </li>
        <li class="menu-item {{ request()->routeIs('member.index') ? 'active' : '' }}">
            <a href="{{ route('member.index') }}" class="menu-link">
                <i class="menu-icon ti ti-users"></i>
                <div data-i18n="Member">Member</div>
            </a>
        </li>
        @elseif ($role === 'Member')
        <li class="menu-item {{ request()->routeIs('member.member.product') ? 'active' : '' }}">
            <a href="{{ route('member.member.product') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-devices-2"></i>
                <div data-i18n="Produk">Produk</div>
            </a>
        </li>
        <li class="menu-item {{ request()->routeIs('member.member.history') ? 'active' : '' }}">
            <a href="{{ route('member.member.history') }}" class="menu-link">
                <i class="menu-icon ti ti-history"></i>
                <div data-i18n="Riwayat">Riwayat</div>
            </a>
        </li>
        @elseif ($role === 'Pimpinan')
        <li class="menu-item {{ request()->routeIs('pimpinan.product') ? 'active' : '' }}">
            <a href="{{ route('pimpinan.product') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-devices-2"></i>
                <div data-i18n="Produk">Produk</div>
            </a>
        </li>
        <li class="menu-item {{ request()->routeIs('pimpinan.laporan') ? 'active' : '' }}">
            <a href="{{ route('pimpinan.laporan') }}" class="menu-link">
                <i class="menu-icon ti ti-shopping-bag-check"></i>
                <div data-i18n="Data Penjualan">Data Penjualan</div>
            </a>
        </li>
        @endif
    </ul>
</aside>
