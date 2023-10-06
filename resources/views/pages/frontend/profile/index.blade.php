@extends('layouts.frontend.master')
@section('title', 'Profile')
@section('content')
    <!-- Page Header
                    ============================================= -->
    <section class="page-header page-header-text-light bg-secondary">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1>Profil saya</h1>
                </div>
                <div class="col-md-4">
                    <ul class="breadcrumb justify-content-start justify-content-md-end mb-0">
                        <li class="active">Profil saya</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- Page Header end -->

    <!-- Content
                  ============================================= -->
    <div id="content">
        <div class="container">
            <div class="row">
                <x-side-profile />
                <div class="col-lg-9">
                    <div class="bg-white shadow-md rounded p-4">
                        <!-- Personal Information
                          ============================================= -->
                        <h4 class="mb-4">Informasi Pribadi</h4>
                        <hr class="mx-n4 mb-4">
                        <div class="row">
                            <div class="col-lg-8">
                                <form id="form_input">
                                    <div class="form-group">
                                        <label for="fullName">Nama</label>
                                        <input type="text" value="{{ Auth::user()->name }}" class="form-control"
                                            name="name" id="fullName" placeholder="Full Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="emailID">Email</label>
                                        <input type="text" value="{{ Auth::user()->email }}" class="form-control"
                                            name="email" id="emailID" placeholder="Email ID">
                                    </div>
                                    <div class="form-group">
                                        <label for="mobileNumber">No Handphone</label>
                                        <input type="text" value="{{ Auth::user()->phone }}" class="form-control"
                                            name="phone" id="mobileNumber" placeholder="Mobile Number">
                                    </div>

                                    <div class="form-group">
                                        <label for="address">Alamat</label>
                                        <input type="text" value="{{ Auth::user()->address }}" class="form-control"
                                            name="address" id="address" placeholder="Alamat">
                                    </div>
                                    <button class="btn btn-primary" id="btnChangePassword" onclick="changeProfile()"
                                        type="button">
                                        Perbarui Profile
                                </form>
                            </div>
                            <x-content-side />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@section('custom_js')
    <x-chat />
    <script>
        function changeProfile() {
            $.ajax({
                url: "{{ route('update_profile') }}",
                type: "POST",
                data: $('#form_input').serialize(),
                success: function(response) {
                    if (response.status == 'success') {
                        toastr.success(response.message);
                    } else {
                        toastr.error(response.message);
                    }
                }
            });
        }
    </script>
@endsection
@endsection
