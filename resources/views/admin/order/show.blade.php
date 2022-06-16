@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
    <div class="fixed-row">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-tags"></i> {{ $pageTitle }}</h1>
                <p>{{ $subTitle }}</p>
            </div>
            <a href="{{ route('admin.category.create') }}" class="btn btn-primary pull-right"><i class="fa fa-fw fa-lg fa-plus"></i>Add New</a>
        </div>
    </div>
    @include('admin.partials.flash')
    <div class="alert alert-success" id="success-msg" style="display: none;">
        <span id="success-text"></span>
    </div>
    <div class="alert alert-danger" id="error-msg" style="display: none;">
        <span id="error-text"></span>
    </div>
    <div class="row section-mg row-md-body no-nav">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <table class="table table-hover custom-data-table-style table-striped" id="sampleTable">
                        <thead>
                            <tr>
                               
                                <th class="text-center"> Order Id </th>
                                <th class="text-center"> User Name </th>
                                <th class="text-center"> Product Name </th>
                                <th class="text-center"> Country </th>
                                <th class="text-center"> State </th>
                                <th class="text-center"> Phone </th>
                                <th class="text-center"> Email </th>
                                <th class="text-center"> Price </th>
                                {{-- <th style="width:100px; min-width:100px;" class="text-center">Action</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $subTotal = $grandTotal = $couponCodeDiscount = 0;
                                @endphp
                                @php $sum = 0; @endphp
                            @foreach($data as $order)
                            @php $sum = $sum + $order->amount; @endphp
                                    <tr>
                                        <td class="text-center">{{$order->order_no ? $order->order_no: ''}}</td>
                                        <td class="text-center">{{ $order->fname .' '. $order->lname ? $order->fname .' '. $order->lname: "NA"}}</td>
                                        <td class="text-center">{{$order->productDetails ? $order->productDetails->name: 'NA'}}</td>
                                        <td class="text-center">{{$order->billing_country ? $order->billing_country: 'NA'}}</td>
                                        <td class="text-center">{{$order->billing_state ? $order->billing_state: 'NA'}}</td>
                                        <td class="text-center">{{$order->mobile ? $order->mobile: ''}}</td>
                                        <td class="text-center">{{$order->email ? $order->email: ''}}</td>
                                        
                                        <td class="text-center">₹.{{ $order->amount}}/-</td>
                                        <td class="text-center">
                                            {{-- <div class="btn-group" role="group" aria-label="Second group">
                                                <a href="{{ route('admin.order.show', $data['id']) }}" class="btn btn-sm btn-primary edit-btn">Order Details</a>
                                                
                                            </div> --}}
                                            
                                        </td>
                                    </tr> 
                            @endforeach

                            @php
                            $subTotal = (int) $sum;
                           
        
                            // $grandTotalWithoutCoupon = $orders->amount;
                            $grandTotal = ($subTotal ) - $orders->amount;
                            @endphp
        
                              
                           

                            
                               
            
                            </div>
                        </tbody>
                        <div class="col-md-6 mb-3">
                            <div class="card card-body mb-0">
                                <h5> Subtotal </h5><p class="mb-2">₹.{{$sum}}/-</p>
                                <h5> Discounted Amount </h5><p class="mb-2">₹.{{$grandTotal}}/-</p>
                                <h5> Grand Total </h5><p class="mb-2">₹.{{$orders->amount}}/-</p>
                                </p>
                            </div>
                        </div> 
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('styles')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.css">
@endpush
@push('scripts')
    <script type="text/javascript" src="{{ asset('backend/js/plugins/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/js/plugins/dataTables.bootstrap.min.js') }}"></script>
    <script type="text/javascript">$('#sampleTable').DataTable({"ordering": false});
    </script>
@endpush