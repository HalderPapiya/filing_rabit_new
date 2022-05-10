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
                <a href="index.html">
                    <img src="{{asset('frontend/img/logo.png')}}" alt="">
                </a>
            </div>

            <div class="view-cart-message green d-flex align-items-center justify-content-between">
                <p>
                    <i class="fa fa-check-circle"></i>
                    “Trademark Licensing” has been added to your cart
                </p>
                <a href="#" class="btn btn-warning">View cart</a>
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
                    <div class="col-md-7 checkout_right">
                        <h3>Your order</h3>
                        @php $sum = 0; @endphp
                        {{-- @php $sum = $sum + $data->price; @endphp --}}
                        @foreach ($userCarts as $data)
                        @php $sum = $sum + $data->price_one; @endphp
                        <table class="table checkout-table mb-4 border">
                            <tr>
                                <th>Product:</th>
                                <th>Price</th>
                            </tr>
                            <tr>
                                <td>{{ $data->productCart->name }}</td>
                                <td>{{ $data->price_one }}</td>
                            </tr>
                            <tr>
                                <td>Price:</td>
                                <td>{{ $data->price_one }}</td>
                            </tr>

                            {{-- <tr>
                                <td>Subtotal:</td>
                                <td>{{ $sum }}/-</td>
                            </tr> --}}
                        </table>
                        <input type="hidden" name="product_id" value="{{ $data->product_id }}" class="form-control">

                        @endforeach

                        <table class="table checkout-table mb-4 border">
                            {{-- <tr>
                                <th>Product:</th>
                                <th>Subtotal</th>
                            </tr>
                            <tr>
                                <td>{{ $data->productCart->name }}</td>
                                <td>{{ $data->price_one }}</td>
                            </tr>
                            <tr>
                                <td>Price:</td>
                                <td>{{ $data->price_one }}</td>
                            </tr> --}}
                            <input type="hidden" name="amount" value="{{ $sum }}" class="form-control">

                            <tr>
                                <td>Subtotal:</td>
                                <td>{{ $sum }}/-</td>
                            </tr>
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
                            <a href="#">privacy policy</a>.
                        </p>

                        <button type="submit" class="btn ur-submit-button">Place Order</button>
                    </div>
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
                                <a class="forgot password"
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

</body>
</html>
<script>
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