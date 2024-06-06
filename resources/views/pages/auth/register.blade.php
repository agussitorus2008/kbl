@extends('layouts.frontend.master')
@section('title', 'Register')

@section('content') <div id="content">
        <div class="container pt-5 pb-4">
            <div class="row">
                <div class="col-md-9 col-lg-7 col-xl-5 mx-auto">
                    <div class="bg-white shadow-md rounded p-3 pt-sm-4 pb-sm-5 px-sm-5">
                        <ul class="nav nav-tabs nav-justified mb-4" role="tablist">
                            <li class="nav-item"> <a class="nav-link text-5 lh-lg" href="{{ route('login') }}">Log In</a> </li>
                            <li class="nav-item"> <a class="nav-link text-5 lh-lg active">Sign Up</a> </li>
                        </ul>
                        <p class="text-4 fw-300 text-muted text-center mb-4">Sepertinya anda baru!</p>
                        <form id="signupForm" method="post">
                            <div class="mb-3">
                                <input type="text" class="form-control" name="name" placeholder="Nama Lengkap">
                            </div>
                            <div class="mb-3">
                                <input type="email" class="form-control" name="email" placeholder="Email">
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" name="phone" placeholder="No. Handphone">
                            </div>
                            <div class="mb-3">
                                <input type="password" class="form-control" name="password" placeholder="Password">
                            </div>
                            <div class="form-check text-3 my-4">
                                <input id="agree" name="agree" class="form-check-input" type="checkbox">
                                <label class="form-check-label text-2" for="agree">Saya setuju dengan <a
                                        href="#">Terms</a> and <a href="#">Privacy Policy</a>.</label>
                            </div>
                            <div class="d-grid my-4">
                                <button class="btn btn-primary" type="submit">Sign Up</button>
                            </div>
                        </form>
                        <p class="text-2 text-center mb-0">Already have an account? <a class="btn-link"
                                href="{{ route('login') }}">Log
                                In</a></p>
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
        const formEl = $('#signupForm');
        formEl.on('submit', function(e) {
            e.preventDefault();
            KTFormControls.onSubmitForm(formEl);
        });
    </script>
@endpush
