@extends('layouts.frontend.master')
@section('title', 'Login')
@section('content')
    <div id="content">
        <div class="container pt-5 pb-4">
            <div class="row">
                <div class="col-md-9 col-lg-7 col-xl-5 mx-auto">
                    <div class="bg-white shadow-md rounded p-3 pt-sm-4 pb-sm-5 px-sm-5">
                        <h3 class="text-center mt-3 mb-4">Lupa Password?</h3>
                        <p class="text-center text-3 text-muted">Masukkan email anda untuk mereset password.</p>
                        <form id="forgotForm" class="form-border" method="post">
                            <div class="mb-3">
                                <input type="email" class="form-control" name="email" placeholder="Enter Email">
                            </div>
                            <div class="d-grid my-4">
                                <button class="btn btn-primary" type="submit">Continue</button>
                            </div>
                        </form>
                        <p class="text-center mb-0"><a class="btn-link" href="{{ route('login') }}">Return to Log In</a>
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
        const formEl = $('#forgotForm');
        formEl.on('submit', function(e) {
            e.preventDefault();
            KTFormControls.onSubmitForm(formEl);
        });
    </script>
@endpush
