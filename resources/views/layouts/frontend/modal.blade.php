<div class="modal fade" id="modalListResult" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content" id="contentListResult"></div>
    </div>
</div>
<!-- Modal Dialog - Login/Signup
  ============================================= -->
<div id="login-signup" class="modal fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content p-sm-3">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a id="login-tab" class="nav-link active text-4" data-toggle="tab" href="#login" role="tab"
                            aria-controls="login" aria-selected="true">Login</a>
                    </li>
                    <li class="nav-item">
                        <a id="signup-tab" class="nav-link text-4" data-toggle="tab" href="#signup" role="tab"
                            aria-controls="signup" aria-selected="false">Register</a>
                    </li>
                </ul>
                <div class="tab-content pt-4">
                    <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="login-tab">
                        <form id="login_form">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" id="loginMobile">
                            </div>
                            <div class="form-group">
                                <div class="bb">
                                    <label>Kata Sandi</label>
                                    {{-- <a class="justify-content-end" href="#">Tidak ingat kata sandi ?</a> --}}
                                </div>
                                <input type="password" name="password" class="form-control" id="loginPassword">

                            </div>
                            {{-- <div class="row mb-4">
                                <div class="col-sm">
                                    <div class="form-check custom-control custom-checkbox">
                                        <input id="remember-me" name="remember" class="custom-control-input"
                                            type="checkbox">
                                        <label class="custom-control-label" for="remember-me">Remember Me</label>
                                    </div>
                                </div>
                                <div class="col-sm text-right">
                                    <a class="justify-content-end" href="#">Forgot Password ?</a>
                                </div>
                            </div> --}}
                            <div class="aa">
                                <button id="tombol_login" class="btn btn-primary " type="button"
                                    onclick="handle_login('#tombol_login','#login_form','{{ route('auth.login') }}','POST');">Masuk</button>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="signup" role="tabpanel" aria-labelledby="signup-tab">
                        <form id="register_form">
                            <div class="form-group">
                                <input type="text" class="form-control" name="name" required
                                    placeholder="Nama Lengkap">
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" required placeholder="Email">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="phone" placeholder="No. Handphone">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="address" placeholder="Alamat">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="password" required
                                    placeholder="Password">
                            </div>
                            <button id="tombol_register"
                                onclick="handle_post('#tombol_register','#register_form','{{ route('auth.register') }}','POST');"
                                class="btn btn-primary btn-block" type="button">Register</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Dialog - Login/Signup end -->
<!-- Bus Details (Select Seats) Modal Dialog
  ============================================= -->
<div id="select-busseats" class="modal fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">

        </div>
    </div>
</div>
<script>
    function handle_login(tombol, form, url, method) {
        $(tombol).attr('disabled', true);
        $(tombol).html('<i class="ri-refresh-line spin"></i>');
        $.ajax({
            url: url,
            method: method,
            data: $(form).serialize(),
            beforeSend: function() {
                $(tombol).attr('disabled', true);
                $(tombol).html('<i class="ri-refresh-line spin"></i>');
            },
            success: function(response) {
                if (response.status == 'success') {
                    Swal.fire({
                        text: response.message,
                        icon: "success",
                        buttonsStyling: !1,
                        confirmButtonText: "Ok, Mengerti!",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    }).then(function() {
                        if (response.redirect != 'refresh') {
                            window.location.href = response.redirect;
                        } else {
                            window.location.reload();
                        }
                    });
                } else {
                    $(tombol).attr('disabled', false);
                    $(tombol).html('Login');
                    Swal.fire({
                        text: response.message,
                        icon: "error",
                        buttonsStyling: !1,
                        confirmButtonText: "Ok, Mengerti!",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    });
                }
            },
        });
    }
</script>
<!-- Bus Details (Select Seats) Modal Dialog
  ============================================= -->
<div id="select-busseats" class="modal fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">

        </div>
    </div>
</div>
<script>
    function handle_login(tombol, form, url, method) {
        $(tombol).attr('disabled', true);
        $(tombol).html('<i class="ri-refresh-line spin"></i>');
        $.ajax({
            url: url,
            method: method,
            data: $(form).serialize(),
            success: function(response) {
                if (response.alert == 'success') {
                    Swal.fire({
                        text: response.message,
                        icon: "success",
                        buttonsStyling: !1,
                        confirmButtonText: "Ok, Mengerti!",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    }).then(function() {
                        window.location.href = response.redirect;
                    });
                } else {
                    $(tombol).attr('disabled', false);
                    $(tombol).html('Login');
                    Swal.fire({
                        text: response.message,
                        icon: "error",
                        buttonsStyling: !1,
                        confirmButtonText: "Ok, Mengerti!",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    });
                }
            },
        });
    }
</script>
