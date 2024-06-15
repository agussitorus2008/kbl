<header id="header">
    <div class="container">
        <div class="header-row">
            <div class="header-column justify-content-start">
                <!-- Logo -->
                <div class="logo">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('img/logo.png') }}" alt="KBL" width="200">
                    </a>
                </div>
                <!-- Logo end -->

            </div>
            <div class="header-column justify-content-end">
                <nav class="primary-menu navbar navbar-expand-lg">
                    <div id="header-nav" class="collapse navbar-collapse">
                        <ul class="navbar-nav">
                            <li class="login-signup ml-lg-2"><a class="pl-lg-4 pr-0" href="/">Home</a></li>
                            <li class="login-signup ml-lg-2"><a class="pl-lg-4 pr-0"
                                    href="{{ route('schedule') }}">Jadwal</a></li>
                            <li class="login-signup ml-lg-2"><a class="pl-lg-4 pr-0"
                                    href="{{ route('about') }}">Tentang</a></li>
                        </ul>
                    </div>
                </nav>
            </div>

            {{-- Tombol Navigasi --}}
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#header-nav">
                <span></span> <span></span> <span></span> </button>
            <div class="vr mx-2 h-25 my-auto"></div>
            @auth
                {{-- MENU --}}
                <nav class="login-signup navbar navbar-expand separator">
                    <ul class="navbar-nav">
                        <li class="profile dropdown {{ request()->is('profile') ? 'active' : '' }}">
                            <a class="pe-0 dropdown-toggle" href="#" title="My Profile">
                                <span class="d-none d-sm-inline-block">{{ Auth::user()->name }}</span>
                                <span class="user-icon ms-sm-2">
                                    <i class="fas fa-user"></i>
                                </span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="text-center text-3 py-2">Hi, {{ Auth::user()->name }}</li>
                                <li class="dropdown-divider mx-n3"></li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('profile') }}">
                                        <i class="fas fa-user">
                                        </i>Informasi Pribadi
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('order.index') }}">
                                        <i class="fas fa-history"></i>Riwayat Pesanan
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('coupon.index') }}">
                                        <i class="fas fa-ticket-alt"></i>Kupon
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('cpassword') }}">
                                        <i class="fas fa-key">
                                        </i>Ubah Password
                                    </a>
                                </li>
                                <li class="dropdown-divider mx-n3"></li>
                                <li><a class="dropdown-item" href="{{ route('auth.logout') }}">
                                        <i class="fas fa-sign-out-alt"></i>Keluar
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <nav class="ms-2">
                    <div id="top-notification" class="dropdown">
                        <button type="button" class="icon-button" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="material-icons">notifications</span>
                            <span class="icon-button__badge" id="top-notification-number"></span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" style="min-width: 350px; max-width: 350px;">
                            <div class="dropdown-header">Notifikasi</div>
                            <div class="dropdown-divider"></div>
                            <div class="scroll" id="notification_items">

                            </div>
                        </div>
                    </div>
                </nav>
            @endauth
            @guest
                {{-- AUTHENTIKASI --}}
                <nav class="login-signup navbar navbar-expand separator ms-sm-0">
                    <ul class="navbar-nav">
                        <li><a href="{{ route('login') }}">Login</a> </li>
                        <li class="align-items-center h-auto ms-sm-2"><a class="btn btn-sm btn-primary"
                                href="{{ route('register') }}">Sign Up</a></li>
                    </ul>
                </nav>
            @endguest
        </div>
    </div>
</header>
