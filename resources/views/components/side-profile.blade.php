<div class="col-lg-3">
    <!-- Nav Link
============================================= -->
    <ul class="nav nav-pills alternate flex-lg-column sticky-top">
        <li class="nav-item">
            <a class="nav-link {{ request()->is('profile') ? 'active' : '' }}" href="{{ route('profile') }}">
                <i class="fas fa-user"></i>Informasi Pribadi
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('profile/cpassword') ? 'active' : '' }}" href="{{ route('cpassword') }}">
                <i class="fas fa-key"></i>Ubah Password
            </a>
        </li>
    </ul>
    <!-- Nav Link end -->
</div>
