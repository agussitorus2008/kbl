<div class="car-list">
    @foreach ($collection as $item)
        <div class="car-item bg-white shadow-md rounded p-3">
            <div class="row">
                <div class="col-md-4">
                    <img class="img-fluid rounded align-top" src="" alt="cars">
                </div>
                <div class="col-md-8 mt-3 mt-md-0">
                    <div class="row no-gutters">
                        <div class="col-sm-12">
                            <h4 class="d-flex align-items-center">
                                <div class="text-dark text-5 mr-2">BUS</div>
                                <div class="text-dark text-4">
                                    BB1234BB
                                </div>
                            </h4>
                            <div class="row no-gutters mt-2">
                                @php
                                    $departure_time = date('H:i', strtotime($item->departure_time));
                                    $arrival_time = date('H:i', strtotime($item->arrival_time));
                                @endphp
                                <div class="col-6">
                                    <span class="text-success mr-1">Rute :</span>
                                    @if ($item->route_id == 'ML')
                                        <span class="text-dark">Medan - Laguboti</span>
                                    @elseif ($item->route_id == 'LM')
                                        <span class="text-dark">Laguboti - Medan</span>
                                    @elseif ($item->route_id == 'SL')
                                        <span class="text-dark">Sibolga - Laguboti</span>
                                    @elseif ($item->route_id == 'LS')
                                        <span class="text-dark">Laguboti - Sibolga</span>
                                    @endif
                                </div>
                                <div class="col-6">
                                    <span class="text-success mr-1">Tanggal :</span>
                                    <span class="text-dark">{{ $item->departure_time->format('d F Y') }}</span>
                                </div>
                                <div class="col-6">
                                    <span class="text-success mr-1">Waktu Keberangkatan :</span>
                                    <span class="text-dark">{{ $departure_time->format('H:i') }}</span>
                                </div>
                                <div class="col-6">
                                    <span class="text-success mr-1">Waktu Sampai :</span>
                                    <span class="text-dark">{{ $arrival_time->format('H:i') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="row no-gutters mt-2">
                            <div class="col-6">
                                <span class="text-success" style="font-size: 1.2rem;">Harga :</span>
                                <span class="text-dark" style="font-size: 1.2rem;">Rp.
                                    {{ number_format($item->price) }}</span>
                            </div>
                            <div class="col-6">
                                <span class="text-success mr-1" style="font-size: 1.2rem;">Jumlah Kursi :</span>
                                <span class="text-dark" style="font-size: 1.2rem;">{{ $item->available_seat }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mt-3 mr-5">
                        <div>
                            <a href="javascript:;" class="btn btn-sm btn-primary order-4">Detail</a>
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
            </div>
        </div>
    @endforeach
</div>
{{ $collection->links('components.pagination') }}
