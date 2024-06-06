@extends('layouts.frontend.master')
@section('title', 'Daftar Jadwal')
@section('content')
    <section class="page-header page-header-dark bg-secondary">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1>List Jadwal</h1>
                </div>
                <div class="col-md-4">
                    <ul class="breadcrumb justify-content-start justify-content-md-end mb-0">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li class="active">List Jadwal</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <div id="content">
        <section class="container">
            <form id="content_filter">
                <div class="row g-3 mb-4">
                    <div class="col mb-2">
                        <div class="row">
                            <div class="col-md-6 col-lg form-group">
                                <select class="form-select" name="route" id="route">
                                    <option value="" disabled selected>Pilih Rute</option>
                                    <option value="ML" {{ $route == 'ML' ? 'selected' : '' }}>Medan - Laguboti</option>
                                    <option value="LM" {{ $route == 'LM' ? 'selected' : '' }}>Laguboti - Medan</option>
                                    <option value="LS" {{ $route == 'LS' ? 'selected' : '' }}>Laguboti - Semarang
                                    </option>
                                    <option value="SL" {{ $route == 'SL' ? 'selected' : '' }}>Semarang - Laguboti
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-4 col-lg form-group">
                                <input id="busDepart" type="text" class="form-control" name="busDepart"
                                    placeholder="Pilih Tanggal" value="{{ $departureTime }}">
                                <span class="icon-inside">
                                    <i class="far fa-calendar-alt"></i>
                                </span>
                            </div>
                            <div class="col-md-4 col-lg travellers-class form-group">
                                <input type="text" id="busTravellersClass" class="travellers-class-input form-control"
                                    name="available_seats" placeholder="Kursi Tersedia" value="{{ $availableSeats }}">

                                <span class="icon-inside"><i class="fas fa-caret-down"></i></span>
                                <div class="travellers-dropdown" style="display: none;">
                                    <div class="row align-items-center mb-3">
                                        <div class="col-sm-7">
                                            <p class="mb-sm-0">Seats</p>
                                        </div>
                                        <div class="col-sm-5">
                                            <div class="qty input-group">
                                                <div class="input-group-prepend">
                                                    <button type="button" class="btn bg-light-4" data-value="decrease"
                                                        data-target="#adult-travellers" data-toggle="spinner">-</button>
                                                </div>
                                                <input type="text" data-ride="spinner" id="adult-travellers"
                                                    class="qty-spinner form-control" value="0">
                                                <div class="input-group-append">
                                                    <button type="button" class="btn bg-light-4" data-value="increase"
                                                        data-target="#adult-travellers" data-toggle="spinner">+</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary btn-block submit-done" type="button">Done</button>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg form-group">
                                <a href="javascript:;" class="btn btn-primary btn-block" type="button"
                                    onclick="load_data(1)">Cari</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <aside class="col-md-3">
                        <div class="bg-white shadow-md rounded p-3">
                            <h3 class="text-5">Filter</h3>
                            <hr class="mx-n3">
                            <div class="accordion accordion-flush style-2 mt-n3" id="toggleAlternate">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="carType">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#togglecarType" aria-expanded="true"
                                            aria-controls="togglecarType">Tipe Kendaraan</button>
                                    </h2>

                                </div>
                                <div id="togglecarType" class="accordion-collapse collapse show" aria-labelledby="carType">
                                    <div class="accordion-body">
                                        @foreach ($carTypes as $carType)
                                            <div class="form-check">
                                                <input type="checkbox" name="type" class="form-check-input"
                                                    value="{{ $carType }}" onclick="load_data(1)">
                                                <label class="custom-control-label d-block"
                                                    for="{{ $carType }}">{{ Str::ucfirst($carType) }}
                                                    <small
                                                        class="text-muted float-right">{{ $counts[$carType] }}</small></label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="departure">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#toggleDeparture" aria-expanded="true"
                                            aria-controls="toggleDeparture">Waktu Keberangkatan</button>
                                    </h2>
                                    <div id="toggleDeparture" class="collapse show" aria-labelledby="departure">
                                        <div class="accordion-body">
                                            <p>
                                                <span class="slider-time-departure"
                                                    id="slider-time-departure-start">00:00</span>
                                                -
                                                <span class="slider-time-departure"
                                                    id="slider-time-departure-end">23:59</span>
                                            </p>
                                            <div id="slider-range-departure"
                                                class="ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content">
                                                <div class="ui-slider-range ui-corner-all ui-widget-header"
                                                    style="left: 0%; width: 100%;"></div><span tabindex="0"
                                                    class="ui-slider-handle ui-corner-all ui-state-default"
                                                    style="left: 0%;"></span><span tabindex="0"
                                                    class="ui-slider-handle ui-corner-all ui-state-default"
                                                    style="left: 100%;"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="price">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#togglePrice" aria-expanded="true"
                                            aria-controls="togglePrice">Harga</button>
                                    </h2>
                                    <div id="togglePrice" class="collapse show" aria-labelledby="price">
                                        <div class="accordion-body">
                                            <p>
                                                <input id="amount" type="text" readonly
                                                    class="form-control border-0 bg-transparent p-0">
                                            </p>
                                            <div id="slider-range"
                                                class="ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content">
                                                <div class="ui-slider-range ui-corner-all ui-widget-header"
                                                    style="left: 0%; width: 100%;">
                                                </div>
                                                <span tabindex="0"
                                                    class="ui-slider-handle ui-corner-all ui-state-default"
                                                    style="left: 0%;">
                                                </span>
                                                <span tabindex="0"
                                                    class="ui-slider-handle ui-corner-all ui-state-default"
                                                    style="left: 100%;"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </aside>
                    <div class="col-md-9 mt-4 mt-md-0">
                        <div id="list_result"></div>
                    </div>
                </div>
            </form>
        </section>
    </div>
