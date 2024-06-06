<script src="{{ asset('frontend/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('frontend/vendor/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{ asset('frontend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('frontend/vendor/owl.carousel/owl.carousel.min.js') }}"></script>
<script src="{{ asset('frontend/vendor/bootstrap-spinner/bootstrap-spinner.js') }}"></script>
<script src="{{ asset('frontend/vendor/daterangepicker/moment.min.js') }}"></script>
<script src="{{ asset('frontend/vendor/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('frontend/vendor/jquery-seat-charts/jquery.seat-charts.min.js') }}"></script>

<script src="{{ asset('js/toastr.js') }}"></script>
<script src="{{ asset('js/sweetalert.js') }}"></script>
<script src="{{ asset('js/method.js') }}"></script>
@auth
    <script src="{{ asset('js/plugin.js') }}"></script>
    <script src="{{ asset('js/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('js/notif.js') }}"></script>
    <script>
        localStorage.setItem("route_counter_notif", "{{ route('counter_notif') }}");
    </script>
    <script>
        $(document).ready(function() {
            var height = $('.navi').data('height');
            var mobile_height = $('.navi').data('mobile-height');
            $('#notification_items').slimScroll({
                height: height,
                mobileHeight: mobile_height,
                color: '#fff',
                alwaysVisible: true,
                railVisible: true,
                railColor: '#fff',
                railOpacity: 1,
                wheelStep: 10,
                allowPageScroll: true,
                disableFadeOut: false
            });
        });
    </script>
@endauth
@guest
    <script src="{{ asset('js/auth.js') }}"></script>
@endguest
<script src="{{ asset('frontend/js/theme.js') }}"></script>
@stack('scripts')
