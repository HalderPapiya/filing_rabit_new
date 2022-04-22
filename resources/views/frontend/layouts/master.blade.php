<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filing Rabit</title>

    <link rel="stylesheet" type="text/css" href="{{url('frontend/css/bootstrap.css')}}">
    <link rel="stylesheet" href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css?ver=5.9.3' />
    <link rel="stylesheet" type="text/css" href="{{url('frontend/css/slick-theme.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{url('frontend/css/slick.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{url('frontend/css/main.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('frontend/css/responsive.css')}}">
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
                                    <img src="{{asset('frontend/img/logo.png')}}">
                                </a>
                                <p class="text-center">or</p>
                                <div class="login_wrap">
                                    <form name="loginform" id="loginform" action="https://filingrabbit.in/wp-login.php"
                                        method="post">
                                        <p class="login-username">
                                            <label for="user">Email Address</label>
                                            <input type="text" name="log" id="user" class="input" value="" size="20"
                                                placeholder="Enter Username">
                                        </p>
                                        <p class="login-password">
                                            <label for="pass">Password</label>
                                            <input type="password" name="pwd" id="pass" class="input" value="" size="20"
                                                placeholder="Enter Password">
                                        </p>
                                        <p class="login-submit">
                                            <input type="submit" name="wp-submit" id="wp-submit"
                                                class="button button-primary" value="Log In">
                                            <input type="hidden" name="redirect_to" value="https://filingrabbit.in">
                                        </p>
                                    </form> <a class="forgot password"
                                        href="https://filingrabbit.in/lost-password/">Forgot Password?</a>
                                </div>
                                <p class="text-center">Don't Have an Account? 
                                    <a class="button button-primary" href="#" data-toggle="modal" data-target="#registerModal" data-dismiss="modal">
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
                                    <img src="{{asset('frontend/img/logo.png')}}" >
                                </a>
                                <p class="text-center">or</p>
                                <div class="user-registration ur-frontend-form  " id="user-registration-form-784">
                                    <form class="register">
                                        <div class="ur-form-row">
                                            <div class="ur-form-grid ur-grid-1" style="width:99%">
                                                <div data-field-id="user_email" class="ur-field-item field-user_email ">
                                                    <div class="form-group">
                                                        <label class="d-block">User Email</label>
                                                        <span class="input-wrapper">
                                                            <input type="email">
                                                        </span> 
                                                    </div>
                                                </div>
                                                <div data-field-id="user_pass" class="ur-field-item field-user_pass ">
                                                    <div class="form-group">
                                                        <label class="d-block">User Password</label>
                                                        <span class="input-wrapper">
                                                            <input type="password">
                                                        </span> 
                                                    </div>
                                                </div>
                                                <div data-field-id="user_confirm_password"
                                                    class="ur-field-item field-user_confirm_password ">
                                                    <div class="form-group">
                                                        <label class="d-block">Confirm Password</label>
                                                        <span class="input-wrapper">
                                                            <input type="password">
                                                        </span> 
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ur-button-container ">
                                            <button type="submit" class="btn button ur-submit-button">Submit</button>
                                        </div>
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
                                    <img src="{{asset('frontend/img/logo.png')}}">
                                </a>
                                <form>
                                    <input class="form-control mb-3" type="text" placeholder="Your Name">
                                    <input class="form-control mb-3" type="email" placeholder="Email Address">
                                    <input class="form-control mb-3" type="tel" placeholder="Mobile Number">
                                    <input class="form-control mb-3" type="text" placeholder="City">
                                    <input class="btn submit_btn" type="submit" value="GET STARTED NOW">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script type="text/javascript" src="{{url('frontend/js/jquery-3.6.0.min.js')}}"></script>
    <script type="text/javascript" src="{{url('frontend/js/popper.min.js')}}"></script>
    <script type="text/javascript" src="{{url('frontend/js/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{url('frontend/js/slick.min.js')}}"></script>
    <script type="text/javascript" src="{{url('frontend/js/custom.js')}}"></script>

</body>
</html>