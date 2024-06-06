@extends('layouts.frontend.master')
@section('title', 'Konfirmasi Pemesanan')
@section('content')
    <section class="page-header page-header-dark bg-secondary">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1>Konfirmasi Pesanan</h1>
                </div>
                <div class="col-md-4">
                    <ul class="breadcrumb justify-content-start justify-content-md-end mb-0">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('schedule') }}">Booking</a></li>
                        <li class="active">Konfirmasi</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <form action="{{ route('checkout') }}" method="post" id="form-payment">
        @csrf
        <input type="hidden" name="schedule_id" value="{{ $schedule->id }}">
        <input type="hidden" name="coupon_id" id="coupon" value="">
        <input type="hidden" name="seats" value="">
        <div id="content">
            <section class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="bg-white shadow-md rounded p-3 p-sm-4 confirm-details">
                            <h2 class="text-6 mb-3">Konfirmasi Detail Pesanan</h2>
                            <div class="card">
                                <div class="card-header">
                                    <div class="row align-items-center trip-title">
                                        <div class="col-5 col-sm-auto text-center text-sm-left">
                                            <h5 class="m-0 trip-place">Medan</h5>
                                        </div>
                                        <div class="col-2 col-sm-auto text-8 text-black-50 text-center trip-arrow">➝
                                        </div>
                                        <div class="col-5 col-sm-auto text-center text-sm-left">
                                            <h5 class="m-0 trip-place">Laguboti</h5>
                                        </div>
                                        <div class="col-12 mt-1 d-block d-md-none"></div>
                                        <div class="col-6 col-sm col-md-auto text-3 date">
                                            {{ \Carbon\Carbon::parse($schedule->departure_date)->format('d M Y') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row align-items-sm-center flex-row">
                                        <div class="col-12 col-sm-3 mb-3 mb-sm-0">
                                            <span class="text-3 text-dark operator-name">
                                                Mobil No. {{ $schedule->car->car_number }}</span>
                                        </div>
                                        @php
                                            if ($schedule->route == 'ML') {
                                                $from = 'Medan';
                                                $to = 'Laguboti';
                                            } elseif ($schedule->route == 'LM') {
                                                $from = 'Laguboti';
                                                $to = 'Medan';
                                            } elseif ($schedule->route == 'SL') {
                                                $from = 'Sibolga';
                                                $to = 'Laguboti';
                                            } else {
                                                $from = 'Laguboti';
                                                $to = 'Sibolga';
                                            }
                                        @endphp
                                        <div class="col col-sm-3 text-center time-info">
                                            <span
                                                class="text-5 text-dark">{{ \Carbon\Carbon::parse($schedule->departure_time)->format('H:i') }}</span>
                                            <small class="text-muted d-block">{{ $from }}</small>
                                        </div>
                                        <div class="col col-sm-3 text-center d-none d-sm-block time-info">
                                            <div class="col-2 col-sm-auto text-8 text-black-50 text-center trip-arrow">➝
                                            </div>
                                        </div>
                                        <div class="col col-sm-3 text-center time-info">
                                            <span
                                                class="text-5 text-dark">{{ \Carbon\Carbon::parse($schedule->arrival_time)->format('H:i') }}</span>
                                            <small class="text-muted d-block">{{ $to }}</small>
                                        </div>
                                        <div class="col-12 mt-3 text-dark seats">No Bangku:
                                            @for ($i = 0; $i < $seats_count; $i++)
                                                <span class="badge bg-success py-1 px-2 font-weight-normal text-1 seat"
                                                    id="{{ $seats[$i] }}">{{ $seats[$i] }}</span>
                                            @endfor
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <aside class="col-lg-4 mt-4 mt-lg-0">
                        <div class="bg-white shadow-md rounded p-3">
                            <h3 class="text-5 mb-3">Biaya Perjalanan</h3>
                            <hr class="mx-n3">
                            <ul class="list-unstyled">
                                <li class="mb-2">Harga <span class="float-end text-4 fw-500 text-dark price"
                                        data-price="{{ $schedule->price }}"></span>
                                </li>
                                <li class="mb-2">Discount <span class="float-end text-4 fw-500 text-dark discount"></span>
                                </li>
                            </ul>
                            <div class="text-dark bg-light-4 text-4 fw-600 p-3"> Total
                                <span class="float-right text-6 btn-total"></span>
                            </div>
                            <h3 class="text-4 mb-3 mt-4">Promo Code</h3>
                            <div class="input-group form-group mb-3">
                                <input class="form-control" name="coupon" placeholder="Promo Code" aria-label="Promo Code"
                                    type="text">
                                <button class="btn btn-secondary shadow-none px-3" type="button" id="tombol_apply"
                                    onclick="check('#tombol_apply', 'APPLY');">APPLY</button>
                            </div>
                            <div class="d-grid">
                                <button class="btn btn-primary" onclick="payment('#tombol_payment');" id="tombol_payment"
                                    type="button">Buat Pesanan</button>
                            </div>
                        </div>
                    </aside>
                </div>
            </section>
        </div>
    </form>
@endsection
@push('scripts')
    <script>
        var seats = [];
        var price = 0;
        var quantity = 0;
        var discount = 0;
        var total = 0;
        $(document).ready(function() {
            $('.seat').each(function() {
                seats.push($(this).attr('id'));
            });
            $('input[name="seats"]').val(seats);
            price = $('.price').data('price');
            $('.price').html('Rp. ' + format_ribuan(price));
            quantity = 0;
            $('.seat').each(function() {
                quantity++;
            });
            total = price * quantity;
            $('.total').html('Rp. ' + format_ribuan(total));
            $('.btn-total').html('Bayar Rp. ' + format_ribuan(total));
            $('.discount').html('Discount <span class="float-right text-4 font-weight-500 text-dark">- Rp. ' +
                format_ribuan(0) + '</span>');
            $('#confirm').show();
            $('#payment').hide();
        });

        function check(tombol) {
            var coupon = $('input[name="coupon"]').val();
            var seats = $('input[name="seats"]').val();
            $(tombol).prop("disabled", true);
            $(tombol).html("Please wait");
            $.ajax({
                url: "{{ route('confirm.coupon') }}",
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    coupon: coupon,
                    seats: seats,
                    schedule_id: '{{ $schedule->id }}'
                },
                success: function(response, title) {
                    if (response.status == 'success') {
                        Swal.fire({
                            text: response.message,
                            icon: "success",
                            buttonsStyling: !1,
                            confirmButtonText: "Ok, Mengerti!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        });
                        setTimeout(function() {
                            $(tombol).prop("disabled", false);
                            $(tombol).html(title);
                        }, 2000);
                        $('.price').html('Rp. ' + format_ribuan(response.price));
                        $('.discount').html('Diskon <span class="text-success">(' + response.discount +
                            '% Off!)</span> <span class="float-right text-4 font-weight-500 text-dark"> - Rp. ' +
                            format_ribuan(response.total_discount) + '</span>');
                        $('.total').html('Rp. ' + format_ribuan(response.total));
                        $('.btn-total').html('Bayar Rp. ' + format_ribuan(response.total));
                        $('input[name="coupon_id"]').val(response.coupon);
                    } else {
                        Swal.fire({
                            text: response.message,
                            icon: "error",
                            buttonsStyling: !1,
                            confirmButtonText: "Ok, Mengerti!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        });
                        setTimeout(function() {
                            $(tombol).prop("disabled", false);
                            $(tombol).html('APPLY');
                        }, 2000);
                    }
                }
            });
        }

        function payment(tombol) {
            // confirm with swal fire
            Swal.fire({
                title: "Apakah anda yakin?",
                text: "Anda akan melakukan pembayaran sebesar Rp. " + format_ribuan(total),
                icon: "warning",
                showCancelButton: !0,
                confirmButtonText: "Ya, Lanjutkan!",
                cancelButtonText: "Tidak, Batalkan!",
                reverseButtons: !0
            }).then(function(result) {
                if (result.value) {
                    $(tombol).prop("disabled", true);
                    $(tombol).html("Please wait");
                    $('#form-payment').submit();
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    Swal.fire({
                        title: "Dibatalkan",
                        text: "Pembayaran anda telah dibatalkan",
                        icon: "error",
                        buttonsStyling: !1,
                        confirmButtonText: "Ok, Mengerti!",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    });
                }
            });
        }
    </script>
@endpush
