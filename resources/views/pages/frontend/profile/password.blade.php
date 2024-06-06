@extends('layouts.frontend.master')
@section('title', 'Change Password')
@section('content')
    <section class="page-header page-header-dark bg-secondary">
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
    <div id="content">
        <div class="container">
            <div class="row">
                <x-side-profile />
                <div class="col-lg-9">
                    <div class="bg-white shadow-md rounded p-4">
                        <h4 class="mb-4">Ubah Password</h4>
                        <hr class="mx-n4 mb-4">
                        <div class="row">
                            <div class="col-lg-8">
                                <form id="changePassword">
                                    <div class="mb-3">
                                        <label class="form-label" for="existingPassword">Password Lama</label>
                                        <input type="text" class="form-control" name="current_password"
                                            id="existingPassword" placeholder="Password Lama">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="newPassword">Password Baru</label>
                                        <input type="text" class="form-control" name="new_password" id="newPassword"
                                            placeholder="Password Baru">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="existingPassword">Konfirmasi Password Baru</label>
                                        <input type="text" class="form-control" name="confirm_password"
                                            placeholder="Konfirmasi Password Baru">
                                    </div>
                                    <button class="btn btn-primary" id="btnChangePassword" onclick="changePassword()"
                                        type="button">
                                        Perbarui Password
                                    </button>
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
        function changePassword() {
            $.ajax({
                url: "{{ route('cpassword') }}",
                type: "POST",
                data: $('#changePassword').serialize(),
                success: function(response) {
                    if (response.status == 'success') {

                        Swal.fire({
                            title: 'Berhasil!',
                            text: response.message,
                            icon: "success",
                            buttonsStyling: !1,
                            confirmButtonText: "Ok, Mengerti!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        });
                    } else {
                        console.log(response.message);
                        Swal.fire({
                            title: 'Gagal!',
                            text: response.message,
                            icon: "error",
                            buttonsStyling: !1,
                            confirmButtonText: "Ok, Mengerti!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        });
                    }
                }
            });
        }
    </script>
@endsection
@endsection
