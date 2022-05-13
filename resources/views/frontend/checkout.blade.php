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


    <section class="py-4">
        <div class="container">
            <div class="site-header mb-4 text-center">
                <a href="{{ url('/')}}">
                    <img src="{{asset('frontend/img/logo.png')}}" alt="">
                </a>
            </div>

            <div class="view-cart-message green d-flex align-items-center justify-content-between">
                <p>
                    <i class="fa fa-check-circle"></i>
                    “Trademark Licensing” has been added to your cart
                </p>
                <a href="{{route('frontend.cart.show')}}" class="btn btn-warning">View cart</a>
            </div>
            <div class="view-cart-message d-flex align-items-center">
                <p>
                    <i class="fa fa-check-circle"></i>
                    Returning customer?
                    <a href="#" data-toggle="modal" data-target="#loginModal">Click here to login</a>
                    {{-- <a href="#" data-toggle="modal" data-target="#loginModal">Login</a> --}}
                </p>
            </div>
            
            <div class="view-cart-message d-flex align-items-center">
                <p>
                    <i class="fa fa-check-circle"></i>
                    Have a coupon?
                    <a href="#">Click here to enter your code</a>
                </p>
            </div>
            <form action="{{route('product.order')}}" method="POST">
                @csrf
                @if(count($data))

                <div class="row checkout-card">
                    <div class="col-md-5 checkout_left">
                        <h3>Billing details</h3>
                        <form action="">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label for=""> First Name </label>
                                        <input type="text" name="fname" value="{{$address?$address->fName:''}}" class="form-control @error('fname') is-invalid @enderror">
                                        @error('fname')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span> @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label for=""> Last Name </label>
                                        <input type="text" value="{{$address?$address->lName:''}}"  name="lname" class="form-control @error('lname') is-invalid @enderror">
                                        @error('lname')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span> @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="">
                                            Country / Region
                                        </label>
                                        <select name="billing_country" value="{{$address?$address->country:''}}" class="form-control @error('billing_country') is-invalid @enderror">
                                            <option value="India">India</option>
                                            <option value="Australia">Australia</option>
                                            <option value="Brazil">Brazil</option>
                                            <option value="Sweden">Sweden</option>
                                            <option value="UK">UK</option>
                                            <option value="USA">USA</option>
                                        </select>
                                        @error('billing_country')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span> @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="">
                                            State
                                        </label>
                                        <select name="billing_state" value="{{$address?$address->state:''}}" class="form-control @error('billing_state') is-invalid @enderror">
                                            <option value="West Bengal">West Bengal</option>
                                            <option value="Gujrat">Gujrat</option>
                                            <option value="Maharastra">Maharastra</option>
                                            <option value="Punjab">Punjab</option>
                                            <option value="Hariana">Hariana</option>
                                            <option value="Himachal Pradesh">Himachal Pradesh</option>
                                        </select>
                                        @error('billing_state')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span> @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="">
                                            Phone
                                        </label>
                                        <input type="number"  name="mobile" value="{{$address?$address->phone:''}}" class="form-control @error('mobile') is-invalid @enderror">
                                        @error('mobile')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span> @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="">
                                            Email address
                                        </label>
                                        <input type="email" value="{{$address?$address->email:''}}" name="email" class="form-control @error('email') is-invalid @enderror">
                                        @error('email')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span> @enderror
                                    </div>
                                </div>

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
                        $subTotal = $grandTotal = $couponCodeDiscount  = 0;
                        @endphp
                        {{-- @php $sum = 0; @endphp --}}
                        {{-- @php $sum = $sum + $data->price; @endphp --}}
                        @foreach($data as $cartKey => $cartValue)
                        {{-- @php $sum = $sum + $data->price_one; @endphp --}}
                        <table class="table checkout-table mb-4 border">
                            <tr>
                                <th>Product:</th>
                                <th>Price</th>
                            </tr>
                            <tr>
                                <td>{{ $cartValue->productCart->name }}</td>
                                <td>{{ $cartValue->price_one }}</td>
                            </tr>
                          
                        </table>
                        <input type="hidden" name="product_id" value="{{ $cartValue->product_id }}" class="form-control">
                        @php
                        $subTotal += (int) $cartValue->price_one;
                        if (!empty($data[0]->coupon_code_id)) {
                            $couponCodeDiscount = (int) $data[0]->couponDetails->amount;
                        }
                        
                        $grandTotalWithoutCoupon = $subTotal;
                        $grandTotal = ($subTotal ) - $couponCodeDiscount;
                    @endphp
                        @endforeach

                        <table class="table checkout-table mb-4 border">
                            
                        
                        {{-- @endif --}}




                        

                            <div class="container mt-3 mt-sm-5">
                                <div class="cart-summary">
                                    <div class="row justify-content-between flex-sm-row-reverse">
                                        <div class="col-sm-5">
                                            <div class="w-100">
                                                <div class="cart-total">
                                                    <div class="cart-total-label">
                                                        Subtotal
                                                    </div>
                                                    <div class="cart-total-value">
                                                        &#8377;<span id="subTotalAmount">{{$grandTotal}}</span>
                                                    </div>
                                                </div>

                                                <div id="appliedCouponHolder">
                                                    @if (!empty($data[0]->coupon_code_id))
                                                        <div class="cart-total">
                                                            <div class="cart-total-label">
                                                                COUPON APPLIED - <strong>{{$data[0]->couponDetails->coupon_code}}</strong><br/>
                                                                <a href="javascript:void(0)" onclick="removeAppliedCoupon()"><small>(Remove this coupon)</small></a>
                                                            </div>
                                                            <div class="cart-total-value">- {{$data[0]->couponDetails->amount}}</div>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="cart-total">
                                                    <div class="cart-total-label">
                                                        Total
                                                    </div>
                                                    <div class="cart-total-value">
                                                        <input type="hidden" value="{{$grandTotal}}" name="amount">
                                                        &#8377;<span id="displayGrandTotal">{{$grandTotal}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-5">
                                            <ul class="cart-summary-list">
                                                {{-- <li>
                                                    <img src="img/delivery-truck.png" />
                                                    <h5><span>&#8377;60</span> Apply Below order &#8377;499</h5> --}}
                                                    {{-- <a href="{{route('front.content.shipping')}}">See all Shipping charges and policies</a> --}}
                                                {{-- </li> --}}
                                                <li>
                                                    <img src="img/coupon.png" />
                                                    <div class="coupon-block">
                                                        <input type="text" class="coupon-text" name="couponText" id="couponText" placeholder="Enter coupon code here" value="{{ (!empty($data[0]->coupon_code_id)) ? $data[0]->couponDetails->coupon_code : '' }}" {{ (!empty($data[0]->coupon_code_id)) ? 'disabled' : '' }}>
                                                        @if (!empty($data[0]->coupon_code_id))
                                                            <button id="applyCouponBtn" style="background: #c1080a" disabled="true">Applied</button>
                                                        @else
                                                            <button id="applyCouponBtn">Apply</button>
                                                        @endif
                                                        {{-- $('#applyCouponBtn').text('APPLIED').css('background', '#c1080a').attr('disabled', true); --}}
                                                    </div>
                                                    @error('lname')<p class="small text-danger mb-0 mt-2">{{$message}}</p>@enderror
                                                    <a href="{{route('product.coupon.check')}}" class="d-inline-block mt-2">Get latest coupon from here</a>
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

                        <input type="radio" id="PO" name="payment_method" value="Pay Online">
                        <label>Pay Online</label><br>
                        <input type="radio" id="cod" name="payment_method" value="COD" checked>
                        <label for="cod">Cash On Delivary</label><br>

                        <div class="pay_box">
                            <p>Pay securely by Credit or Debit card or internet banking through Easebuzz.</p>
                        </div>

                        <p class="border-top py-3">
                            Your personal data will be used to process your order, support your experience throughout this website, and for other purposes described in our 
                            <a href="{{route('frontend.privacy-policy')}}">privacy policy</a>.
                        </p>
                        {{-- <form action="{{route('product.order')}}" method="POST">
                            @csrf --}}
                    
                            <button type="submit" class="btn ur-submit-button text-uppercase">
                                Proceed To Checkout
                            </button>
                            
                        {{-- </form> --}}
                    </div>
                    @endif
                    @if(session()->has('message'))
                                <div class="alert alert-success">
                                    {{ session()->get('message') }}
                                </div>
                            @endif
                </div>
            </form>
        </div>
    </section>
    
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
                                <form name="loginform" id="loginform" action=""
                                    method="POST">
                                    <p class="login-username">
                                        <label for="user">Email Address</label>
                                        <input type="text" name="user_email" id="user_email" class="input" value="{{ old('user_email') }}" size="20"
                                            placeholder="Enter Username" autocomplete="user_email" autofocus>
                                           
                                    </p>
                                    <p class="login-password">
                                        <label for="pass">Password</label>
                                        <input type="password" name="password" id="password" class="input" value="{{ old('password') }}" size="20"
                                            placeholder="Enter Password" autocomplete="email" autofocus>
                                    </p>
                                    <p class="login-submit">
                                        <input type="submit" name="wp-submit" id="wp-submit"
                                            class="button button-primary" value="Log In">
                                        <input type="hidden" name="redirect_to" value="https://filingrabbit.in">
                                    </p>
                                    <p class="mt-4" id="loginMessage"></p>
                                </form> 
                                {{-- <a class="forgot password"
                                    href="https://filingrabbit.in/lost-password/">Forgot Password?</a> --}}
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
                                    <form class="register" action="" method="POST" id="registerForm">
                                        {{-- @csrf --}}
                                        <div class="ur-form-row">
                                            <div class="ur-form-grid ur-grid-1" style="width:99%">
                                                <div data-field-id="regs_email" class="ur-field-item field-regs_email ">
                                                    <div class="form-group">
                                                        <label class="d-block">User Email</label>
                                                        <span class="input-wrapper">
                                                            <input class="form-control @error('regs_email') is-invalid @enderror"  type="email" name="regs_email" id="email">
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
                                                <div data-field-id="user_confirm_password"
                                                    class="ur-field-item field-user_confirm_password ">
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
    <footer class="bg-white text-center border-0 py-3 py-lg-4">
        <div class="container">
            <p>Copyright © 2021 Filing Rabbit</p>
        </div>
    </footer>
   

    <script type="text/javascript" src="{{url('frontend/js/jquery-3.6.0.min.js')}}"></script>
    <script type="text/javascript" src="{{url('frontend/js/popper.min.js')}}"></script>
    <script type="text/javascript" src="{{url('frontend/js/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{url('frontend/js/slick.min.js')}}"></script>
    <script type="text/javascript" src="{{url('frontend/js/custom.js')}}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
<script>
// ----------------Registartion-----------------
    $('#registerForm').on('submit', function(event) {
        event.preventDefault();
        var email = $("input[name=regs_email]").val();
        var password = $("input[name=regs_password]").val();
        var confirm_password = $("input[name=reg_con_password]").val();
        $.ajax({
            type:'POST',
            dataType:'JSON',
            url:"{{route('user.registration')}}",
            data:{ _token: '{{csrf_token()}}', email:email, password:password , confirm_password:confirm_password},
            success:function(response) {
                if(response.success == true){
                    $('#regMessage').addClass('text-success').html(response.message);
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
        // alert('log');
        var email = $("input[name=user_email]").val();
        var password = $("input[name=password]").val();
     
        $.ajax({
            type:'POST',
            dataType:'JSON',
            url:"{{ url('user_login') }}",
            data:{ _token: '{{csrf_token()}}', email:email, password:password},
            success:function(response) {
                if(response.success){
                    // window.location.href = "user/dashboard";
                     window.location.href = "cart";
                }else{
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
<script>
    // enable tooltips everywhere
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
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
    @if (Session::get('success'))
        toastFire('success', '{{ Session::get('success') }}');
    @elseif (Session::get('failure'))
        toastFire('danger', '{{ Session::get('failure') }}');
    @endif

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
    //         data : {_token : '{{csrf_token()}}',email : $('input[name="subsEmail"]').val()},
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
            url: '',
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
                    $('#applyCouponBtn').text('Apply').css('background', '#141b4b').attr('disabled', false);

                    let grandTotalWithoutCoupon = $('input[name="grandTotalWithoutCoupon"]').val();
                    $('#displayGrandTotal').text(grandTotalWithoutCoupon);

                    toastFire(result.type, result.message);
                } else {
                    toastFire(result.type, result.message);
                    $('#applyCouponBtn').text('Apply');
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
                url: '{{ route('product.coupon.check') }}',
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
                    // console.log(result);

                    if (result.type == 'success') {
                        $('#applyCouponBtn').text('APPLIED').css('background', '#c1080a').attr('disabled', true);

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
                        toastFire(result.type, result.message);
                    } else {
                        toastFire(result.type, result.message);
                        $('#applyCouponBtn').text('Apply');
                    }
                }
            });
        }
    });
</script>