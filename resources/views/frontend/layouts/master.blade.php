<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filing Rabit</title>

    <link rel="stylesheet" type="text/css" href="{{ url('frontend/css/bootstrap.css') }}">
    <link rel="stylesheet"
        href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css?ver=5.9.3' />
    <link rel="stylesheet" type="text/css" href="{{ url('frontend/css/slick-theme.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('frontend/css/slick.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('frontend/css/main.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('frontend/css/responsive.css') }}">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.css">
</head>

<body>

    @include('frontend.layouts.header')

    @yield('content')

    @include('frontend.layouts.footer')


    <!-- ========== Modals ==========  -->
    <div class="modal fade login_modal" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">x</span>
                    </button>
                    <div class="row m-0">
                        <div class="col-sm-12 p-0">
                            <div class="login_block">
                                <a href="https://filingrabbit.in/" rel="home" class="login_logo">
                                    <img src="{{ asset('frontend/img/logo.png') }}">
                                </a>
                                <a href="{{ url('/redirect') }}" class="d-block mt-0 mb-2">
                                    <div class="glogin">
                                        <div class="g_logo">
                                            <img src="{{ asset('frontend/img/g.png') }}">
                                        </div>
                                        <div class="gtext">
                                            <p>Login with Google</p>
                                        </div>
                                    </div>
                                </a>
                                <p class="text-center">or</p>
                                <div class="login_wrap">
                                    <form id="loginform">
                                        <p class="login-username">
                                            <label for="user">Email Address</label>
                                            <input type="text" name="user_email" id="user_email" class="input"
                                                value="{{ old('user_email') }}" size="20" placeholder="Enter Username"
                                                autocomplete="user_email" autofocus>

                                        </p>
                                        <p class="login-password mb-2">
                                            <label for="pass">Password</label>
                                            <input type="password" name="password" id="password" class="input"
                                                value="{{ old('password') }}" size="20" placeholder="Enter Password"
                                                autocomplete="email" autofocus>
                                        </p>
                                        <p class="text-right mb-2"><a class="forgot"
                                                href="{{ route('forget.password.get') }}">Forgot Password?</a></p>
                                        <p class="login-submit">
                                            <input type="submit" name="wp-submit" id="wp-submit"
                                                class="button button-primary" value="Log In">
                                            <input type="hidden" name="redirect_to" value="https://filingrabbit.in">
                                        </p>
                                        <p class="mt-4" id="loginMessage"></p>
                                    </form>
                                    
                                </div>
                               

                                <p class="text-center">Don't Have an Account?
                                    <a class="button button-primary" href="#" data-toggle="modal"
                                        data-target="#registerModal" data-dismiss="modal">
                                        Sign Up
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade login_modal" id="registerModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">x</span>
                    </button>
                    <div class="row m-0">
                        <div class="col-sm-12 p-0">
                            <div class="login_block">
                                <a href="https://filingrabbit.in/" rel="home" class="login_logo">
                                    <img src="{{ asset('frontend/img/logo.png') }}">
                                </a>
                                <div class="user-registration ur-frontend-form  " id="user-registration-form-784">
                                    <a href="{{ url('/redirect') }}" class="d-block mt-0 mb-2">
                                        <div class="glogin">
                                            <div class="g_logo">
                                                <img src="{{ asset('frontend/img/g.png') }}">
                                            </div>
                                            <div class="gtext">
                                                <p>Sign up with Google</p>
                                            </div>
                                        </div>
                                    </a>
                                    <p class="text-center">or</p>
                                    <form class="register" action="" method="POST" id="registerForm">
                                        {{-- @csrf --}}
                                        <div class="ur-form-row">
                                            <div class="ur-form-grid ur-grid-1" style="width:99%">
                                                <div data-field-id="regs_email" class="ur-field-item field-regs_email ">
                                                    <div class="form-group">
                                                        <label class="d-block">User Email</label>
                                                        <span class="input-wrapper">
                                                            <input
                                                                class="form-control @error('regs_email') is-invalid @enderror"
                                                                type="email" name="regs_email" id="email">
                                                            @error('regs_email')
                                                                <span class="invalid-feedback" role="alert"><strong>
                                                                        {{ $message }}</strong></span>
                                                            @enderror
                                                        </span>
                                                    </div>
                                                </div>

                                                <div data-field-id="user_pass" class="ur-field-item field-user_pass ">
                                                    <div class="form-group">
                                                        <label class="d-block">User Password</label>
                                                        <span class="input-wrapper">
                                                            <input class="form-control" type="password"
                                                                name="regs_password" id="regs_password">
                                                        </span>
                                                    </div>
                                                </div>
                                                <div data-field-id="user_confirm_password"
                                                    class="ur-field-item field-user_confirm_password ">
                                                    <div class="form-group">
                                                        <label class="d-block">Confirm Password</label>
                                                        <span class="input-wrapper">
                                                            <input class="form-control" type="password"
                                                                name="reg_con_password">
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ur-button-container ">
                                            <button type="submit" class="btn button ur-submit-button">Submit</button>
                                        </div>
                                        <p class="mt-4" id="regMessage"></p>
                                    </form>

                                    <div style="clear:both"></div>
                                </div>

                                <p class="text-center">Have an Account? <a class="button button-primary" href="#"
                                        data-toggle="modal" data-target="#loginModal" data-dismiss="modal">Sign In</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade login_modal" id="consultation_modal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">x</span>
                    </button>
                    <div class="row m-0">
                        <div class="col-sm-12 p-0">
                            <div class="login_block">
                                <a href="https://filingrabbit.in/" rel="home" class="login_logo">
                                    <img src="{{ asset('frontend/img/logo.png') }}">
                                </a>
                                <form action="" method="POST" id="consultantForm">
                                    {{-- @csrf --}}
                                    <input class="form-control  mb-3 @error('cons_name') is-invalid @enderror" name="cons_name" type="text" placeholder="Your Name">
                                    @error('cons_name')
                                        <span class="invalid-feedback" role="alert"><strong>
                                                {{ $message }}</strong></span>
                                    @enderror
                                    <input class="form-control  mb-3 @error('cons_email') is-invalid @enderror " name="cons_email" type="email"
                                        placeholder="Email Address">
                                    @error('cons_email')
                                        <span class="invalid-feedback" role="alert"><strong>
                                                {{ $message }}</strong></span>
                                    @enderror
                                    <input class="form-control  mb-3  @error('phone') is-invalid @enderror " name="phone" type="tel"
                                        placeholder="Mobile Number">
                                    @error('phone')
                                        <span class="invalid-feedback" role="alert"><strong>
                                                {{ $message }}</strong></span>
                                    @enderror
                                    <input class="form-control  mb-3 @error('city') is-invalid @enderror" name="city" type="text" placeholder="City">
                                    @error('city')
                                        <span class="invalid-feedback" role="alert"><strong>
                                                {{ $message }}</strong></span>
                                    @enderror
                                    <input class="btn submit_btn" type="submit" value="GET STARTED NOW">
                                    <p class="mt-4" id="consMessage"></p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script type="text/javascript" src="{{ url('frontend/js/jquery-3.6.0.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('frontend/js/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('frontend/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('frontend/js/slick.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('frontend/js/custom.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.js"></script>

    <script type="text/javascript">
        $('#consultantForm').on('submit', function(event) {
            
            event.preventDefault();
            var cons_name = $("input[name=cons_name]").val();
            var cons_email = $("input[name=cons_email]").val();
            var phone = $("input[name=phone]").val();
            var city = $("input[name=city]").val();
           
        
            $.ajax({
                type: 'POST',
                dataType: 'JSON',
                url: "{{ route('frontend.consultant') }}",
                data: {
                    _token: '{{ csrf_token() }}',
                    name: cons_name,
                    email: cons_email,
                    phone: phone,
                    city: city,
                },
                success: function(response) {
                    if (response.success == true) {
                        alert('Booking Successful');
                        // $('#consMessage').addClass('text-success').html(response.message);
                        // alert('Booking Successful')
                        setTimeout($('#consultation_modal').modal('hide'), 5000);
                    } else {
                        $('#consMessage').addClass('text-danger').html(response.message);
                    }
                },
                error: function(response) {
                    $('#consMessage').html(response.message);
                    // console.log(error)
                }
            });
        });




        $('#registerForm').on('submit', function(event) {
            event.preventDefault();
            // alert();
            var regs_email = $("input[name=regs_email]").val();
            var password = $("input[name=regs_password]").val();
            var confirm_password = $("input[name=reg_con_password]").val();
            // var email = $(this).data('email');
            // var password = $(this).data('password');
            // var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            // "_token": "{{ csrf_token() }}",
            // var CSRF_TOKEN : "{{ csrf_token() }}",
            $.ajax({
                type: 'POST',
                dataType: 'JSON',
                url: "{{ route('user.registration') }}",
                data: {
                    _token: '{{ csrf_token() }}',
                    email: regs_email,
                    password: password,
                    confirm_password: confirm_password
                },
                success: function(response) {
                    if (response.success == true) {
                        $('#regMessage').addClass('text-success').html(response.message);
                        // $('#registerModal').modal('hide');
                        setTimeout($('#registerModal').modal('hide'), 5000);
                    } else {
                        $('#regMessage').addClass('text-danger').html(response.message);
                    }
                },
                error: function(response) {
                    $('#regMessage').html(response.message);
                    // console.log(error)
                }
            });
        });

        // ----------login------------
        $('#loginform').on('submit', function(event) {
            event.preventDefault();
            var email = $("input[name=user_email]").val();
            var password = $("input[name=password]").val();

            $.ajax({
                type: 'POST',
                dataType: 'JSON',
                url: "{{ url('user_login') }}",
                data: {
                    _token: '{{ csrf_token() }}',
                    email: email,
                    password: password
                },
                success: function(response) {
                    // console.log(response);
                    if (response.success) {
                        // window.location.href = "user/dashboard";
                        // window.location.href = response.redirect_url;
                        $('#loginMessage').addClass('text-success').html(response.message);
                        setTimeout($('#loginModal').modal('hide'), 5000);
                        // $('#loginModal').modal('hide');
                        $("#loginlinktext").html('<a href="' + "{{ route('user.dashboard') }}" +
                            '" class="nav-link">My Profile</a>')
                    } else {
                        $('#loginMessage').addClass('text-danger').html(response.message);
                    }
                },
                error: function(response) {
                    // $('#regMessage').html(response.error);
                    // console.log(error)
                    $('#loginMessage').html(response.message);
                }
            });
        });
    </script>

    @yield('script')

</body>

</html>
