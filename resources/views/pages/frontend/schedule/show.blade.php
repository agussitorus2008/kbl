@extends('layouts.frontend.master')
@section('title', 'Daftar Jadwal')
@push('custom-css')
    <style>
        .fs {
            font-size: 50px;
        }
    </style>
@endpush
@section('content')
    {{-- <section class="page-header page-header-text-light bg-secondary">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1>Detail Jadwal</h1>
                </div>
                <div class="col-md-4">
                    <ul class="breadcrumb justify-content-start justify-content-md-end mb-0">
                        <li>Home</li>
                        <li class="active">Detail Jadwal</li>
                    </ul>
                </div>
            </div>
        </div>
    </section> --}}
    <section class="page-header page-header-dark bg-secondary">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1>Detail Jadwal</h1>
                </div>
                <div class="col-md-4">
                    <ul class="breadcrumb justify-content-start justify-content-md-end mb-0">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li class="active">Detail Jadwal</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <div id="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="bg-white shadow-md rounded p-3 p-sm-4 mb-4">
                        <h2 class="d-flex align-items-center text-7 mb-3 mb-sm-4">Detail
                            <span class="ml-2">Jadwal</span>
                        </h2>
                        <hr class="mx-n3 mx-sm-n4 mb-4">
                        <div class="row">
                            <div class="col-md-5">
                                <img class="img-fluid align-top"
                                    src="{{ asset('images/drivers/' . $schedule->car->driver->image) }}" alt="drivers">
                            </div>
                            <div class="col-md-7 mt-3 mt-md-0">
                                <table>
                                    <tr>
                                        <td>
                                            <span class="mr-1">Nama Supir</span>
                                        </td>
                                        <td>
                                            <span class="ml-1">:</span>
                                        </td>
                                        <td>
                                            <span class="ml-1">{{ $schedule->car->driver->name }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="mr-1">No. Telp</span>
                                        </td>
                                        <td>
                                            <span class="ml-1">:</span>
                                        </td>
                                        <td>
                                            <span class="ml-1">{{ $schedule->car->driver->phone }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="mr-1">Alamat</span>
                                        </td>
                                        <td>
                                            <span class="ml-1">:</span>
                                        </td>
                                        <td>
                                            <span class="ml-1">{{ $schedule->car->driver->address }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="mr-1">No. Plat</span>
                                        </td>
                                        <td>
                                            <span class="ml-1">:</span>
                                        </td>
                                        <td>
                                            <span class="ml-1">{{ $schedule->car->plate_number }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="mr-1">No. Mobil</span>
                                        </td>
                                        <td>
                                            <span class="ml-1">:</span>
                                        </td>
                                        <td>
                                            <span class="ml-1">{{ $schedule->car->car_number }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="mr-1">Tipe</span>
                                        </td>
                                        <td>
                                            <span class="ml-1">:</span>
                                        </td>
                                        <td>
                                            @if ($schedule->car->type == 'bus')
                                                <span class="ml-1">Bus
                                                </span>
                                            @elseif ($schedule->car->type == 'minibus')
                                                <span class="ml-1">Minibus
                                                </span>
                                            @else
                                                <span class="ml-1">Mobil
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                                <hr class="mx-n3 mx-sm-n4 mb-4">
                                <div class="row mb-3">
                                    <div class="col-sm-6" data-toggle="tooltip"
                                        data-original-title="Free cancellation up to 72 hours prior to pick up">
                                        <span class="text-success mr-1">
                                            <i class="fas fa-check"></i>
                                        </span>
                                        Pembatalan Gratis
                                    </div>
                                    <div class="col-sm-6" data-toggle="tooltip"
                                        data-original-title="Instantly confirmed upon booking">
                                        <span class="text-success mr-1"><i class="fas fa-check"></i></span>
                                        Konfirmasi Instan
                                    </div>
                                    <div class="col-sm-6" data-toggle="tooltip"
                                        data-original-title="In the unlikely event you find a better price on the same brand, we'll beat it. See 'Price Promise' on our About Us page">
                                        <span class="text-success mr-1"><i class="fas fa-check"></i></span>
                                        Harga Terjangkau
                                    </div>
                                    <div class="col-sm-6" data-toggle="tooltip"
                                        data-original-title="Rate includes Third Party Liability Cover">
                                        <span class="text-success mr-1"><i class="fas fa-check"></i></span>
                                        Supir Profesional
                                    </div>
                                    <div class="col-sm-6" data-toggle="tooltip"
                                        data-original-title="If the car is stolen, all you’ll pay is the theft excess – not the full cost of the car.">
                                        <span class="text-success mr-1"><i class="fas fa-check"></i></span>
                                        Pembayaran Aman
                                    </div>
                                    <div class="col-sm-6" data-toggle="tooltip"
                                        data-original-title="If the car’s bodywork gets damaged, the most you’ll pay is the damage excess.">
                                        <span class="text-success mr-1"><i class="fas fa-check"></i></span>
                                        Bantuan 24 Jam
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <aside class="col-lg-4 mt-4 mt-lg-0">
                    <div class="bg-white shadow-md rounded p-3 sticky-top">
                        <h3 class="text-5 mb-3">Detail</h3>
                        <hr class="mx-n3">
                        <ul class="list-unstyled">
                            <li>
                                <span class="text-success mr-1">Rute :</span>
                                @if ($schedule->route == 'ML')
                                    <span class="text-dark">Medan - Laguboti</span>
                                @elseif ($schedule->route == 'LM')
                                    <span class="text-dark">Laguboti - Medan</span>
                                @elseif ($schedule->route == 'SL')
                                    <span class="text-dark">Sibolga - Laguboti</span>
                                @elseif ($schedule->route == 'LS')
                                    <span class="text-dark">Laguboti - Sibolga</span>
                                @endif
                            </li>
                            <li>
                                <span class="text-success mr-1">Tanggal :</span>
                                <span
                                    class="text-dark">{{ \Carbon\Carbon::parse($schedule->departure_date)->translatedFormat('l, d F Y') }}</span>
                            </li>
                            <li>
                                <span class="text-success mr-1">Jam Berangkat :</span>
                                <span
                                    class="text-dark">{{ \Carbon\Carbon::parse($schedule->departure_time)->translatedFormat('H:i') }}
                                    WIB</span>
                            </li>
                            <li>
                                <span class="text-success mr-1">Jam Sampai :</span>
                                <span
                                    class="text-dark">{{ \Carbon\Carbon::parse($schedule->arrival_time)->translatedFormat('H:i') }}
                                    WIB</span>
                            </li>
                            <li>
                                <span class="text-success mr-1">Bangku Tersedia :</span>
                                <span class="text-dark">{{ $schedule->available_seats }}</span>
                            </li>
                        </ul>
                        <hr>
                        <div class="text-dark text-4 fw-500 my-4">Harga
                            <span class="float-end text-9">Rp. {{ number_format($schedule->price) }}</span>
                        </div>
                        @auth
                            <hr>
                            <a href="javascript:;"
                                onclick="handle_open_modal('{{ route('schedule.input', $schedule->id) }}','#modalListResult','#contentListResult');"
                                class="btn btn-sm btn-block btn-primary mt-3">
                                <span class="d-block d-sm-none d-lg-block">Pilih Kursi</span>
                            </a>
                        @endauth
                    </div>
                </aside>
            </div>
        </div>
    </div>
@endsection
