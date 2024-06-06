@extends('layouts.frontend.master')
@section('title', 'Bayar Tiket')
@section('content')
    <!-- Page Header
                                                                                                                                                                                                                                      ============================================= -->
    <section class="page-header page-header-dark bg-secondary">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1>Bayar Tiket</h1>
                </div>
                <div class="col-md-4">
                    <ul class="breadcrumb justify-content-start justify-content-md-end mb-0">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li class="active">Bayar Tiket</li>
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
            <div class="bg-white shadow-md rounded p-4">
                <h3 class="text-6 mb-4">Bayar Tiket Anda</h3>
                <hr class="mx-n4">
                <div class="row g-4">
                    <div class="col-md-7 col-lg-8 order-1 order-md-0">
                        <img class="img-fluid" src="https://iconape.com/wp-content/files/yh/207674/svg/207674.svg"
                            alt="Paypal Logo" title="Pay easily, fast and secure with Midtrans.">
                        <p class="lead">Bayar Mudah Dengan Midtrans.</p>
                        <p class="alert alert-info mb-4"><i class="fas fa-info-circle"></i>Anda dapat melanjutkan pembayaran
                        </p>
                        <button class="btn btn-primary d-flex align-items-center" id="tombol_bayar" type="submit">Bayar
                        </button>
                    </div>
                    <div class="col-md-5 col-lg-4 order-0 order-md-1">

                        <!-- Payable Amount ============================================= -->
                        <div class="bg-light rounded p-4">
                            <h3 class="text-4 mb-4">Total Pembayaran</h3>
                            <ul class="list-unstyled">
                                <li class="mb-2">Amount <span class="float-end text-4 fw-500 text-dark">Rp.
                                        {{ number_format($order->schedule->price, 0, ',', '.') }} x
                                        {{ $order->orderDetails->count() }}</span></li>
                                @if ($order->coupon)
                                    <li class="mb-2">Discount <span class="text-success">({{ $order->coupon->discount }}%
                                            Off!)</span> <span class="float-end text-4 fw-500 text-dark">-Rp.
                                            {{ number_format(($order->coupon->discount * $order->schedule->price * $order->orderDetails->count()) / 100, 0, ',', '.') }}
                                        </span>
                                    </li>
                                @endif
                            </ul>
                            <hr class="mx-n4">
                            <div class="text-dark text-4 fw-500 mt-4"> Total Amount<span class="float-end text-7">Rp.
                                    {{ number_format($order->total) }}</span></div>
                        </div>
                        <!-- Payable Amount end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Content end -->
@endsection
@push('scripts')
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT') }}"></script>
    <script>
        $(document).ready(function() {
            $('#tombol_bayar').on('click', function(e) {
                e.preventDefault();
                snap.pay('{{ $order->snap_token }}', {
                    onSuccess: function(result) {
                        window.location.href = "{{ route('order.success', $order->id) }}";
                    },
                    onPending: function(result) {
                        location.reload();
                    },
                    onError: function(result) {
                        location.reload();
                    }
                });
            });
        });
    </script>
@endpush
