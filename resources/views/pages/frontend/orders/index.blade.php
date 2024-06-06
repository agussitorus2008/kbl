@extends('layouts.frontend.master')
@section('title', 'Riwayat Pemesanan')
@section('content')
    <section class="page-header page-header-dark bg-secondary">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1>Riwayat Pemesanan Anda</h1>
                </div>
                <div class="col-md-4">
                    <ul class="breadcrumb justify-content-start justify-content-md-end mb-0">
                        <li><a href="index.html">Home</a></li>
                        <li class="active">Riyawat Pemesanan Anda</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <div id="content">
        <div class="container">
            <form id="content_filter">
                <div class="row">
                    <div class="col-md-12 mb-2">
                        <div class="row">
                            <div class="col-md-4 col-lg-4 form-group">
                                <label for="">Status</label>
                                <select id="status" class="form-control" name="status" onclick="load_list(1)">
                                    <option value="">All</option>
                                    <option value="pending">Pending</option>
                                    <option value="booked">Booked</option>
                                    <option value="canceled">Canceled</option>
                                    <option value="rejected">Rejected</option>
                                </select>
                            </div>
                            <div class="col-md-4 col-lg-4 form-group">
                                <label for="">Rute</label>
                                <select id="route" class="form-control" name="route" onclick="load_list(1)">
                                    <option value="">All</option>
                                    <option value="ML">Medan - Laguboti</option>
                                    <option value="LM">Laguboti - Medan</option>
                                    <option value="LS">Laguboti - Sibolga</option>
                                    <option value="SL">Sibolga - Laguboti</option>
                                </select>
                            </div>
                            <div class="col-md-4 col-lg-4 form-group">
                                <label for="">Data Pemesanan</label>
                                <input type="text" class="form-control" id="keyword" name="keyword"
                                    placeholder="Cari Data Pemesanan" onkeyup="load_list(1)">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="bg-light shadow-md rounded p-4">
                <div class="table-responsive-md" id="list_result">

                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <x-chat />
    <script>
        load_list(1);
    </script>
@endpush
