@extends('layouts.backend.master')
@section('title', 'Add Coupon')
@section('page', 'Add Coupon')
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
            <a href="{{ route('backend.coupons.index') }}" class="text-muted text-hover-primary">Coupons</a>
        </li>
        <!--end::Item-->
        <!--begin::Item-->
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-300 w-5px h-2px"></span>
        </li>
        <!--end::Item-->

        <!--begin::Item-->
        <li class="breadcrumb-item text-dark">
            Add Coupon
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
                    data-kt-redirect="{{ route('backend.coupons.index') }}" action="{{ route('backend.coupons.store') }}"
                    method="POST">
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
                                    <label class="required form-label">User</label>
                                    <div class="text-danger mb-2">Perhatian! Pengguna yang tampil di bawah ini adalah
                                        pengguna
                                        yang
                                        memiliki sudah memesan 5 atau lebih kursi.</div>
                                    <!--end::Label-->
                                    <!--begin::Select-->
                                    <select name="user_id" class="form-select form-select-solid" data-control="select2"
                                        data-placeholder="Select option">
                                        <option value="">Select option</option>
                                        @foreach ($customers as $customer)
                                            <option value="{{ $customer->id }}">{{ $customer->name }}
                                                ({{ $customer->email }})
                                            </option>
                                        @endforeach
                                    </select>
                                    <!--end::Select-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Select a user that will be used to identify this coupon.
                                    </div>
                                    <!--end::Description-->
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="mb-5 fv-row fv-plugins-icon-container">
                                    <!--begin::Label-->
                                    <label class="required form-label">Discount</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" name="discount" class="form-control form-control-solid"
                                        placeholder="Enter discount" />
                                    <!--end::Input-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Set the discount that will be used to identify this coupon.
                                    </div>
                                    <!--end::Description-->
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="mb-5 fv-row fv-plugins-icon-container">
                                    <!--begin::Label-->
                                    <label class="required form-label">Limit</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" name="limit" class="form-control form-control-solid"
                                        placeholder="Enter limit" />
                                    <!--end::Input-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Set the limit that will be used to identify this coupon.
                                    </div>
                                    <!--end::Description-->
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
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
@push('custom-scripts')
    <script src="{{ asset('js/FormControls.js') }}"></script>
    <script>
        const formEl = $('#form_input');
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
