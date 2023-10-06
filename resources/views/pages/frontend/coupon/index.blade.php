@extends('layouts.frontend.master')
@section('title', 'Data Kupon')
@section('content')
    <section class="page-header page-header-text-light bg-secondary">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1>Data Kupon</h1>
                </div>
                <div class="col-md-4">
                    <ul class="breadcrumb justify-content-start justify-content-md-end mb-0">
                        <li><a href="index.html">Home</a></li>
                        <li class="active">Data Kupon</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <div id="content">
        <div class="container">
            <form id="content_filter">
                <div class="row">
                </div>
                <div class="bg-light shadow-md rounded p-4">
                    <div class="col mb-2">
                        <div class="col-md-4 col-lg-4 form-group">
                            <input type="text" class="form-control" id="keyword" name="keyword"
                                placeholder="Cari Data Pemesanan" onkeyup="load_list(1)">
                        </div>
                    </div>
                    <hr class="mx-n4">
                    <div class="table-responsive-md" id="list_result">
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('custom-scripts')
    <x-chat />
    <script>
        load_list(1);
    </script>
@endpush
