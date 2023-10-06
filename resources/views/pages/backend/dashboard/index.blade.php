@extends('layouts.backend.master')
@section('title', 'Dashboard')
@section('page', 'Dashboard')
@section('breadcrumb')
    <!--begin::Breadcrumb-->
    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 pt-1">
        <!--begin::Item-->
        <li class="breadcrumb-item text-muted">Dashboards</li>
        <!--end::Item-->
    </ul>
    <!--end::Breadcrumb-->
@endsection
@section('content')
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container-xxl">
            <div class="row">
                <div class="col-lg-4 mb-6">
                    <div class="card card-custom card-stretch gutter-b">
                        <div class="card-header pt-5">
                            <div class="card-title d-flex flex-column">
                                <h3 class="font-weight-bolder text-dark font-size-h5">
                                    <span class="text-muted font-weight-bold mr-2">Total</span>
                                    <span class="text-dark">Pengguna</span>
                                </h3>
                            </div>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <div class="font-weight-bolder text-dark-75 font-size-h4 font-weight-bold mb-4">
                                {{ $totalUsers }} Pengguna
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-6">
                    <div class="card card-custom card-stretch gutter-b">
                        <!--begin::Header-->
                        <div class="card-header pt-5">
                            <!--begin::Title-->
                            <div class="card-title d-flex flex-column">
                                <h3 class="font-weight-bolder text-dark font-size-h5">
                                    <span class="text-muted font-weight-bold mr-2">Total</span>
                                    <span class="text-dark">Coupon</span>
                                </h3>
                            </div>
                            <!--end::Title-->
                        </div>
                        <div class="card-body d-flex flex-column">
                            <div class="font-weight-bolder text-dark-75 font-size-h4 font-weight-bold mb-4">
                                {{ $totalCoupons }} Kupon
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-6">
                    <div class="card card-custom card-stretch gutter-b">
                        <!--begin::Header-->
                        <div class="card-header pt-5">
                            <!--begin::Title-->
                            <div class="card-title d-flex flex-column">
                                <h3 class="font-weight-bolder text-dark font-size-h5">
                                    <span class="text-muted font-weight-bold mr-2">Total</span>
                                    <span class="text-dark">Pemesanan</span>
                                </h3>
                            </div>
                            <!--end::Title-->
                        </div>
                        <div class="card-body d-flex flex-column">
                            <div class="font-weight-bolder text-dark-75 font-size-h4 font-weight-bold mb-4">
                                {{ $totalOrders }} Pemesanan
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row g-5 g-xl-8">
                <div class="col-xl-6">
                    <!--begin::List Widget 7-->
                    <div class="card card-xl-stretch mb-xl-8">
                        <!--begin::Header-->
                        <form id="filter_schedules">
                            <div class="card-header border-0 pt-6">
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="fw-bolder text-dark">List Jadwal</span>
                                </h3>
                                <div class="card-title">
                                    <div class="d-flex align-items-center position-relative my-1">
                                        <span class="svg-icon svg-icon-1 position-absolute ms-6">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none">
                                                <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546"
                                                    height="2" rx="1" transform="rotate(45 17.0365 15.1223)"
                                                    fill="black" />
                                                <path
                                                    d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                                    fill="black" />
                                            </svg>
                                        </span>
                                        <input type="text" name="schedules"
                                            class="form-control form-control-solid w-250px ps-15"
                                            placeholder="Cari data pemesanan..." />
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="card-header align-items-center border-0 mt-4">
                            <div class="table-responsive">
                                <table class="table align-middle table-row-dashed fs-6 gy-5" id="schedules_table">
                                    <thead>
                                        <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                            <th class="min-w-50px">No</th>
                                            <th class="min-w-125px">Supir</th>
                                            <th class="min-w-125px">Rute</th>
                                            <th class="min-w-125px">Waktu Keberangkatan</th>
                                            <th class="min-w-125px">Harga</th>
                                        </tr>
                                    </thead>
                                    <tbody class="fw-bold text-gray-600">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card card-xl-stretch mb-xl-8">
                        <div class="card-header border-0 pt-6">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="fw-bolder text-dark">List Pemesanan</span>
                            </h3>
                            <div class="card-title">
                                <div class="d-flex align-items-center position-relative my-1 me-3">
                                    <span class="svg-icon svg-icon-1 position-absolute ms-6">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none">
                                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546"
                                                height="2" rx="1" transform="rotate(45 17.0365 15.1223)"
                                                fill="black" />
                                            <path
                                                d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                                fill="black" />
                                        </svg>
                                    </span>
                                    <input type="text" name="orders"
                                        class="form-control form-control-solid w-250px ps-15"
                                        placeholder="Cari data pemesanan..." />
                                </div>
                                <div class="d-flex justify-content-end">
                                    <select class="form-select form-select-solid" name="status">
                                        <option value="">Semua Status</option>
                                        <option value="Menunggu">Menunggu</option>
                                        <option value="Dipesan">Dipesan</option>
                                        <option value="Dibatalkan">Dibatalkan</option>
                                        <option value="Ditolak">Ditolak</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card-header align-items-center border-0 mt-4">
                            <div class="table-responsive">
                                <table class="table align-middle table-row-dashed fs-6 gy-5" id="orders_table">
                                    <thead>
                                        <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                            <th class="min-w-50px">No</th>
                                            <th class="min-w-120px">Nama Penumpang</th>
                                            <th class="min-w-120px">Kode Booking</th>
                                            <th class="min-w-120px">Waktu Keberangkatan</th>
                                            <th class="min-w-120px">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody class="fw-bold text-gray-600">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@section('custom_js')
    <script>
        $(document).ready(function() {
            $('#schedules_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('backend.schedules.index') }}",
                },
                columns: [{
                        data: 'DT_RowIndex',
                        defaultContent: '',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'driver_name',
                        name: 'driver_name',
                    },
                    {
                        data: 'route',
                        name: 'route'
                    },
                    {
                        data: 'departure_time',
                        name: 'departure_time'
                    },
                    {
                        data: 'price',
                        name: 'price'
                    },
                ],
            });

            $('#orders_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('backend.orders.index') }}",
                },
                columns: [{
                        data: 'DT_RowIndex',
                        defaultContent: '',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'code',
                        name: 'code'
                    },
                    {
                        data: 'departure_time',
                        name: 'departure_time'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    }
                ],
            });

            $('#schedules_table').on('order.dt search.dt', function() {
                $('#schedules_table').DataTable().column(0, {
                    search: 'applied',
                    order: 'applied'
                }).nodes().each(function(cell, i) {
                    cell.innerHTML = i + 1;
                });
            });

            $('#orders_table').on('order.dt search.dt', function() {
                $('#orders_table').DataTable().column(0, {
                    search: 'applied',
                    order: 'applied'
                }).nodes().each(function(cell, i) {
                    cell.innerHTML = i + 1;
                });
            });

            $('input[name="orders"]').on('keyup', function() {
                $('#orders_table').DataTable().search($(this).val()).draw();
            });

            $('select[name="status"]').on('change', function() {
                $('#orders_table').DataTable().columns(4).search($(this).val()).draw();
            });

            $('input[name="schedules"]').on('keyup', function() {
                $('#schedules_table').DataTable().search($(this).val()).draw();
            });

        });
    </script>
@endsection
@endsection
