@extends('layouts.frontend.master')
@section('title', 'Selamat Datang')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-9 col-lg-7 col-xl-5 mx-auto">
                <div class="bg-white shadow-md rounded p-3 pt-sm-4 pb-sm-5 px-sm-5">
                    <h3 class="text-center mt-3 mb-4">Selamat Datang</h3>
                    <p class="text-center text-3 text-muted">Silahkan cari tiket perjalan anda</p>
                    <!-- symbol email -->
                    <div class="text-center">
                        <span class="symbol symbol-100px symbol-lg-150px">
                            <img src="https://preview.keenthemes.com/metronic8/demo1/assets/media/auth/welcome.png"
                                alt="" class="w-100" />
                        </span>
                    </div>
                    <p class="text-center mb-0"><a class="btn-link" href="{{ route('home') }}">Pergi ke Beranda</a></p>
                </div>
            </div>
        </div>
    </div>
@endsection
