@yield('css')
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900'
    type='text/css'>
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/vendor/bootstrap/css/bootstrap.min.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/vendor/font-awesome/css/all.min.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/vendor/daterangepicker/daterangepicker.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/vendor/jquery-ui/jquery-ui.css') }}" />
<link rel="stylesheet" type="text/css"
    href="{{ asset('frontend/vendor/jquery-seat-charts/jquery.seat-charts.css') }}" />
<script src="https://kit.fontawesome.com/07ad57e463.js" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/stylesheet.css') }}" />
{{-- <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/custom.css') }}" /> --}}
<link rel="stylesheet" href="{{ asset('css/sweetalert.css') }}" type="text/css" />
<link rel="stylesheet" href="{{ asset('css/toastr.css') }}" type="text/css" />
<link rel="stylesheet" href="{{ asset('css/chat.css') }}" type="text/css" />
<link href="{{ asset('css/notification.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/flaticon.css') }}" rel="stylesheet" type="text/css" />
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<style>
    .icon-button {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        color: #333333;
        background: #dddddd;
        border: none;
        outline: none;
        border-radius: 50%;
    }

    .icon-button:hover {
        cursor: pointer;
    }

    .icon-button:active {
        background: #cccccc;
    }

    .icon-button__badge {
        position: absolute;
        top: -10px;
        right: -10px;
        width: 25px;
        height: 25px;
        background: red;
        color: #ffffff;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 50%;
    }
</style>
