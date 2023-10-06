@extends('layouts.frontend.master')
@section('title', 'Dashboard')
@section('content')
    <div id="content">
        <div class="hero-wrap py-4 py-md-5">
            <div class="hero-mask opacity-7 bg-primary"></div>
            <div class="hero-bg" style="background-image:url('{{ asset('users/images/bg/image-2.jpg') }}');"></div>
            <div class="hero-content py-0 py-lg-3">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="position-relative px-4 pt-3 pb-4">
                                <div class="hero-mask opacity-8 bg-dark rounded"></div>
                                <div class="hero-content">
                                    <div class="tab-content pt-4" id="myTabContent">
                                        <form action="{{ route('schedule') }}" class="search-input-line" method="post">
                                            @csrf
                                            <div class="row">
                                                <div class="col-12 form-group">
                                                    <select class="custom-select" name="route">
                                                        <option value="">Pilih Rute</option>
                                                        <option value="ML">Medan - Laguboti</option>
                                                        <option value="LM">Laguboti - Medan</option>
                                                        <option value="LS">Laguboti - Sibolga</option>
                                                        <option value="SL">Sibolga - Laguboti</option>
                                                    </select>
                                                </div>
                                                <div class="col-12 form-group">
                                                    <input id="busDepart" type="text" class="form-control"
                                                        name="departure_time" placeholder="Depart Date">
                                                    <span class="icon-inside"><i class="far fa-calendar-alt"
                                                            aria-hidden="true"></i></span>
                                                </div>
                                                <div class="col-12 travellers-class form-group">
                                                    <input type="text" id="busTravellersClass"
                                                        class="travellers-class-input form-control" placeholder="Seats"
                                                        required name="available_seats" onkeypress="return false;">
                                                    <span class="icon-inside"><i class="fas fa-caret-down"
                                                            aria-hidden="true"></i></span>
                                                    <div class="travellers-dropdown">
                                                        <div class="row align-items-center mb-3">
                                                            <div class="col-sm-7">
                                                                <p class="mb-sm-0">Seats</p>
                                                            </div>
                                                            <div class="col-sm-5">
                                                                <div class="qty input-group">
                                                                    <div class="input-group-prepend">
                                                                        <button type="button" class="btn bg-light-4"
                                                                            data-value="decrease"
                                                                            data-target="#adult-travellers"
                                                                            data-toggle="spinner">-</button>
                                                                    </div>
                                                                    <input type="text" data-ride="spinner"
                                                                        id="adult-travellers"
                                                                        class="qty-spinner form-control" value="1"
                                                                        readonly="">
                                                                    <div class="input-group-append">
                                                                        <button type="button" class="btn bg-light-4"
                                                                            data-value="increase"
                                                                            data-target="#adult-travellers"
                                                                            data-toggle="spinner">+</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <button class="btn btn-primary btn-block submit-done"
                                                            type="button">Done</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <button class="btn btn-primary btn-block mt-2" type="submit">Cari
                                                Mobil</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mt-5 mt-lg-0">
                            <h2 class="text-9 font-weight-600 text-light">Kenapa Harus Memilih Kami?</h2>
                            <p class="lead mb-4 text-light">Kami menyediakan berbagai macam mobil yang berkualitas
                                dan
                                berkualitas.</p>
                            <div class="row">
                                <div class="col-12">
                                    <div class="featured-box style-3 mb-4">
                                        <div class="featured-box-icon border rounded-circle text-light"> <i
                                                class="fas fa-dollar-sign" aria-hidden="true"></i></div>
                                        <h3 class="text-light">Harga Terjangkau</h3>
                                        <p class="text-light opacity-8">Kami menyediakan harga terjangkau untuk
                                            setiap
                                            mobil.</p>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="featured-box style-3 mb-4">
                                        <div class="featured-box-icon border rounded-circle text-light">
                                            <i class="fas fa-user-friends" aria-hidden="true"></i>
                                        </div>
                                        <h3 class="text-light">Pelayanan Terbaik</h3>
                                        <p class="text-light opacity-8">Kami menyediakan pelayanan terbaik untuk
                                            setiap
                                            mobil.</p>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="featured-box style-3 mb-4">
                                        <div class="featured-box-icon border rounded-circle text-light"> <i
                                                class="fas fa-percentage" aria-hidden="true"></i></div>
                                        <h3 class="text-light">Diskon</h3>
                                        <p class="text-light opacity-8">Kami menyediakan diskon untuk setiap
                                            mobil.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('custom-scripts')
    <script>
        $(function() {
            'use strict';
            $('#busDepart').daterangepicker({
                singleDatePicker: true,
                minDate: moment(),
                autoUpdateInput: false,
            }, function(chosen_date) {
                $('#busDepart').val(chosen_date.format('YYYY-MM-DD'));
            });
        });
    </script>
    @auth
        <x-chat />
    @endauth
@endpush
