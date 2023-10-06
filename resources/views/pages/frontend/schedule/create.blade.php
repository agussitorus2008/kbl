<div class="modal-header">
    <h5 class="modal-title">Detail Pemesanan</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div class="bus-details">
        <div class="row align-items-sm-center flex-row mb-12">
            <div class="col col-sm-4 text-center text-sm-left">
                <span class="text-3 text-dark operator-name">KBT Travels</span>
                <span class="text-muted d-block">{{ Str::upper($data->car->type) }}</span>
            </div>
            @php
                if ($data->route == 'ML') {
                    $from = 'Medan';
                    $to = 'Laguboti';
                } elseif ($data->route == 'LM') {
                    $from = 'Laguboti';
                    $to = 'Medan';
                } elseif ($data->route == 'SL') {
                    $from = 'Sibolga';
                    $to = 'Laguboti';
                } elseif ($data->route == 'LS') {
                    $from = 'Laguboti';
                    $to = 'Sibolga';
                }
            @endphp
            <div class="col col-sm-2 text-center time-info">
                <span
                    class="text-5 text-dark">{{ \Carbon\Carbon::parse($data->departure_time)->translatedFormat('H:i') }}
                    WIB</span>
                <small class="text-muted d-block">{{ $from }} </small>
            </div>
            <div class="col col-sm-2 text-8 text-black-50 text-center trip-arrow">➝</div>
            <div class="col col-sm-2 text-center time-info">
                <span class="text-5 text-dark">{{ \Carbon\Carbon::parse($data->arrival_time)->translatedFormat('H:i') }}
                    WIB</span>
                <small class="text-muted d-block">{{ $to }}</small>
            </div>
        </div>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item"> <a class="nav-link active" id="first-tab" data-toggle="tab" href="#first"
                    role="tab" aria-controls="first" aria-selected="true">Bangku Tersedia</a> </li>
        </ul>
        <div class="tab-content my-3" id="myTabContent">
            <div class="tab-pane fade show active" id="first" role="tabpanel" aria-labelledby="first-tab">
                <form id="form_checkout" action="{{ route('confirm') }}" method="POST">
                    @csrf
                    <input type="hidden" name="schedule_id" value="{{ $data->id }}">
                    <input type="hidden" name="seats[]" value="">
                    <div class="row">
                        <div class="col-12 col-lg-6 text-center">
                            <p class="text-muted text-1">Klik pada bangku yang ingin dipesan</p>
                            <div id="seat-map">
                            </div>
                            <div id="legend"></div>
                        </div>
                        <div class="col-12 col-lg-6 mt-3 mt-lg-0">
                            <div class="booking-details">
                                <h2 class="text-5">Detail Pesanan</h2>
                                <p>Bangku Dipilih (<span id="counter">0</span>):</p>
                                <ul id="selected-seats">
                                </ul>
                                <div class="d-flex bg-light-4 px-3 py-2 mb-3">Total :
                                    <span class="text-dark text-5 font-weight-600 ml-2">Rp. <span
                                            id="total">0</span></span>
                                </div>
                                <a href="javascript:;" onclick="confirm('#form_checkout')"
                                    class="btn btn-primary btn-block">Lanjutkan</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    var firstSeatLabel = 1;
    $.getJSON("{{ route('schedule.seats', $data->id) }}", function(data) {
        var $cart = $('#selected-seats'),
            $counter = $('#counter'),
            $total = $('#total'),
            $seats = [],
            sc = $('#seat-map').seatCharts({
                map: data.map,
                seats: {
                    e: {
                        price: data.price,
                    }
                },
                naming: {
                    top: false,
                    getLabel: function(character, row, column) {
                        return firstSeatLabel++;
                    },
                },
                legend: {
                    node: $('#legend'),
                    items: [
                        ['e', 'available', 'Belum Dipesan'],
                        ['e', 'unavailable', 'Sudah Dipesan']
                    ]
                },
                click: function() {
                    if (this.status() == 'available') {

                        $('<li>Seat # ' + this.settings.label + ': <b>Rp. ' + this.data().price +
                                '</b> <a href="#" class="cancel-cart-item text-danger text-4"><i class="far fa-times-circle"></i></a></li>'
                            )
                            .attr('id', 'cart-item-' + this.settings.id)
                            .data('seatNumber', this.settings.label)
                            .data('seatId', this.settings.id)
                            .appendTo($cart);

                        $counter.text(sc.find('selected').length + 1);
                        $total.text(recalculateTotal(sc) + this.data().price);
                        $seats.push(this.settings.label);
                        $('input[name="seats[]"]').val($seats);
                        return 'selected';
                    } else if (this.status() == 'selected') {

                        $counter.text(sc.find('selected').length - 1);

                        $total.text(recalculateTotal(sc) - this.data().price);

                        //remove the item from our cart
                        $('#cart-item-' + this.settings.id).remove();
                        //seat has been vacated
                        $seats.splice($.inArray(this.settings.label, $seats), 1);
                        $('input[name="seats[]"]').val($seats);
                        //seat has been vacated
                        return 'available';
                    } else if (this.status() == 'unavailable') {
                        //seat has been already booked
                        return 'unavailable';
                    } else {
                        return this.style();
                    }
                }
            });

        //this will handle "[cancel]" link clicks
        $('#selected-seats').on('click', '.cancel-cart-item', function() {
            //let's just trigger Click event on the appropriate seat, so we don't have to repeat the logic here
            sc.get($(this).parents('li:first').data('seatId')).click();

        });

        //let's pretend some seats have already been booked
        sc.get(data.selected).status('unavailable');
    });

    function recalculateTotal(sc) {
        var total = 0;

        //basically find every selected seat and sum its price
        sc.find('selected').each(function() {
            total += this.data().price;
        });

        return total;
    }

    function confirm(form) {
        var seats = $('input[name="seats[]"]').val();
        if (seats.length == 0) {
            toastr.error('Pilih bangku terlebih dahulu');
            return false;
        } else {
            $(form).submit();
        }
    }
</script>
