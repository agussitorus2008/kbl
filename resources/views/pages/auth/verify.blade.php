@extends('layouts.frontend.master')
@section('title', 'Verifikasi Email')

@section('content')
    <div id="content">
        <div class="container pt-5 pb-4">
            <div class="row">
                <div class="col-md-9 col-lg-7 col-xl-5 mx-auto">
                    <div class="bg-white shadow-md rounded p-3 pt-sm-4 pb-sm-5 px-sm-5">
                        <h3 class="text-center mt-3 mb-4">Verifikasi Email</h3>
                        <p class="text-center text-3 text-muted">Verifikasi email anda</p>
                        <div class="text-center fs-6 mb-8">
                            <span class="fw-semibold text-gray-500">Belum menerima email?</span>
                            <a href="javascript:;" onclick="send('{{ route('verification.send') }}');"
                                class="link-primary fw-bold">Kirim ulang</a>
                        </div>
                        <!-- symbol email -->
                        <div class="text-center">
                            <span class="symbol symbol-100px symbol-lg-150px">
                                <img src="https://preview.keenthemes.com/metronic8/demo1/assets/media/auth/please-verify-your-email.png"
                                    alt="" class="w-100" />
                            </span>
                        </div>
                        <p class="text-center mb-0"><a class="btn-link" href="{{ route('logout') }}">Return to Log
                                In</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        function send(url) {
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.status == 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: response.message,
                        });
                    }
                }
            });
        }
    </script>
@endpush
