<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="/" class="app-brand-link gap-2">
            <img src="/img/logo.png" alt="">
        </a>
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>
    <ul class="menu-inner py-1">
        <li class="menu-header small text-uppercase ">
            <span class="menu-header-text">Profile</span>
        </li>
        <li
            class="menu-item {{ Request::path() == 'dashboard/client/account' || Request::path() == 'dashboard/client/security' ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings">Account Settings</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ Request::path() == 'dashboard/client/account' ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}" class="menu-link">
                        <div data-i18n="Account">Account</div>
                    </a>
                </li>

            </ul>
        </li>
        <li
            class="menu-item {{ Request::path() == 'dashboard/client/orders' || Str::startsWith(Route::currentRouteName(), 'dashboard-client-order-update') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-package"></i>
                <div data-i18n="Orders">Orders</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ Request::path() == 'dashboard/client/orders' ? 'active' : '' }}">
                    <a href="{{ route('client-orders-show') }}" class="menu-link">
                        <div data-i18n="My Orders">My Orders</div>
                    </a>
                </li>
                <li
                    class="menu-item {{ Str::startsWith(Route::currentRouteName(), 'dashboard-client-order-update') ? 'active' : '' }}">
                    <a class="menu-link">
                        <div data-i18n="Order Details">Order Details</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item mt-5">
            <a href="/logout" class="menu-link">
                <i class="menu-icon tf-icons bx bx-log-out"></i>
                <div data-i18n="Tables">Logout</div>
            </a>
        </li>
    </ul>
</aside>
