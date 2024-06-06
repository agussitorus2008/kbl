@extends('layouts.backend.master')
@section('title', 'Add Schedule')
@section('page', 'Add Schedule')
@section('breadcrumb')
    <!--begin::Breadcrumb-->
    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 pt-1">
        <!--begin::Item-->
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('backend.dashboard') }}" class="text-muted text-hover-primary">
                Home </a>
        </li>
        <!--end::Item-->
        <!--begin::Item-->
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-300 w-5px h-2px"></span>
        </li>
        <!--end::Item-->

        <!--begin::Item-->
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('backend.schedules.index') }}" class="text-muted text-hover-primary">Schedules</a>
        </li>
        <!--end::Item-->
        <!--begin::Item-->
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-300 w-5px h-2px"></span>
        </li>
        <!--end::Item-->

        <!--begin::Item-->
        <li class="breadcrumb-item text-dark">
            Add Schedule
        </li>
        <!--end::Item-->
    </ul>
    <!--end::Breadcrumb-->
@endsection
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Post-->
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div id="kt_content_container" class="container-xxl">
                <form id="form_input" class="form d-flex flex-column flex-lg-row"
                    data-kt-redirect="{{ route('backend.schedules.index') }}"
                    action="{{ route('backend.schedules.store') }}" method="POST">
                    <!--begin::Main column-->
                    <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                        <!--begin::General options-->
                        <div class="card card-flush py-4">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>General</h2>
                                </div>
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body pt-0">
                                <!--begin::Input group-->
                                <div class="mb-5 fv-row fv-plugins-icon-container">
                                    <!--begin::Label-->
                                    <label class="required form-label">Route</label>
                                    <!--end::Label-->
                                    <!--begin::Select-->
                                    <select name="route" class="form-select form-select-solid" data-control="select2"
                                        data-placeholder="Select option">
                                        <option SELECTED DISABLED>Choose Route</option>
                                        <option value="ML">Medan - Laguboti
                                        </option>
                                        <option value="LM">Laguboti - Medan
                                        </option>
                                        <option value="LS">Laguboti - Sibolga
                                        </option>
                                        <option value="SL">Sibolga - Laguboti
                                        </option>
                                    </select>
                                    <!--end::Select-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Choose the route that will be used to identify this
                                        schedule.
                                    </div>
                                    <!--end::Description-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="mb-5 fv-row fv-plugins-icon-container">
                                    <!--begin::Label-->
                                    <label class="required form-label">Driver</label>
                                    <!--end::Label-->
                                    <!--begin::Select-->
                                    <select data-control="select2" data-placeholder="Pilih Supir" id="car_id"
                                        name="car_id" class="form-select form-select-solid">
                                        <option SELECTED DISABLED>Driver</option>
                                        @foreach ($cars as $item)
                                            <option value="{{ $item->id }}">
                                                {{ $item->driver->name }}</option>
                                        @endforeach
                                    </select>
                                    <!--end::Select-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Choose the driver that will be used to identify this
                                        schedule.
                                    </div>
                                    <!--end::Description-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="mb-5 fv-row fv-plugins-icon-container">
                                    <!--begin::Label-->
                                    <label class="required form-label">Depature Time</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" name="departure_time" class="form-control form-control-solid"
                                        placeholder="Enter departure time" />
                                    <!--end::Input-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Set the departure time that will be used to identify this
                                        schedule.
                                    </div>
                                    <!--end::Description-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="mb-5 fv-row fv-plugins-icon-container">
                                    <!--begin::Label-->
                                    <label class="required form-label">Arrival Time</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" name="arrival_time" class="form-control form-control-solid"
                                        placeholder="Enter arrival time" />
                                    <!--end::Input-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Set the arrival time that will be used to identify this
                                        schedule.
                                    </div>
                                    <!--end::Description-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="mb-5 fv-row fv-plugins-icon-container">
                                    <!--begin::Label-->
                                    <label class="required form-label">Price</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" name="price" class="form-control form-control-solid"
                                        placeholder="Enter price" />
                                    <!--end::Input-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Set the price that will be used to identify this schedule.
                                    </div>
                                    <!--end::Description-->
                                </div>
                                <!--end::Input group-->
                            </div>
                        </div>
                        <!--end::General options-->
                        <div class="d-flex justify-content-end">
                            <!--begin::Button-->
                            <a href="javascript:;" data-kt-element="cancel" class="btn btn-light me-5">Cancel</a>
                            <!--end::Button-->
                            <!--begin::Button-->
                            <button type="submit" class="btn btn-primary" data-kt-element="submit">
                                <span class="indicator-label">Save Changes</span>
                                <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                            <!--end::Button-->
                        </div>
                    </div>
                    <!--end::Main column-->
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('js/FormControls.js') }}"></script>
    <script>
        const formEl = $('#form_input');
        $('input[name="departure_time"]').flatpickr({
            enableTime: true,
            dateFormat: "Y-m-d H:i",
        });
        $('input[name="arrival_time"]').flatpickr({
            enableTime: true,
            dateFormat: "Y-m-d H:i",
        });
        formEl.on('submit', function(e) {
            e.preventDefault();
            KTFormControls.onSubmitForm(formEl);
        });
        const btnCancelEl = formEl.find('[data-kt-element="cancel"]');
        btnCancelEl.on('click', function(e) {
            e.preventDefault();
            KTFormControls.onCancelForm(formEl);
        });
    </script>
@endpush
