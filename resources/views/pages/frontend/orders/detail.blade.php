<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('img/favicon.png') }}" />
    <title>Bukti Tiket</title>
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900'
        type='text/css'>
    <link href="{{ asset('frontend/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/vendor/font-awesome/css/all.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/stylesheet.css') }}" />
</head>

<body>
    <div class="container-fluid invoice-container">
        <div class="row align-items-center">
            <div class="col-sm-12 text-center text-sm-left">
                <center>
                    <p><img src="{{ asset('img/logo.png') }}" class="img-fluid" title="Koperasi Bintang Laguboti"
                            height="50" /></p>
                </center>
            </div>
        </div>
        <hr class="my-4">
        <div class="row">
            @if ($order->schedule->route == 'ML')
                <div class="col-sm-4 mb-3 mb-sm-0"> <span class="text-black-50 text-uppercase">Dari:</span><br>
                    <span class="font-weight-500 text-3">Medan</span>
                </div>
                <div class="col-sm-4 mb-3 mb-sm-0">
                    <span class="text-black-50 text-uppercase">Ke:</span><br>
                    <span class="font-weight-500 text-3">Lagu Boti</span>
                </div>
            @elseif($order->schedule->route == 'LB')
                <div class="col-sm-4 mb-3 mb-sm-0"> <span class="text-black-50 text-uppercase">Dari:</span><br>
                    <span class="font-weight-500 text-3">Lagu Boti</span>
                </div>
                <div class="col-sm-4 mb-3 mb-sm-0">
                    <span class="text-black-50 text-uppercase">Ke:</span><br>
                    <span class="font-weight-500 text-3">Medan</span>
                </div>
            @elseif($order->schedule->route == 'LS')
                <div class="col-sm-4 mb-3 mb-sm-0"> <span class="text-black-50 text-uppercase">Dari:</span><br>
                    <span class="font-weight-500 text-3">Lagu Boti</span>
                </div>
                <div class="col-sm-4 mb-3 mb-sm-0">
                    <span class="text-black-50 text-uppercase">Ke:</span><br>
                    <span class="font-weight-500 text-3">Sibolga</span>
                </div>
            @elseif($order->schedule->route == 'SL')
                <div class="col-sm-4 mb-3 mb-sm-0"> <span class="text-black-50 text-uppercase">Dari:</span><br>
                    <span class="font-weight-500 text-3">Sibolga</span>
                </div>
                <div class="col-sm-4 mb-3 mb-sm-0">
                    <span class="text-black-50 text-uppercase">Ke:</span><br>
                    <span class="font-weight-500 text-3">Lagu Boti</span>
                </div>
            @endif
            <div class="col-sm-4">
                <span class="text-black-50 text-uppercase">Tanggal Keberangkatan</span><br>
                <span
                    class="font-weight-500 text-3">{{ \Carbon\Carbon::parse($order->schedule->departure_time)->translatedFormat('l, d-F-Y') }}</span>
            </div>
        </div>
        <hr class="my-4">
        <div class="row">
            <div class="col-sm-3 mb-3 mb-sm-0"> <span class="text-black-50 text-uppercase">Waktu Melapor</span><br>
                <span
                    class="font-weight-500 text-3">{{ \Carbon\Carbon::parse($order->schedule->departure_time)->subMinutes(15)->translatedFormat('H:i') }}</span>
            </div>
            <div class="col-sm-3 mb-3 mb-sm-0"> <span class="text-black-50 text-uppercase">Waktu
                    Keberangkatan</span><br>
                <span
                    class="font-weight-500 text-3">{{ \Carbon\Carbon::parse($order->schedule->departure_time)->translatedFormat('H:i') }}</span>
            </div>
            <div class="col-sm-3 mb-3 mb-sm-0">
                <span class="text-black-50 text-uppercase">Status</span><br>
                @if ($order->status == 'pending')
                    <span class="font-weight-500 text-3">Menunggu</span>
                @elseif($order->status == 'booked')
                    <span class="font-weight-500 text-3">Dipesan</span>
                @elseif($order->status == 'rejected')
                    <span class="font-weight-500 text-3">Ditolak</span>
                @elseif($order->status == 'canceled')
                    <span class="font-weight-500 text-3">Dibatalkan</span>
                @elseif($order->status == 'completed')
                    <span class="font-weight-500 text-3">Selesai</span>
                @endif
            </div>
            <div class="col-sm-3">
                <span class="text-black-50 text-uppercase">ID Pemesanan</span><br>
                <span class="font-weight-500 text-3">{{ $order->code }}</span>
            </div>
        </div>
        <hr class="my-4">
        <div class="row">
            <div class="col-sm-4 mb-3 mb-sm-0">
                <span class="text-black-50 text-uppercase">Nama Penumpang</span>
                <br>
                <span class="font-weight-500 text-3">{{ Auth::guard('web')->user()->name }}</span>
            </div>
            <div class="col-sm-4 mb-3 mb-sm-0"> <span class="text-black-50 text-uppercase">Nomor Bangku :</span><br>
                @foreach ($order->orderDetails as $item)
                    <span class="font-weight-500 text-3">{{ $item->seat_id }}</span>
                @endforeach
            </div>
            <div class="col-sm-4 mb-3 mb-sm-0">
                <span class="text-black-50 text-uppercase">Travels</span><br>
                <span class="font-weight-500 text-3">Koperasi Bintang Laguboti</span>
            </div>

        </div>
        <hr class="my-3">
        <div class="card">
            <div class="card-header py-0">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <td class="border-0 font-weight-600" width="60%">Detail</td>
                            <td class="text-right border-0 font-weight-600" width="20%">Harga</td>
                            <td class="text-right border-0 font-weight-600" width="20%">Total</td>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td class="border-0" width="60%">Tiket</td>
                                <td class="text-right border-0" width="20%">Rp.
                                    {{ number_format($order->schedule->price, 0, ',', '.') }} x
                                    {{ $order->orderDetails->count() }}</td>
                                <td class="text-right border-0" width="20%">Rp.
                                    {{ number_format($order->schedule->price * $order->orderDetails->count(), 0, ',', '.') }}
                            </tr>
                            @if ($order->coupon)
                                <tr>

                                    <td>Kupon<br>

                                        <span class="text-black-50">{{ $order->coupon->name }}</span>

                                    </td>
                                    <td class="text-right">{{ $order->coupon->discount }}%</td>
                                    <td class="text-right">- Rp.
                                        {{ number_format(($order->coupon->discount * $order->schedule->price * $order->orderDetails->count()) / 100, 0, ',', '.') }}

                                </tr>
                            @endif
                            <tr>
                                <td colspan="2" class="bg-light-2 text-right"><strong>Total:</strong></td>
                                <td colspan="2" class="bg-light-2 text-right">Rp.
                                    {{ number_format($order->total, 0, ',', '.') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- button payment -->
        @if ($order->status == 'pending')
            <div class="text-center mt-4">
                <a href="{{ route('payment', $order->id) }}" class="btn btn-primary btn-rounded btn-lg">Bayar
                    Sekarang</a>
            </div>
        @endif

        <p class="text-center text-black-50">**Selalu bawa tiket ini dan tanda pengenal saat keberangkatan</p>
        <hr class="my-4">
        <p class="text-center">
            <strong>Koperasi Bintang Laguboti</strong>
        </p>
        <hr>
        <p class="text-center text-1"><strong>NOTE :</strong>
            Ini adalah tanda terima yang dihasilkan komputer dan tidak memerlukan tanda tangan fisik.
        </p>
    </div>
    <p class="text-center d-print-none"><a href="{{ route('order.index') }}">&laquo; Lihat Semua Pesanan</a></p>
</body>

</html>
