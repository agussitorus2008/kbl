@extends('layouts.backend.master')
@section('title', 'Data Pemesanan')
@section('content')
    <div class="card">
        <div class="card-header border-0 pt-6">
            <div class="card-title">
                <div class="d-flex align-items-center position-relative my-1 me-3">
                    <span class="svg-icon svg-icon-1 position-absolute ms-6">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1"
                                transform="rotate(45 17.0365 15.1223)" fill="black" />
                            <path
                                d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                fill="black" />
                        </svg>
                    </span>
                    <input type="text" name="keywords" class="form-control form-control-solid w-250px ps-15"
                        placeholder="Cari data..." />
                </div>
                <div class="d-flex justify-content-end me-3">
                    <select class="form-select form-select-solid" name="status">
                        <option value="">All Status</option>
                        <option value="waiting">Waiting</option>
                        <option value="booked">Booked</option>
                        <option value="canceled">Canceled</option>
                        <option value="rejected">Rejected</option>
                    </select>
                </div>
            </div>
            <div class="card-toolbar">

            </div>
        </div>
        <div class="card-body pt-0">
            <div class="table-responsive">
                <table class="table align-middle table-row-dashed fs-6 gy-5" id="datatables">
                    <thead>
                        <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                            <th class="min-w-125px">User</th>
                            <th class="min-w-125px">Code</th>
                            <th class="min-w-125px">Departure Time</th>
                            <th class="min-w-125px">Booking Time</th>
                            <th class="min-w-125px">Total Seat</th>
                            <th class="min-w-125px">Total</th>
                            <th class="min-w-125px">Status</th>
                            <th class="text-end min-w-70px">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="fw-bold text-gray-600">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#datatables').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('backend.orders.index') }}',
                columns: [{
                        data: 'user.name',
                        name: 'user.name'
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
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'total_seat',
                        name: 'total_seat'
                    },
                    {
                        data: 'total',
                        name: 'total'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

            $('input[name="keywords"]').on('keyup', function() {
                $('#datatables').DataTable().search($(this).val()).draw();
            });

            $('select[name="status"]').on('change', function() {
                $('#datatables').DataTable().columns(6).search($(this).val()).draw();
            });
        });
    </script>
@endpush
