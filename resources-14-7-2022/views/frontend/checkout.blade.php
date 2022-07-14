<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filing Rabit</title>
    <link rel="stylesheet" type="text/css" href="{{ url('frontend/css/bootstrap.css') }}">
    <link rel="stylesheet" href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css?ver=5.9.3' />
    <link rel="stylesheet" type="text/css" href="{{ url('frontend/css/slick-theme.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('frontend/css/slick.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('frontend/css/main.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('frontend/css/responsive.css') }}">
</head>

<body>


    <section class="py-4">
        <div class="container">
            <div class="site-header mb-4 text-center">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('frontend/img/logo.png') }}" alt="">
                </a>
            </div>

            <div class="view-cart-message green d-flex align-items-center justify-content-between">
                <p>
                    <i class="fa fa-check-circle"></i>
                    @foreach ($data as $cartKey => $cartValue)
                    “{{ $cartValue->productCart->name }}”
                    @endforeach
                     has been added to your cart
                </p>
                <a href="{{ route('frontend.cart.show') }}" class="btn btn-warning">View cart</a>
            </div>
            @if (!Auth::guard('user')->user())
                <div class="view-cart-message d-flex align-items-center">
                    <p>
                        <i class="fa fa-check-circle"></i>
                        Returning customer?
                        <a href="#" data-toggle="modal" data-target="#loginModal">Click here to login</a>
                        {{-- <a href="#" data-toggle="modal" data-target="#loginModal">Login</a> --}}
                    </p>
                </div>
            @endif
            {{-- <div class="view-cart-message d-flex align-items-center">
                <p>
                    <i class="fa fa-check-circle"></i>
                    Have a coupon?
                    <a href="#">Click here to enter your code</a>
                </p>
            </div> --}}
            <form action="#" method="POST">
                {{-- @csrf --}}
                @if (count($data))
                    <div class="row checkout-card">
                        <div class="col-md-5 checkout_left">
                            <h3>Billing details</h3>
                            <form action="">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for=""> First Name </label>
                                            <input type="text" name="fname"
                                                {{-- value="{{ Auth::guard('user')->user() ? Auth::guard('user')->user()->first_name : '' }}" --}}
                                                value="{{$address ? $address->fName : '' }}"
                                                class="form-control @error('fname') is-invalid @enderror">
                                            @error('fname')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for=""> Last Name </label>
                                            <input type="text"
                                                {{-- value="{{ Auth::guard('user')->user() ? Auth::guard('user')->user()->last_name : '' }}" --}}
                                                value="{{$address ? $address->lName : '' }}"
                                                name="lname"
                                                class="form-control @error('lname') is-invalid @enderror">
                                            @error('lname')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for=""> Country </label>
                                            <input type="text"
                                                {{-- value="{{ Auth::guard('user')->user() ? Auth::guard('user')->user()->last_name : '' }}" --}}
                                                value="{{$address ? $address->country : '' }}"
                                                name="billing_country"
                                                class="form-control @error('billing_country') is-invalid @enderror">
                                            @error('billing_country')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for=""> State </label>
                                            <input type="text"
                                                {{-- value="{{ Auth::guard('user')->user() ? Auth::guard('user')->user()->last_name : '' }}" --}}
                                                value="{{$address ? $address->state : '' }}"
                                                name="billing_state"  id="billing_state"
                                                class="form-control @error('billing_state') is-invalid @enderror">
                                            @error('billing_state')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- <div class="col-12">
                                        <div class="form-group">
                                            <label for="">
                                                Country / Region
                                            </label>
                                            <select name="billing_country"
                                                class="form-control @error('billing_country') is-invalid @enderror">
                                                <option value="India">India</option>
                                                <option value="Australia">Australia</option>
                                                <option value="Brazil">Brazil</option>
                                                <option value="Sweden">Sweden</option>
                                                <option value="UK">UK</option>
                                                <option value="USA">USA</option>
                                            </select>
                                            @error('billing_country')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div> --}}
                                    {{-- <input type="hidden" name="billing_country" value="India"> --}}
                                    {{-- <div class="col-12">
                                        <div class="form-group">
                                            <label for="">State</label>
                                            <select name="billing_state" id="billing_state"
                                                class="form-control @error('billing_state') is-invalid @enderror">
                                                <option>--Select State--</option>
                                                <option value="Andhra Pradesh">Andhra Pradesh</option>
                                                <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                                <option value="Assam">Assam</option>
                                                <option value="Bihar">Bihar</option>
                                                <option value="Chhattisgarh">Chhattisgarh</option>
                                                <option value="Goa">Goa</option>
                                                <option value="Gujarat">Gujarat</option>
                                                <option value="Haryana">Haryana</option>
                                                <option value="Himachal Pradesh">Himachal Pradesh</option>
                                                <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                                                <option value="Jharkhand">Jharkhand</option>
                                                <option value="Karnataka">Karnataka</option>
                                                <option value="Kerala">Kerala</option>
                                                <option value="Madhya Pradesh">Madhya Pradesh</option>
                                                <option value="Maharashtra">Maharashtra</option>
                                                <option value="Manipur">Manipur</option>
                                                <option value="Meghalaya">Meghalaya</option>
                                                <option value="Mizoram">Mizoram</option>
                                                <option value="Nagaland">Nagaland</option>
                                                <option value="Odisha">Odisha</option>
                                                <option value="Punjab">Punjab</option>
                                                <option value="Rajasthan">Rajasthan</option>
                                                <option value="Sikkim">Sikkim</option>
                                                <option value="Tamil Nadu">Tamil Nadu</option>
                                                <option value="Telangana">Telangana</option>
                                                <option value="Tripura">Tripura</option>
                                                <option value="Uttar Pradesh">Uttar Pradesh</option>
                                                <option value="Uttarakhand">Uttarakhand</option>
                                                <option value="West Bengal">West Bengal</option>
                                            </select>
                                            @error('billing_state')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div> --}}
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="">
                                                Phone
                                            </label>
                                            <input type="text" name="mobile"
                                                {{-- value="{{ Auth::guard('user')->user() ? Auth::guard('user')->user()->mobile : '' }}" --}}
                                                value="{{$address ? $address->phone : '' }}"
                                                class="form-control @error('mobile') is-invalid @enderror">
                                            @error('mobile')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="">
                                                Email address
                                            </label>
                                            <input type="email"
                                                {{-- value="{{ Auth::guard('user')->user() ? Auth::guard('user')->user()->email : '' }}" --}}
                                                value="{{$address ? $address->email : '' }}"
                                                name="email"
                                                class="form-control @error('email') is-invalid @enderror">
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                    <p class="mt-4" id="errorMessage"></p>
                                    {{-- <div class="col-12">
                                    <div class="form-group">
                                        <label for="check">
                                            <input type="checkbox" name="check" id="check">
                                            Create an account?
                                        </label>
                                    </div>
                                </div> --}}
                                </div>
                            </form>
                        </div>
                        @php
                            // $subTotal = $grandTotal = $couponCodeDiscount = $shippingCharges = $taxPercent = 0;
                        @endphp

                        <div class="col-md-7 checkout_right">

                            <h3>Your order</h3>
                            @php
                                $subTotal = $grandTotal = $couponCodeDiscount = 0;
                            @endphp
                            @php $sum = 0; @endphp
                            {{-- @php $sum = $sum + $data->price; @endphp --}}
                            @foreach ($data as $cartKey => $cartValue)
                                @php $sum = $sum + $cartValue->price; @endphp
                                <table class="table checkout-table mb-4 border">
                                    <tr>
                                        <th>Product:</th>
                                        <th>Price</th>
                                    </tr>
                                    <tr>
                                        <td>{{ $cartValue->productCart->name }}</td>
                                        <td>{{ $cartValue->price }}</td>
                                        {{-- <td>{{ $sum }}</td> --}}
                                    </tr>

                                </table>
                                <input type="hidden" name="product_id" value="{{ $cartValue->product_id }}"
                                    class="form-control">

                                @php
                                    $subTotal = (int) $sum;
                                    // $subTotal = (int) $cartValue->price;
                                    if (!empty($data[0]->coupon_code_id)) {
                                        $couponCodeDiscount = (int) $data[0]->couponDetails->amount;
                                    }
                                    $grandTotalWithoutCoupon = $subTotal;
                                    $grandTotal = $subTotal - $couponCodeDiscount;
                                @endphp
                            @endforeach

                            <input type="hidden" name="total_checkout_amount" value="{{ $sum }}">


                            <table class="table checkout-table mb-4 border">


                                {{-- @endif --}}

                                <div id="couponsusagedetails">
                                    <input type="hidden" name="coupon_code_id"
                                        value="@if (!empty($data[0]->coupon_code_id)) {{ $data[0]->coupon_code_id }} @endif">
                                    <input type="hidden" name="coupon_code"
                                        value="@if (!empty($data[0]->coupon_code_id)) {{ $data[0]->couponDetails->coupon_code }} @endif">
                                    <input type="hidden" name="discount"
                                        value="@if (!empty($data[0]->coupon_code_id)) {{ $couponCodeDiscount }} @endif">
                                </div>


                                <div class="container mt-3 mt-sm-5">
                                    <div class="cart-summary">
                                        <div class="row justify-content-between flex-sm-row-reverse">
                                            <div class="col-sm-6 text-right">
                                                <div class="w-100">
                                                    <div class="cart-total">
                                                        <div class="cart-total-label">
                                                            Subtotal
                                                        </div>

                                                        <div class="cart-total-value">
                                                            &#8377;<span
                                                                id="subTotalAmount">{{ $grandTotalWithoutCoupon }}</span>
                                                        </div>
                                                    </div>

                                                    <div id="appliedCouponHolder">
                                                        @if (!empty($data[0]->coupon_code_id))
                                                            <div class="cart-total">
                                                                <div class="cart-total-label">
                                                                    COUPON APPLIED -
                                                                    <strong>{{ $data[0]->couponDetails->coupon_code }}</strong><br />
                                                                    <a href="javascript:void(0)"
                                                                        onclick="removeAppliedCoupon()"><small>(Remove
                                                                            this coupon)</small></a>
                                                                </div>
                                                                <div class="cart-total-value">-
                                                                    {{ $data[0]->couponDetails ? $data[0]->couponDetails->amount : '' }}
                                                                </div>
                                                            </div>
                                                        @endif

                                                    </div>
                                                    <div class="cart-total">
                                                        <div class="cart-total-label">
                                                            Total
                                                        </div>
                                                        <div class="cart-total-value">
                                                            <input type="hidden" value="{{ $grandTotal }}"
                                                                name="amount">
                                                            &#8377;<span
                                                                id="displayGrandTotal">{{ $grandTotal }}</span>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <ul class="cart-summary-list">
                                                    {{-- <li>
                                                    <img src="img/delivery-truck.png" />
                                                    <h5><span>&#8377;60</span> Apply Below order &#8377;499</h5> --}}
                                                    {{-- <a href="{{route('front.content.shipping')}}">See all Shipping charges and policies</a> --}}
                                                    {{-- </li> --}}
                                                    <li>
                                                        <div class="coupon-block">
                                                            <input type="text" class="coupon-text form-control"
                                                                name="couponText" id="couponText"
                                                                placeholder="Enter coupon code here"
                                                                value="{{ !empty($data[0]->coupon_code_id) ? $data[0]->couponDetails->coupon_code : '' }}"
                                                                {{ !empty($data[0]->coupon_code_id) ? 'disabled' : '' }}>
                                                            @if (!empty($data[0]->coupon_code_id))
                                                                <button id="applyCouponBtn"
                                                                    class="btn ur-submit-button mt-3"
                                                                    disabled="true">Applied</button>
                                                            @else
                                                                <button id="applyCouponBtn"
                                                                    class="btn ur-submit-button mt-3">Apply
                                                                    Coupon</button>
                                                            @endif
                                                            <!-- {{-- $('#applyCouponBtn').text('APPLIED').css('background', '#c1080a').attr('disabled', true); --}} -->
                                                        </div>
                                                        @error('lname')
                                                            <p class="small text-danger mb-0 mt-2">{{ $message }}</p>
                                                        @enderror
                                                        <a href="{{ route('product.coupon.check') }}"
                                                            class="d-inline-block mt-2">Get latest coupon from here</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                        {{-- <div class="row justify-content-between">
                                        <div class="col-sm-12 text-right mt-4">
                                            <form action="{{route('product.transaction')}}" method="POST">
                                    <button type="submit" class="btn checkout-btn">Proceed to checkout</button>
            </form>
        </div>
        </div> --}}
                                    </div>
                                </div>
                            </table>
                            <input type="radio" id="PO" name="payment_method" value="1">
                            <label>Pay Online</label><br>
                            {{-- <input type="radio" id="cod" name="payment_method" value="2" checked>
                            <label for="cod">Cash On Delivary</label><br> --}}

                            <div class="pay_box">
                                <p>Pay securely by Credit or Debit card or internet banking through Easebuzz.</p>
                            </div>

                            <p class="border-top py-3">
                                Your personal data will be used to process your order, support your experience
                                throughout this website, and for other purposes described in our
                                <a href="{{ route('frontend.privacy-policy') }}">privacy policy</a>.
                            </p>

                            {{-- <form action="{{route('product.order')}}" method="POST">
        @csrf --}}

                            {{-- <button type="submit" class="btn ur-submit-button text-uppercase" id="checkout_btn"
                                {{ Auth::guard('user')->user() ? '' : 'disabled' }}>
                                Proceed To Checkout
                            </button> --}}
                            {{-- <button type="submit" class="btn ur-submit-button text-uppercase" id="checkout_btn"
                            >
                            Proceed To Checkout
                            </button> --}}
                            @if  (Auth::guard('user')->user())
                            <button type="button" class="btn ur-submit-button text-uppercase" id="checkout_btn"
                               >
                                Proceed to Payment (UPI/Net Banking/Card)
                            </button>
                            @else
                            <div class="view-cart-message d-flex align-items-center">
                                <p>
                                    <i class="fa fa-check-circle"></i>
                                    Proceed to Payment?
                                    <a href="#" data-toggle="modal" data-target="#loginModal">Click here to login</a>
                                    {{-- <a href="#" data-toggle="modal" data-target="#loginModal">Login</a> --}}
                                </p>
                            </div>
                            
                            @endif
                            {{-- </form> --}}
                        </div>
                @endif

                @if (session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif
        </div>
        </form>
        </div>
    </section>

    <div class="modal fade login_modal" id="loginModal" tabindex="-1" role="dialog"
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
                                            <input type="text" name="user_email" id="user_email" class="input" value="{{ old('user_email') }}" size="20" placeholder="Enter Username" autocomplete="user_email" autofocus>

                                        </p>
                                        <p class="login-password mb-2">
                                            <label for="pass">Password</label>
                                            <input type="password" name="password" id="password" class="input" value="{{ old('password') }}" size="20" placeholder="Enter Password" autocomplete="email" autofocus>
                                        </p>
                                        <p class="text-right mb-2"><a class="forgot" href="{{ route('forget.password.get') }}">Forgot Password?</a></p>
                                        <p class="login-submit">
                                            <input type="submit" name="wp-submit" id="wp-submit" class="button button-primary" value="Log In">
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
                                                            <input class="form-control @error('regs_email') is-invalid @enderror" type="email" name="regs_email" id="email">
                                                            @error('regs_email')<span class="invalid-feedback" role="alert"><strong> {{ $message }}</strong></span>@enderror
                                                        </span>
                                                    </div>
                                                </div>

                                                <div data-field-id="user_pass" class="ur-field-item field-user_pass ">
                                                    <div class="form-group">
                                                        <label class="d-block">User Password</label>
                                                        <span class="input-wrapper">
                                                            <input class="form-control" type="password" name="regs_password" id="regs_password">
                                                        </span>
                                                    </div>
                                                </div>
                                                <div data-field-id="user_confirm_password" class="ur-field-item field-user_confirm_password ">
                                                    <div class="form-group">
                                                        <label class="d-block">Confirm Password</label>
                                                        <span class="input-wrapper">
                                                            <input class="form-control" type="password" name="reg_con_password">
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

                                <p class="text-center">Have an Account? <a class="button button-primary"
                                        href="#" data-toggle="modal" data-target="#loginModal"
                                        data-dismiss="modal">Sign In</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-white text-center border-0 py-3 py-lg-4">
        <div class="container">
            <p>Copyright © 2021 Filing Rabbit</p>
        </div>
    </footer>


    <script type="text/javascript" src="{{ url('frontend/js/jquery-3.6.0.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('frontend/js/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('frontend/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('frontend/js/slick.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('frontend/js/custom.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- <script src="https://ebz-static.s3.ap-south-1.amazonaws.com/easecheckout/easebuzz-checkout.js"></script> --}}
    <script src="https://ebz-static.s3.ap-south-1.amazonaws.com/easecheckout/easebuzz-checkout.js"></script>
</body>

</html>
<script>
    $("input[name='payment_method']").click(function() {
        
        if ($(this).val() == 1) {
           
            // $('#checkout_btn').html('Proceed to Payment (UPI/Net Banking/Card)');
            $('#checkout_btn').attr('type', 'button');
            $('#checkout_btn').attr('id', 'ebz-checkout-btn')
            $('#ebz-checkout-btn').on('click', function() {
                var fname = $("input[name=fname]").val();
                var lname = $("input[name=lname]").val();
                var billing_country = $("input[name=billing_country]").val();
                var billing_state = $("#billing_state").val();
                // alert(billing_state);
                // var lname = $("input[name=lname]").val();
                // var _token ={{csrf_token()}}.val,
                // alert(token);
                var mobile = Number($("input[name=mobile]").val());
                // alert(mobile);
                var email = $("input[name=email]").val();
                var amount = $("input[name=amount]").val();
                if (fname == "") {
                    alert("First Name must be filled out");
                }else if(lname == ""){
                    alert("Last Name must be filled out");
                }else if(billing_country == ""){
                    alert("Billing Country must be filled out");
                }else if(billing_state == ""){
                    alert("Billing State must be filled out");
                }else if(mobile == ""){
                    alert("Phone must be filled out");
                }else if(email == ""){
                    alert("Email must be filled out");
                    return false;
                }
                $.ajax({
                    // headers: {
                    // 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    // },
                    type: "POST",
                    url: "{{ route('product.order') }}",
                    data: {
                        _token:"{{csrf_token()}}",
                        txnid: "T3SAT0B5OL",
                        productinfo: "A good product",
                        firstname: fname,
                        phone: mobile,
                        email: email,
                        amount: amount,
                        lname: lname,
                        billing_country: billing_country,
                        billing_state: billing_state,
                        // surl: "http://127.0.0.1:8000/product/cart",
                        // furl: "http://127.0.0.1:8000/product/cart",
                        // surl:url('product/easebuzz-webhook'),
                        // furl: url('product/easebuzz-webhook'),
                        hash: "{{ uniqid() }}",
                    },
                    success: function(res) {
                        // if (res.success == 1) {
                        if (JSON.parse(res).status == 1) {
                            console.log(JSON.parse(res).data);

                            window.location.href = JSON.parse(res).data;
                            // window.location.href = res.success.data;
                            // if(JSON.parse(res).data){
                            //     window.location.href = "{{ route('product.order') }}"
                            // }
                        } else {
                            $('#errorMessage').addClass('text-danger').html(res.message);
                        }
                    }
                })
            });

        } else {
            $('#ebz-checkout-btn').attr('id', 'checkout_btn')
            $('#checkout_btn').html('Proceed to Chekout');
            $('#checkout_btn').attr('type', 'submit');
        }
    });
</script>
<script>
    // var key = "798F29SEFR"; var salt = "IXUNVY2IC4";
    // var easebuzzCheckout = new EasebuzzCheckout(key, 'prod');
    // document.getElementById('ebz-checkout-btn').onclick = function(e){
    //     e.preventDefault();
    //     var options = {
    //         access_key: key, // access key received via Initiate Payment
    //         onResponse: (response) => {
    //             console.log(response);
    //         },
    //         theme: "#123456" // color hex
    //     }
    //     easebuzzCheckout.initiatePayment(options);
    // }
    /* $("input[name='payment_method']").change(function() {
        if ($(this).val() == 1) {

            var key = "IXUNVY2IC4";
            var access_key = "798F29SEFR";
            
            $('#checkout_btn').html('Proceed to Payment (UPI/Net Banking/Card)');
            $('#checkout_btn').attr('type', 'button');
            $('#checkout_btn').attr('id', 'ebz-checkout-btn');
            $('#ebz-checkout-btn').on('click', function() {
                // console.log('Hello');
            var easebuzzCheckout = new EasebuzzCheckout(key	, 'prod');
                console.log(easebuzzCheckout);
                var options = {
                access_key: access_key, // access key received via Initiate Payment
                    onResponse: (response) => {
                        console.log(response);
                    },
                    theme: "#123456" // color hex
                }

                easebuzzCheckout.initiatePayment(options);
            })
        } else {
            $('#ebz-checkout-btn').attr('id', 'checkout_btn')
            $('#checkout_btn').html('Proceed to Chekout');
            $('#checkout_btn').attr('type', 'submit');
        }
    }) */
</script>

<script>
    // ----------------Registartion-----------------
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
                url: "{{route('user.registration')}}",
                data: {
                    _token: '{{csrf_token()}}',
                    email: regs_email,
                    password: password,
                    confirm_password: confirm_password
                },
                success: function(response) {
                    if (response.success == true) {
                        $('#regMessage').addClass('text-success').html(response.message);
                        $('#registerModal').modal('hide');
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
                    _token: '{{csrf_token()}}',
                    email: email,
                    password: password
                },
                success: function(response) {
                    // console.log(response);
                    if (response.success) {
                        // window.location.href = "user/dashboard";
                        // window.location.href = response.redirect_url;
                        // $('#loginModal').modal('hide');
                        location.reload(true);
                        // $("#loginlinktext").html('<a href="' + "{{route('user.dashboard')}}" + '" class="nav-link">My Profile</a>')
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
@if (Session::has('success'))
    <script>
        toastFire("success", "{{ Session::get('success')[0] }}");
    </script>
@elseif(Session::has('error'))
    <script>
        toastFire("danger", "{{ Session::get('success')[0] }}");
    </script>
@endif
<script>
    // enable tooltips everywhere
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })

    // sweetalert fires | type = success, error, warning, info, question
    function toastFire(type = 'success', title, body = '') {
        Swal.fire({
            icon: type,
            title: title,
            text: body,
            confirmButtonColor: '#c10909',
            timer: 5000
        })
    }

    // on session toast fires 

    // button text changes on form submit
    $('form').on('submit', function(e) {
        $('button').attr('disabled', true).prop('disabled', 'disabled');
    });

    // subscription mail form
    // $('#joinUsForm').on('submit', function(e) {
    //     e.preventDefault();
    //     $.ajax({
    //         url : $(this).attr('action'),
    //         method : $(this).attr('method'),
    //         data : {_token : '{{ csrf_token() }}',email : $('input[name="subsEmail"]').val()},
    //         beforeSend : function() {
    //             $('#joinUsMailResp').html('Please wait <i class="fas fa-spinner fa-pulse"></i>');
    //         },
    //         success : function(result) {
    //             result.resp == 200 ? $icon = '<i class="fas fa-check"></i> ' : $icon = '<i class="fas fa-info-circle"></i> ';
    //             $('#joinUsMailResp').html($icon+result.message);
    //             $('button').attr('disabled', false);
    //         }
    //     });
    // });

    // remove applied coupon option
    function removeAppliedCoupon() {
        $.ajax({
            url: "{{ route('product.coupon.remove') }}",
            method: 'POST',
            data: {
                '_token': '{{ csrf_token() }}'
            },
            beforeSend: function() {
                $('#applyCouponBtn').text('Checking');
            },
            success: function(result) {
                if (result.type == 'success') {
                    $('#appliedCouponHolder').html('');
                    $('input[name="couponText"]').val('').attr('disabled', false);
                    $('#applyCouponBtn').text('Apply').css('background', '#f1d231').attr('disabled', false);

                    const grandTotalWithoutCoupon = $('#subTotalAmount').text();
                    $('#displayGrandTotal').text(grandTotalWithoutCoupon);
                    $("input[name='amount']").val(grandTotalWithoutCoupon);

                    $('input[name="coupon_code_id"], input[name="coupon_code"], input[name="discount"], input[name="total_checkout_amount"]')
                        .val('');

                    toastFire(result.type, result.message);
                    $('#applyCouponBtn').text('Apply Coupon');
                } else {
                    toastFire(result.type, result.message);
                    $('#applyCouponBtn').text('Apply Coupon');
                }
            }
        });
    }

    /* let chekoutAmount = getCookie('checkoutAmount');
    // console.log(chekoutAmount);
    if (chekoutAmount) {
        couponApplied(chekoutAmount);
    }

    // checkout page coupon applied design
    function couponApplied(amount) {
        $('input[name="grandTotal"]').val(amount);
        $('#displayGrandTotal').text(amount);

        let couponContent = `
        <div class="cart-total">
            <div class="cart-total-label">
                COUPON APPLIED<br/>
                <a href="javascript:void(0)" onclick="removeAppliedCoupon(${amount})"><small>(Remove this coupon)</small></a>
            </div>
            <div class="cart-total-value">- ${amount}</div>
        </div>
        `;

        $('#appliedCouponHolder').html(couponContent);
    } */

    // let paymentGatewayAmount = chekoutAmount ? parseInt(chekoutAmount) * 100 : document.querySelector('[name="grandTotal"]').value * 100;
    // let paymentGatewayAmount = parseInt($('#displayGrandTotal').text()) * 100;
</script>

@yield('script')
<script>
    // cart page coupon
    $('#applyCouponBtn').on('click', (e) => {
        e.preventDefault()
        let couponCode = $('input[name="couponText"]').val();
        if (couponCode.length > 0) {
            $.ajax({
                url: "{{ route('product.coupon.check') }}",
                method: 'POST',
                data: {
                    '_token': '{{ csrf_token() }}',
                    code: couponCode
                },
                beforeSend: function() {
                    $('#applyCouponBtn').text('Checking');
                    // $('#applyCouponBtn').text('Checking').attr('disabled', true);
                },
                success: function(result) {
                    console.log(result);

                    if (result.type == 'success') {
                        $('#applyCouponBtn').text('APPLIED').css('background', '#f1d231').attr(
                            'disabled', true);

                        $('input[name="couponText"]').attr('disabled', true);
                        let beforeCouponValue = parseInt($('#displayGrandTotal').text());
                        let couponDiscount = parseInt(result.amount);
                        let discountedGrandTotal = beforeCouponValue - couponDiscount;
                        $('#displayGrandTotal').text(discountedGrandTotal);

                        /* $('input[name="coupon_code_id"]').val(result.id);
                        let grandTotal = $('input[name="grandTotal"]').val();
                        let discountedGrandTotal = parseInt(grandTotal) - parseInt(result.amount);
                        $('input[name="grandTotal"]').val(discountedGrandTotal);
                        $('#displayGrandTotal').text(discountedGrandTotal); */

                        let couponContent = `
                        <div class="cart-total">
                            <div class="cart-total-label">
                                COUPON APPLIED - <strong>${couponCode}</strong><br/>
                                <a href="javascript:void(0)" onclick="removeAppliedCoupon()"><small>(Remove this coupon)</small></a>
                            </div>
                            <div class="cart-total-value">- ${result.amount}</div>
                        </div>
                        `;

                        $('#appliedCouponHolder').html(couponContent);

                        $("input[name='amount']").val(discountedGrandTotal);

                        $('input[name="coupon_code_id"]').val(result.id);
                        $('input[name="coupon_code"]').val(couponCode);
                        $('input[name="discount"]').val(result.coupon_discount);

                        toastFire(result.type, result.message);
                    } else {
                        toastFire(result.type, result.message);
                        $('#applyCouponBtn').text('Apply');
                    }
                }
            });
        } else {
            alert("Enter a coupon code")
        }
    });
</script>