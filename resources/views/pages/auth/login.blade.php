@extends('layouts.frontend.master')
@section('title', 'Login')
@section('content')
    <div id="content">
        <div class="container pt-5 pb-4">
            <div class="row">
                <div class="col-md-9 col-lg-7 col-xl-5 mx-auto">
                    <div class="bg-white shadow-md rounded p-3 pt-sm-4 pb-sm-5 px-sm-5">
                        <ul class="nav nav-tabs nav-justified mb-4" role="tablist">
                            <li class="nav-item"> <a class="nav-link text-5 lh-lg active">Login</a> </li>
                            <li class="nav-item"> <a class="nav-link text-5 lh-lg" href="{{ route('register') }}">Sign Up</a>
                            </li>
                        </ul>
                        <p class="text-4 fw-300 text-muted text-center mb-4">Selamat Datang!</p>
                        <form id="loginForm" method="post">
                            @csrf
                            <div class="mb-3">
                                <input type="email" class="form-control" name="email" placeholder="Email">
                            </div>
                            <div class="mb-3">
                                <input type="password" class="form-control" name="password" placeholder="Password">
                            </div>
                            <div class="row my-4">
                                <div class="col">
                                    <div class="form-check text-3">
                                        <input id="remember-me" name="remember" class="form-check-input" type="checkbox">
                                        <label class="form-check-label text-2" for="remember-me">Remember Me</label>
                                    </div>
                                </div>
                                <div class="col text-2 text-end"><a class="btn-link" href="{{ route('forgot') }}">Forgot
                                        Password ?</a>
                                </div>
                            </div>
                            <div class="d-grid my-4">
                                <button class="btn btn-primary" type="submit">Login</button>
                            </div>
                        </form>
                        <p class="text-2 text-center mb-0">Belum punya akun?
                            <a class="btn-link" href="{{ route('register') }}">Sign
                                Up</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('js/FormControls.js') }}"></script>
    <script>
        "use strict";
        const formEl = $('#loginForm');
        formEl.on('submit', function(e) {
            e.preventDefault();
            KTFormControls.onSubmitForm(formEl);
        });
    </script>
@endpush
