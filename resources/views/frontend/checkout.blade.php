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
                    <a href="#">Click here to login</a>
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
                                        <input type="text" name="fname" class="form-control">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label for=""> Last Name </label>
                                        <input type="text"  name="lname" class="form-control">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="">
                                            Country / Region
                                        </label>
                                        <select name="billing_country" class="form-control">
                                            <option value="India">India</option>
                                            <option value="Australia">Australia</option>
                                            <option value="Brazil">Brazil</option>
                                            <option value="Sweden">Sweden</option>
                                            <option value="UK">UK</option>
                                            <option value="USA">USA</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="">
                                            State
                                        </label>
                                        <select name="billing_state" class="form-control">
                                            <option value="West Bengal">West Bengal</option>
                                            <option value="Gujrat">Gujrat</option>
                                            <option value="Maharastra">Maharastra</option>
                                            <option value="Punjab">Punjab</option>
                                            <option value="Hariana">Hariana</option>
                                            <option value="Himachal Pradesh">Himachal Pradesh</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="">
                                            Phone
                                        </label>
                                        <input type="number"  name="mobile" class="form-control">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="">
                                            Email address
                                        </label>
                                        <input type="email"  name="email" class="form-control">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="check">
                                            <input type="checkbox" id="check">
                                            Create an account?
                                        </label>
                                    </div>
                                </div>
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

                    
                        <label>Pay Online</label>

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