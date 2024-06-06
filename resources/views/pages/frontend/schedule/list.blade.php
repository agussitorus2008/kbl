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
                <div class="col-md-6">
                    <div class="card shadow-sm border-0 mb-4">
                        <a class="px-3" href="{{ route('schedule.show', $item->id) }}">
                            <img class="img-fluid rounded align-top"
                                src="{{ asset('images/cars/' . $item->car->image) }}" alt="drivers">
                            <div class="card-body">
                                <h4 class="d-flex align-items-center"><a href="#"
                                        class="text-dark text-4 mr-2"></a>
                                </h4>
                                <ul class="list-unstyled">
                                    <li>
                                        <span class="fw-600 mr-1">Rute :</span>
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
                                        <span class="fw-600 mr-1">Tanggal :</span>
                                        <span
                                            class="text-dark">{{ \Carbon\Carbon::parse($item->departure_time)->translatedFormat('l, d F Y') }}</span>
                                    </li>
                                    <li>
                                        <span class="fw-600 mr-1">Jam Berangkat :</span>
                                        <span
                                            class="text-dark">{{ \Carbon\Carbon::parse($item->departure_time)->translatedFormat('H:i') }}
                                            WIB</span>
                                    </li>
                                    <li>
                                        <span class="fw-600 mr-1">Jam Sampai :</span>
                                        <span
                                            class="text-dark">{{ \Carbon\Carbon::parse($item->arrival_time)->translatedFormat('H:i') }}
                                            WIB</span>
                                    </li>
                                    <li>
                                        <span class="fw-600 mr-1">Bangku Tersedia :</span>
                                        <span class="text-dark">{{ $item->available_seats }}</span>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-footer bg-transparent d-flex align-items-center p-3">
                                <div class="text-dark text-7 fw-500 me-2 me-lg-3">Rp.
                                    {{ number_format($item->price) }}
                                </div>
                                @auth
                                    <a href="javascript:;"
                                        onclick="handle_open_modal('{{ route('schedule.input', $item->id) }}','#modalListResult','#contentListResult');"
                                        class="btn btn-sm btn-primary ms-auto">
                                        <i class="fas fa-ellipsis-h d-none d-sm-block d-lg-none" data-toggle="tooltip"
                                            title="" data-original-title="Select Seats"></i>
                                        <span class="d-block d-sm-none d-lg-block">Pilih Kursi</span>
                                    </a>
                                @endauth
                            </div>
                        </a>
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