@endsection
@push('scripts')
    <script>
        load_data(1);
        $(document).ready(function() {
            var max = parseInt({{ $max }});
            var min = 0;
            if (isNaN(max)) {
                max = 0;
            }
            $('#amount').val('Rp ' + min + ' - Rp ' + max);
        });
        $(function() {
            'use strict';

            // Depart Date
            $('#busDepart').daterangepicker({
                singleDatePicker: true,
                autoApply: true,
                minDate: moment(),
                autoUpdateInput: false,
            }, function(chosen_date) {
                $('#busDepart').val(chosen_date.format('YYYY-MM-DD'));
            });

            // Departure Time Slider Range (jQuery UI)
            $("#slider-range-departure").slider({
                range: true,
                min: 0,
                max: 1439,
                values: [0, 1439],
                slide: function(e, ui) {
                    $('.slider-time-departure').each(function(i) {
                        var hours = ("00" + Math.floor(ui.values[i] / 60)).slice(-2);
                        var mins = ("00" + (ui.values[i] - (hours * 60))).slice(-2);
                        $(this).html(hours + ':' + mins);
                    });
                }
            });

            // Slider Range (jQuery UI)
            var max = parseInt({{ $max }});
            $("#slider-range").slider({
                range: true,
                min: 0,
                max: max,
                values: [0, max],
                slide: function(event, ui) {
                    $('#amount').val('Rp ' + ui.values[0] + ' - Rp ' + ui.values[1]);
                }
            });
        });

        function load_data(page) {
            var route = $('#route option:selected').val();
            var departure_time = $('#busDepart').val();
            var available_seats = $('#adult-travellers').val();
            var type = $('input[name=type]:checked').val();
            var data = $('#content_filter').serialize();
            var depart_time_start = $("#slider-time-departure-start").html();
            var depart_time_end = $("#slider-time-departure-end").html();
            var price_start = $("#amount").val().split(' ')[1];
            var price_end = $("#amount").val().split(' ')[4];
            $.get('?page=' + page, {
                route: route,
                departure_time: departure_time,
                available_seats: available_seats,
                type: type,
                depart_time_start: depart_time_start,
                depart_time_end: depart_time_end,
                price_start: price_start,
                price_end: price_end
            }, function(data) {
                $("#list_result").html(data);
            });
        }
    </script>
    @auth
        <x-chat />
    @endauth
@endpush
