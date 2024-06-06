<script src="{{ asset('backend/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('backend/js/scripts.bundle.js') }}"></script>
<script src="{{ asset('js/method-admin.js') }}"></script>
<script src="{{ asset('js/plugin-admin.js') }}"></script>
<script src="{{ asset('backend/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<script src="{{ asset('js/notif.js') }}"></script>
<script>
    localStorage.setItem("route_counter_notif", "{{ route('backend.counter_notif') }}");
</script>
<script src="{{ asset('js/jquery.slimscroll.min.js') }}"></script>
@stack('scripts')
