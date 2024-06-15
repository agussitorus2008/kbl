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
            <div class="row g-5 g-xl-8">
                <!--begin::Col-->
                <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-4 mb-md-5 mb-xl-10">
                    <!--begin::Card widget 5-->
                    <div class="card card-flush h-md-100 mb-xl-10">
                        <!--begin::Header-->
                        <div class="card-header pt-5">
                            <!--begin::Title-->
                            <div class="card-title d-flex flex-column">
                                <!--begin::Info-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Amount-->
                                    <span class="fs-2hx fw-bold text-dark me-2 lh-1 ls-n2">{{ $ordersThisMonth }}</span>
                                    <!--end::Amount-->
                                    <!--begin::Badge-->
                                    @if ($orderPercentage > 0)
                                        <span class="badge badge-light-success fs-base">
                                            <i class="ki-duotone ki-arrow-up fs-5 text-success ms-n1">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>{{ number_format($orderPercentage, 2) }}%
                                        </span>
                                    @else
                                        <span class="badge badge-light-danger fs-base">
                                            <i class="ki-duotone ki-arrow-down fs-5 text-danger ms-n1">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>{{ number_format(abs($orderPercentage), 2) }}%
                                        </span>
                                    @endif
                                    <!--end::Badge-->
                                </div>
                                <!--end::Info-->
                                <!--begin::Subtitle-->
                                <span class="text-gray-400 pt-1 fw-semibold fs-6">Orders This Month</span>
                                <!--end::Subtitle-->
                            </div>
                            <!--end::Title-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Card body-->
                        <div class="card-body d-flex align-items-end pt-0">
                            <!--begin::Wrapper-->
                            <div class="d-flex align-items-center flex-wrap">
                                <!--begin::Chart-->
                                <div class="d-flex me-7 me-xxl-10">
                                    <div id="kt_card_widget_10_chart" class="min-h-auto" style="height: 78px; width: 78px"
                                        data-kt-size="78" data-kt-line="11"></div>
                                </div>
                                <!--end::Chart-->
                                <!--begin::Labels-->
                                <div class="d-flex flex-column content-justify-center flex-grow-1">
                                    <!--begin::Label-->
                                    <div class="d-flex fs-6 fw-semibold align-items-center">
                                        <!--begin::Bullet-->
                                        <div class="bullet w-8px h-6px rounded-2 bg-primary me-3"></div>
                                        <!--end::Bullet-->
                                        <!--begin::Label-->
                                        <div class="fs-6 fw-semibold text-gray-400 flex-shrink-0">Executive</div>
                                        <!--end::Label-->
                                        <!--begin::Separator-->
                                        <div class="separator separator-dashed min-w-10px flex-grow-1 mx-2"></div>
                                        <!--end::Separator-->
                                        <!--begin::Stats-->
                                        <div class="ms-auto fw-bolder text-gray-700 text-end">
                                            {{ number_format($executivePercentage, 2) }}%</div>
                                        <!--end::Stats-->

                                    </div>
                                    <!--end::Label-->
                                    <!--begin::Label-->
                                    <div class="d-flex fs-6 fw-semibold align-items-center my-1">
                                        <!--begin::Bullet-->
                                        <div class="bullet w-8px h-6px rounded-2 bg-secodary me-3">
                                        </div>
                                        <!--end::Bullet-->
                                        <!--begin::Label-->
                                        <div class="fs-6 fw-semibold text-gray-400 flex-shrink-0">Non-Executive
                                        </div>
                                        <!--end::Label-->
                                        <!--begin::Separator-->
                                        <div class="separator separator-dashed min-w-10px flex-grow-1 mx-2"></div>
                                        <!--end::Separator-->
                                        <!--begin::Stats-->
                                        <div class="ms-auto fw-bolder text-gray-700 text-end">
                                            {{ number_format($nonExecutivePercentage, 2) }}%
                                        </div>
                                        <!--end::Stats-->
                                    </div>
                                    <!--end::Label-->
                                </div>
                                <!--end::Labels-->
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card widget 5-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-4 mb-md-5 mb-xl-10">
                    <!--begin::Card widget 6-->
                    <div class="card card-flush h-md-100 mb-5 mb-xl-10">
                        <!--begin::Header-->
                        <div class="card-header pt-5">
                            <!--begin::Title-->
                            <div class="card-title d-flex flex-column">
                                <!--begin::Info-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Currency-->
                                    <span class="fs-4 fw-semibold text-gray-400 me-1 align-self-start">Rp.</span>
                                    <!--end::Currency-->
                                    <!--begin::Amount-->
                                    <span class="fs-2hx fw-bold text-dark me-2 lh-1 ls-n2">{{ $averageDailyOrders }}</span>
                                    <!--end::Amount-->
                                    <!--begin::Badge-->
                                    {{-- jika ada kenaikan order dari kemarin --}}
                                    @if ($averageDailyOrdersPercentage > 0)
                                        <span class="badge badge-light-success fs-base">
                                            <i class="ki-duotone ki-arrow-up fs-5 text-success ms-n1">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>{{ number_format($averageDailyOrdersPercentage, 2) }}%
                                        </span>
                                    @else
                                        <span class="badge badge-light-danger fs-base">
                                            <i class="ki-duotone ki-arrow-down fs-5 text-danger ms-n1">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>{{ number_format(abs($averageDailyOrdersPercentage), 2) }}%
                                        </span>
                                    @endif
                                    <!--end::Badge-->
                                </div>
                                <!--end::Info-->
                                <!--begin::Subtitle-->
                                <span class="text-gray-400 pt-1 fw-semibold fs-6">Average Daily Orders</span>
                                <!--end::Subtitle-->
                            </div>
                            <!--end::Title-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Card body-->
                        <div class="card-body d-flex align-items-end px-0 pb-0">
                            <!--begin::Chart-->
                            <div id="averageDailyOrderChart" class="w-100" style="height: 80px"></div>
                            <!--end::Chart-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card widget 6-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-4 mb-md-5 mb-xl-10">
                    <!--begin::Card widget 6-->
                    <!--begin::Card widget 7-->
                    <div class="card card-flush h-md-100 mb-xl-10">
                        <!--begin::Header-->
                        <div class="card-header pt-5">
                            <!--begin::Title-->
                            <div class="card-title d-flex flex-column">
                                <!--begin::Amount-->
                                <span class="fs-2hx fw-bold text-dark me-2 lh-1 ls-n2">{{ $customerThisMonth }}</span>
                                <!--end::Amount-->
                                <!--begin::Subtitle-->
                                <span class="text-gray-400 pt-1 fw-semibold fs-6">New Customers This Month</span>
                                <!--end::Subtitle-->
                            </div>
                            <!--end::Title-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Card body-->
                        <div class="card-body d-flex flex-column justify-content-end pe-0">
                            <!--begin::Title-->
                            <div class="card-title d-flex flex-column">
                                <!--begin::Amount-->
                                <span class="fs-2hx fw-bold text-dark me-2 lh-1 ls-n2">{{ $customerToday }}</span>
                                <!--end::Amount-->
                                <!--begin::Subtitle-->
                                <span class="text-gray-400 pt-1 fw-semibold fs-6">New Customers Today</span>
                                <!--end::Subtitle-->
                            </div>
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card widget 7-->
                    <!--end::Card widget 6-->
                </div>
                <!--end::Col-->
            </div>
            <div class="row g-5 g-xl-8">
                <!--begin::Col-->
                <div class="col-md-6 col-lg-6 col-xl-6 mb-md-5 mb-xl-10">
                    <!--begin::Chart widget 3-->
                    <div class="card card-flush overflow-hidden h-md-100">
                        <!--begin::Header-->
                        <div class="card-header py-5">
                            <!--begin::Title-->
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-dark">Orders This Months</span>
                                <span class="text-gray-400 mt-1 fw-semibold fs-6"></span>
                            </h3>
                            <!--end::Title-->
                            <!--begin::Toolbar-->
                            <div class="card-toolbar">
                                <!--begin::Menu-->
                                <button class="btn btn-icon btn-color-gray-400 btn-active-color-primary justify-content-end"
                                    data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end"
                                    data-kt-menu-overflow="true">
                                    <i class="ki-duotone ki-dots-square fs-1">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                    </i>
                                </button>
                                <!--end::Menu-->
                            </div>
                            <!--end::Toolbar-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Card body-->
                        <div class="card-body d-flex justify-content-between flex-column pb-1 px-0">
                            <!--begin::Statistics-->
                            <div class="px-9 mb-5">
                                <!--begin::Statistics-->
                                <div class="d-flex mb-2">
                                    <span class="fs-4 fw-semibold text-gray-400 me-1">Rp. </span>
                                    <span
                                        class="fs-2hx fw-bold text-gray-800 me-2 lh-1 ls-n2">{{ number_format($totalAmount, 0, ',', '.') }}</span>
                                </div>
                                <!--end::Statistics-->
                            </div>
                            <!--end::Statistics-->
                            <!--begin::Chart-->
                            <div id="kt_charts_widget_3" class="min-h-auto ps-4 pe-6" style="height: 300px"></div>
                            <!--end::Chart-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Chart widget 3-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-md-6 col-lg-6 col-xl-6 mb-md-5 mb-xl-10">
                    <!--begin::Chart widget 10-->
                    <div class="card card-flush h-xxl-100">
                        <!--begin::Header-->
                        <div class="card-header pt-7">
                            <!--begin::Title-->
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-gray-800">Orders This Month</span>
                                <span class="text-gray-400 mt-1 fw-semibold fs-6">{{ $totalOrders }} Total Orders</span>
                            </h3>
                            <!--end::Title-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body d-flex flex-column justify-content-between pb-5 px-0">
                            <!--begin::Nav-->
                            <ul class="nav nav-pills nav-pills-custom mb-3 mx-9">
                                <!--begin::Item-->
                                <li class="nav-item mb-3 me-3 me-lg-6">
                                    <!--begin::Link-->
                                    <a class="nav-link btn btn-outline btn-flex btn-active-color-primary flex-column overflow-hidden w-80px h-85px pt-5 pb-2"
                                        data-bs-toggle="pill" id="kt_charts_widget_10_tab_1"
                                        href="#kt_charts_widget_10_tab_content_1">
                                        <!--begin::Icon-->
                                        <div class="nav-icon mb-3">
                                            <i class="ki-duotone ki-truck fs-1 p-0">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                                <span class="path4"></span>
                                                <span class="path5"></span>
                                            </i>
                                        </div>
                                        <!--end::Icon-->
                                        <!--begin::Title-->
                                        <span class="nav-text text-gray-800 fw-bold fs-6 lh-1">Executive</span>
                                        <!--end::Title-->
                                        <!--begin::Bullet-->
                                        <span
                                            class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                        <!--end::Bullet-->
                                    </a>
                                    <!--end::Link-->
                                </li>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <li class="nav-item mb-3 me-3 me-lg-6">
                                    <!--begin::Link-->
                                    <a class="nav-link btn btn-outline btn-flex btn-active-color-primary flex-column overflow-hidden w-80px h-85px pt-5 pb-2"
                                        data-bs-toggle="pill" id="kt_charts_widget_10_tab_1"
                                        href="#kt_charts_widget_10_tab_content_2">
                                        <!--begin::Icon-->
                                        <div class="nav-icon mb-3">
                                            <i class="ki-duotone ki-bus fs-1 p-0">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                                <span class="path4"></span>
                                                <span class="path5"></span>
                                            </i>
                                        </div>
                                        <!--end::Icon-->
                                        <!--begin::Title-->
                                        <span class="nav-text text-gray-800 fw-bold fs-6 lh-1">Non-Executive</span>
                                        <!--end::Title-->
                                        <!--begin::Bullet-->
                                        <span
                                            class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                        <!--end::Bullet-->
                                    </a>
                                    <!--end::Link-->
                                </li>
                                <!--end::Item-->
                            </ul>
                            <!--end::Nav-->
                            <!--begin::Tab Content-->
                            <div class="tab-content ps-4 pe-6">
                                <!--begin::Tap pane-->
                                <div class="tab-pane fade active show" id="kt_charts_widget_10_tab_content_1">
                                    <!--begin::Chart-->
                                    <div id="kt_charts_widget_10_chart_1" class="min-h-auto"
                                        style="height: 270px;overflow: auto;"></div>
                                    <!--end::Chart-->
                                </div>
                                <!--end::Tap pane-->
                                <!--begin::Tap pane-->
                                <div class="tab-pane fade" id="kt_charts_widget_10_tab_content_2">
                                    <!--begin::Chart-->
                                    <div id="kt_charts_widget_10_chart_2" class="min-h-auto"
                                        style="height: 270px;overflow: auto;"></div>
                                    <!--end::Chart-->
                                </div>
                                <!--end::Tap pane-->
                            </div>
                            <!--end::Tab Content-->
                        </div>
                        <!--end: Card Body-->
                    </div>
                    <!--end::Chart widget 10-->
                </div>
                <!--end::Col-->
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
                                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2"
                                                rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
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
@endsection
@push('scripts')
    <script>
        // get name of this month
        var thisMonth = new Date().toLocaleString('default', {
            month: 'long'
        });
        var KTCardsWidget6 = {
            init: function() {
                ! function() {
                    var e = document.getElementById("averageDailyOrderChart");
                    if (e) {
                        var t = parseInt(KTUtil.css(e, "height")),
                            a = KTUtil.getCssVariableValue("--bs-gray-500"),
                            l = KTUtil.getCssVariableValue("--bs-border-dashed-color"),
                            r = KTUtil.getCssVariableValue("--bs-primary"),
                            o = KTUtil.getCssVariableValue("--bs-gray-300"),
                            i = new ApexCharts(e, {
                                series: [{
                                    name: "Sales",
                                    data: @json($ordersSevenDays)
                                }],
                                chart: {
                                    fontFamily: "inherit",
                                    type: "bar",
                                    height: t,
                                    toolbar: {
                                        show: !1
                                    },
                                    sparkline: {
                                        enabled: !0
                                    }
                                },
                                plotOptions: {
                                    bar: {
                                        horizontal: !1,
                                        columnWidth: ["55%"],
                                        borderRadius: 6
                                    }
                                },
                                legend: {
                                    show: !1
                                },
                                dataLabels: {
                                    enabled: !1
                                },
                                stroke: {
                                    show: !0,
                                    width: 9,
                                    colors: ["transparent"]
                                },
                                xaxis: {
                                    axisBorder: {
                                        show: !1
                                    },
                                    axisTicks: {
                                        show: !1,
                                        tickPlacement: "between"
                                    },
                                    labels: {
                                        show: !1,
                                        style: {
                                            colors: a,
                                            fontSize: "12px"
                                        }
                                    },
                                    crosshairs: {
                                        show: !1
                                    }
                                },
                                yaxis: {
                                    labels: {
                                        show: !1,
                                        style: {
                                            colors: a,
                                            fontSize: "12px"
                                        }
                                    }
                                },
                                fill: {
                                    type: "solid"
                                },
                                states: {
                                    normal: {
                                        filter: {
                                            type: "none",
                                            value: 0
                                        }
                                    },
                                    hover: {
                                        filter: {
                                            type: "none",
                                            value: 0
                                        }
                                    },
                                    active: {
                                        allowMultipleDataPointsSelection: !1,
                                        filter: {
                                            type: "none",
                                            value: 0
                                        }
                                    }
                                },
                                tooltip: {
                                    style: {
                                        fontSize: "12px"
                                    },
                                    x: {
                                        formatter: function(e) {
                                            return thisMonth + " " + e + "th"
                                        }
                                    },
                                    y: {
                                        formatter: function(e) {
                                            return e + "%"
                                        }
                                    }
                                },
                                colors: [r, o],
                                grid: {
                                    padding: {
                                        left: 10,
                                        right: 10
                                    },
                                    borderColor: l,
                                    strokeDashArray: 4,
                                    yaxis: {
                                        lines: {
                                            show: !0
                                        }
                                    }
                                }
                            });
                        setTimeout((function() {
                            i.render()
                        }), 300)
                    }
                }()
            }
        };
        "undefined" != typeof module && (module.exports = KTCardsWidget6), KTUtil.onDOMContentLoaded((function() {
            KTCardsWidget6.init()
        }));

        var KTChartsWidget3 = function() {
            var e = {
                    self: null,
                    rendered: !1
                },
                t = function(e) {
                    var t = document.getElementById("kt_charts_widget_3");
                    if (t) {
                        var a = parseInt(KTUtil.css(t, "height")),
                            l = KTUtil.getCssVariableValue("--bs-gray-500"),
                            r = KTUtil.getCssVariableValue("--bs-border-dashed-color"),
                            o = KTUtil.getCssVariableValue("--bs-success"),
                            i = {
                                series: [{
                                    name: "Sales",
                                    data: @json($data)
                                }],
                                chart: {
                                    fontFamily: "inherit",
                                    type: "area",
                                    height: a,
                                    toolbar: {
                                        show: !1
                                    }
                                },
                                plotOptions: {},
                                legend: {
                                    show: !1
                                },
                                dataLabels: {
                                    enabled: !1
                                },
                                fill: {
                                    type: "gradient",
                                    gradient: {
                                        shadeIntensity: 1,
                                        opacityFrom: .4,
                                        opacityTo: 0,
                                        stops: [0, 80, 100]
                                    }
                                },
                                stroke: {
                                    curve: "smooth",
                                    show: !0,
                                    width: 3,
                                    colors: [o]
                                },
                                xaxis: {
                                    categories: @json($categories),
                                    tickAmount: 7,
                                    axisBorder: {
                                        show: !1
                                    },
                                    axisTicks: {
                                        show: !1
                                    },
                                    tickAmount: 6,
                                    labels: {
                                        rotate: 0,
                                        rotateAlways: !0,
                                        style: {
                                            colors: l,
                                            fontSize: "12px"
                                        }
                                    },
                                    crosshairs: {
                                        position: "front",
                                        stroke: {
                                            color: o,
                                            width: 1,
                                            dashArray: 3
                                        }
                                    },
                                    tooltip: {
                                        enabled: !0,
                                        formatter: void 0,
                                        offsetY: 0,
                                        style: {
                                            fontSize: "12px"
                                        }
                                    }
                                },
                                yaxis: {
                                    tickAmount: 4,
                                    max: @json($max),
                                    min: @json($min),
                                    labels: {
                                        style: {
                                            colors: l,
                                            fontSize: "12px"
                                        },
                                        formatter: function(e) {
                                            return "Rp. " + e + "K"
                                        }
                                    }
                                },
                                states: {
                                    normal: {
                                        filter: {
                                            type: "none",
                                            value: 0
                                        }
                                    },
                                    hover: {
                                        filter: {
                                            type: "none",
                                            value: 0
                                        }
                                    },
                                    active: {
                                        allowMultipleDataPointsSelection: !1,
                                        filter: {
                                            type: "none",
                                            value: 0
                                        }
                                    }
                                },
                                tooltip: {
                                    style: {
                                        fontSize: "12px"
                                    },
                                    y: {
                                        formatter: function(e) {
                                            return "Rp. " + e + "K"
                                        }
                                    }
                                },
                                colors: [KTUtil.getCssVariableValue("--bs-success")],
                                grid: {
                                    borderColor: r,
                                    strokeDashArray: 4,
                                    yaxis: {
                                        lines: {
                                            show: !0
                                        }
                                    }
                                },
                                markers: {
                                    strokeColor: o,
                                    strokeWidth: 3
                                }
                            };
                        e.self = new ApexCharts(t, i), setTimeout((function() {
                            e.self.render(), e.rendered = !0
                        }), 200)
                    }
                };
            return {
                init: function() {
                    t(e), KTThemeMode.on("kt.thememode.change", (function() {
                        e.rendered && e.self.destroy(), t(e)
                    }))
                }
            }
        }();
        "undefined" != typeof module && (module.exports = KTChartsWidget3), KTUtil.onDOMContentLoaded((function() {
            KTChartsWidget3.init()
        }));

        var KTCardsWidget10 = {
            init: function() {
                ! function() {
                    var e = document.getElementById("kt_card_widget_10_chart");
                    if (e) {
                        var t = {
                            size: e.getAttribute("data-kt-size") ? parseInt(e.getAttribute("data-kt-size")) :
                                70,
                            lineWidth: e.getAttribute("data-kt-line") ? parseInt(e.getAttribute(
                                "data-kt-line")) : 11,
                            rotate: e.getAttribute("data-kt-rotate") ? parseInt(e.getAttribute(
                                "data-kt-rotate")) : 145
                        };
                        var a = document.createElement("canvas");
                        var l = document.createElement("span");
                        "undefined" != typeof G_vmlCanvasManager && G_vmlCanvasManager.initElement(a);
                        var r = a.getContext("2d");
                        a.width = a.height = t.size;
                        e.appendChild(l);
                        e.appendChild(a);
                        r.translate(t.size / 2, t.size / 2);
                        r.rotate((t.rotate / 180 - .5) * Math.PI);
                        var o = (t.size - t.lineWidth) / 2;
                        var i = function(e, t, a) {
                            a = Math.min(Math.max(0, a || 1), 1);
                            r.beginPath();
                            r.arc(0, 0, o, 0, 2 * Math.PI * a, !1);
                            r.strokeStyle = e;
                            r.lineCap = "round";
                            r.lineWidth = t;
                            r.stroke();
                        };

                        // Misalnya, Anda dapat mengganti ini dengan data dari Laravel
                        var data = @json($percentages);
                        i(KTUtil.getCssVariableValue("--bs-secondary"), t.lineWidth, 100 / 100);
                        i(KTUtil.getCssVariableValue("--bs-primary"), t.lineWidth, data[1] / 100);
                    }
                }()
            }
        };


        "undefined" != typeof module && (module.exports = KTCardsWidget10), KTUtil.onDOMContentLoaded((function() {
            KTCardsWidget10.init()
        }));

        var KTChartsWidget10 = function() {
            var chart1 = {
                self: null,
                rendered: false
            };

            var chart2 = {
                self: null,
                rendered: false
            };

            var initializeChart = function(chart, chartId, data, categories, render) {
                var element = document.querySelector(chartId);
                if (element) {
                    var height = parseInt(KTUtil.css(element, "height"));
                    var grayColor = KTUtil.getCssVariableValue("--bs-gray-900");
                    var borderColor = KTUtil.getCssVariableValue("--bs-border-dashed-color");

                    var chartOptions = {
                        series: [{
                            name: "Orders",
                            data: data
                        }],
                        chart: {
                            fontFamily: "inherit",
                            type: "bar",
                            height: height,
                            toolbar: {
                                show: false
                            },
                            width: data.length * 100,
                            zoom: {
                                enabled: true,
                                type: "x",
                                autoScaleYaxis: true
                            }
                        },
                        plotOptions: {
                            bar: {
                                horizontal: false,
                                columnWidth: ["22%"],
                                borderRadius: 5,
                                dataLabels: {
                                    position: "top"
                                },
                                startingShape: "flat"
                            }
                        },
                        legend: {
                            show: false
                        },
                        dataLabels: {
                            enabled: true,
                            offsetY: -30,
                            style: {
                                fontSize: "13px",
                                colors: [grayColor]
                            },
                            formatter: function(e) {
                                return e
                            }
                        },
                        stroke: {
                            show: true,
                            width: 2,
                            colors: ["transparent"]
                        },
                        xaxis: {
                            categories: categories,
                            axisBorder: {
                                show: false
                            },
                            axisTicks: {
                                show: false
                            },
                            labels: {
                                style: {
                                    colors: KTUtil.getCssVariableValue("--bs-gray-500"),
                                    fontSize: "13px"
                                }
                            },
                            crosshairs: {
                                fill: {
                                    gradient: {
                                        opacityFrom: 0,
                                        opacityTo: 0
                                    }
                                }
                            }
                        },
                        yaxis: {
                            labels: {
                                style: {
                                    colors: KTUtil.getCssVariableValue("--bs-gray-500"),
                                    fontSize: "13px"
                                },
                                formatter: function(e) {
                                    return parseInt(e)
                                }
                            }
                        },
                        fill: {
                            opacity: 1
                        },
                        states: {
                            normal: {
                                filter: {
                                    type: "none",
                                    value: 0
                                }
                            },
                            hover: {
                                filter: {
                                    type: "none",
                                    value: 0
                                }
                            },
                            active: {
                                allowMultipleDataPointsSelection: false,
                                filter: {
                                    type: "none",
                                    value: 0
                                }
                            }
                        },
                        tooltip: {
                            style: {
                                fontSize: "12px"
                            },
                            y: {
                                formatter: function(e) {
                                    return +e + "K"
                                }
                            }
                        },
                        colors: [KTUtil.getCssVariableValue("--bs-primary"), KTUtil.getCssVariableValue(
                            "--bs-primary-light")],
                        grid: {
                            borderColor: borderColor,
                            strokeDashArray: 4,
                            yaxis: {
                                lines: {
                                    show: true
                                }
                            }
                        },
                    };

                    chart.self = new ApexCharts(element, chartOptions);

                    if (render) {
                        setTimeout(function() {
                            chart.self.render();
                            chart.rendered = true;
                        }, 200);
                    }
                }
            };

            return {
                init: function(data1, categories1, data2, categories2) {
                    initializeChart(chart1, "#kt_charts_widget_10_chart_1", @json($executiveData),
                        @json($executiveLabels), true);
                    initializeChart(chart2,
                        "#kt_charts_widget_10_chart_2", @json($nonExecutiveData),
                        @json($nonExecutiveLabels), true);
                }
            }
        }();

        "undefined" != typeof module && (module.exports = KTChartsWidget10),
            KTUtil.onDOMContentLoaded((function() {
                KTChartsWidget10.init()
            }));
    </script>

    <script>
        $(document).ready(function() {
            $('#schedules_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin.schedule.index') }}",
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
                    url: "{{ route('admin.order.index') }}",
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
@endpush
