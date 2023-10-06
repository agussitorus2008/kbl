@if ($collection->count() > 0)
    <div class="mx-3 mb-3 text-center">
        @if ($route == 'ML')
            <h2 class="text-6 mb-4">Medan <small class="mx-2">-</small>Laguboti</h2>
        @elseif($route == 'LM')
            <h2 class="text-6 mb-4">Laguboti <small class="mx-2">-</small>Medan</h2>
        @elseif($route == 'SL')
            <h2 class="text-6 mb-4">Sibolga <small class="mx-2">-</small>Laguboti</h2>
        @elseif($route == 'LS')
            <h2 class="text-6 mb-4">Laguboti <small class="mx-2">-</small>Sibolga</h2>
        @endif
    </div>
    <div class="car-list">
        <div class="row">
            @foreach ($collection as $item)
                <div class="col-sm-6 col-md-4">
                    <div class="card shadow-sm border-0 mb-4">
                        <a class="px-3" href="#">
                            <img class="img-fluid rounded align-top pt-2"
                                src="{{ asset('images/cars/' . $item->car->image) }}" alt="drivers"></a>
                        <div class="card-body">
                            <h4 class="d-flex align-items-center"><a href="#" class="text-dark text-4 mr-2"></a>
                            </h4>
                            <ul class="list-unstyled">
                                <li>
                                    <span class="text-success mr-1">Rute :</span>
                                    @if ($item->route == 'ML')
                                        <span class="text-dark">Medan - Laguboti</span>
                                    @elseif ($item->route == 'LM')
                                        <span class="text-dark">Laguboti - Medan</span>
                                    @elseif ($item->route == 'SL')
                                        <span class="text-dark">Sibolga - Laguboti</span>
                                    @elseif ($item->route == 'LS')
                                        <span class="text-dark">Laguboti - Sibolga</span>
                                    @endif
                                </li>
                                <li>
                                    <span class="text-success mr-1">Tanggal :</span>
                                    <span
                                        class="text-dark">{{ \Carbon\Carbon::parse($item->departure_time)->translatedFormat('l, d F Y') }}</span>
                                </li>
                                <li>
                                    <span class="text-success mr-1">Jam Berangkat :</span>
                                    <span
                                        class="text-dark">{{ \Carbon\Carbon::parse($item->departure_time)->translatedFormat('H:i') }}
                                        WIB</span>
                                </li>
                                <li>
                                    <span class="text-success mr-1">Jam Sampai :</span>
                                    <span
                                        class="text-dark">{{ \Carbon\Carbon::parse($item->arrival_time)->translatedFormat('H:i') }}
                                        WIB</span>
                                </li>
                                <li>
                                    <span class="text-success mr-1">Harga :</span>
                                    <span class="text-dark">Rp. {{ number_format($item->price) }}</span>
                                </li>
                                <li>
                                    <span class="text-success mr-1">Bangku Tersedia :</span>
                                    <span class="text-dark">{{ $item->available_seats }}</span>
                                </li>
                            </ul>
                        </div>
                        <div class="card-footer bg-transparent d-flex justify-content-between">
                            <a href="javascript:;" onclick="load_detail('{{ route('schedule.show', $item->id) }}')"
                                class="btn btn-sm btn-primary order-4">Detail</a>
                            @auth
                                <a href="javascript:;"
                                    onclick="handle_open_modal('{{ route('schedule.input', $item->id) }}','#modalListResult','#contentListResult');"
                                    class="btn btn-sm btn-outline-primary shadow-none">
                                    <i class="fas fa-ellipsis-h d-none d-sm-block d-lg-none" data-toggle="tooltip"
                                        title="" data-original-title="Select Seats"></i>
                                    <span class="d-block d-sm-none d-lg-block">Pilih Kursi</span>
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    {{ $collection->links('components.pagination') }}
@else
    <div class="mx-3 mb-3 text-center">
        <h2 class="text-6 mb-4">Jadwal tidak ditemukan</h2>
    </div>
@endif
