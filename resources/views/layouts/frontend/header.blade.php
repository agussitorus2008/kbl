<header id="header">
    <div class="container">
        <div class="header-row">
            <div class="header-column justify-content-start">
                <!-- Logo -->
                <div class="logo">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('img/logo.png') }}" alt="KBL" height="50">
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
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#header-nav">
                <span></span>
                <span></span> <span></span> </button>
            @auth
                {{-- MENU --}}
                <nav class="login-signup navbar navbar-expand separator">
                    <ul class="navbar-nav">
                        <li class="profile dropdown {{ request()->is('profile') ? 'active' : '' }}">
                            <a class="pr-0 dropdown-toggle" href="#" title="My Profile">
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
                {{-- NOTIFICATION --}}
                <nav class="navbar navbar-expand separator">
                    <div id="top-notification" class="dropdown">
                        <a class="nav-link dropdown-toggle" href="javascript:;" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <i class="fas fa-bell"></i>
                            <span class="badge badge-danger" id="top-notification-number">0</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
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
                <nav class="login-signup navbar navbar-expand separator pl-sm-2">
                    <ul class="navbar-nav">
                        <li class="profile">
                            <a class="pr-0" href="{{ route('login') }}" title="Login / Sign up">
                                <span class="d-none d-sm-inline-block">Masuk / Daftar</span>
                                <span class="user-icon ms-sm-2"><i class="fas fa-user"></i>
                                </span>
                            </a>
                        </li>
                    </ul>
                </nav>
            @endguest
        </div>
    </div>
</header>
