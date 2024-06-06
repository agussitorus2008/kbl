@extends('layouts.frontend.master')
@section('title', 'Pembayaran Berhasil')
@section('content')
    <div id="content">
        <div class="container">
            <div class="row my-5">
                <div class="col-md-11 mx-auto">
                    <!-- Steps Progress bar
                                                                                            ============================================= -->
                    <div class="row widget-steps">
                        <div class="col-3 step complete">
                            <div class="step-name">Order</div>
                            <div class="progress">
                                <div class="progress-bar"></div>
                            </div>
                            <a href="#" class="step-dot"></a>
                        </div>
                        <div class="col-3 step complete">
                            <div class="step-name">Summary</div>
                            <div class="progress">
                                <div class="progress-bar"></div>
                            </div>
                            <a href="#" class="step-dot"></a>
                        </div>
                        <div class="col-3 step complete">
                            <div class="step-name">Payment</div>
                            <div class="progress">
                                <div class="progress-bar"></div>
                            </div>
                            <a href="#" class="step-dot"></a>
                        </div>
                        <div class="col-3 step complete">
                            <div class="step-name">Done</div>
                            <div class="progress">
                                <div class="progress-bar"></div>
                            </div>
                            <a href="#" class="step-dot"></a>
                        </div>
                    </div>
                </div>
                <!-- Steps Progress bar end -->
                <div class="col-lg-12 text-center mt-5">
                    <p class="text-success text-16 lh-1"><i class="fas fa-check-circle"></i></p>
                    <h2 class="text-8">Pembayaran Berhasil</h2>
                    <p class="lead">Kami mengirimkan bukti pembayaran ke email anda</p>
                </div>
                <div class="col-md-8 col-lg-6 col-xl-5 mx-auto">
                    <div class="bg-white shadow-sm rounded p-4 p-lg-5 mb-4">
                        <div class="row">
                            <div class="col-sm text-muted">Transactions ID</div>
                            <div class="col-sm text-sm-end fw-600">{{ $order->id }}</div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm text-muted">Date</div>
                            <div class="col-sm text-sm-end fw-600">
                                {{ \Carbon\Carbon::parse($order->schedule->departure_date)->format('d M Y') }}</div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm text-muted">Mode of Payment</div>
                            <div class="col-sm text-sm-end fw-600">Credit Card</div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm text-muted">Transaction Status</div>
                            <div class="col-sm text-sm-end fw-600 text-success">Success</div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm text-muted">Nama Penumpang</div>
                            <div class="col-sm text-sm-end fw-600">{{ $order->user->name }}</div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm text-muted">No Handphone</div>
                            <div class="col-sm text-sm-end fw-600">{{ $order->user->phone }}</div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm text-muted">Subject</div>
                            <div class="col-sm text-sm-end fw-600">Pembelian tiket</div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm text-muted">Payment Amount</div>
                            <div class="col-sm text-sm-end text-6 fw-500">Rp. {{ number_format($order->total) }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Content end -->
    </div>
@endsection
