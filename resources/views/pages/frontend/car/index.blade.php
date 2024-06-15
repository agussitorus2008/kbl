@extends('layouts.frontend.master')
@section('title', 'Daftar Jadwal')
@section('content')
    <section class="page-header page-header-text-light bg-secondary">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1>List Jadwal</h1>
                </div>
                <div class="col-md-4">
                    <ul class="breadcrumb justify-content-start justify-content-md-end mb-0">
                        <li>Home</li>
                        <li class="active">List Mobil</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <div id="content_list">
        <section class="container">
            <div class="row">

                <!-- Side Panel
                                                              ============================================= -->
                <aside class="col-md-3">
                    <div class="bg-light shadow-md rounded p-3">
                        <h3 class="text-5">Filter</h3>
                        <div class="accordion accordion-alternate style-2" id="toggleAlternate">
                            <div class="card">
                                <div class="card-header" id="carType">
                                    <h5 class="mb-0"> <a href="#" class="collapse" data-toggle="collapse"
                                            data-target="#togglecarType" aria-expanded="true"
                                            aria-controls="togglecarType">Car Type</a> </h5>
                                </div>
                                <div id="togglecarType" class="collapse show" aria-labelledby="carType">
                                    <div class="card-body">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" id="bus" name="type"
                                                class="custom-control-input" value="bus">
                                            <label class="custom-control-label d-block" for="bus">Bus <small
                                                    class="text-muted float-right">{{ $bus }}</small></label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" id="minibus" name="type"
                                                class="custom-control-input" value="minibus">
                                            <label class="custom-control-label d-block" for="minibus">Minibus <small
                                                    class="text-muted float-right">{{ $minibus }}</small></label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" id="car" name="type"
                                                class="custom-control-input" value="car">
                                            <label class="custom-control-label d-block" for="car">Mobil <small
                                                    class="text-muted float-right">{{ $car }}</small></label>
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
        </section>
    </div>
@endsection
@push('scripts')
    @auth
        <x-chat />
    @endauth
    <script>
        load_list(1);
    </script>
@endpush
