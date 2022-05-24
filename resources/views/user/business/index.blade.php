@extends('frontend.layouts.master')
@section('content')
<!-- ==================== Banner Section ==================== -->
<section class="banner-area cart-banner">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section_title">
                    <h2 data-aos="fade-down" data-aos-duration="1000">Addresses</h2>
                    <div class="shadow_text">Filingrabbit</div>
                </div>
                <a href="#" class="home">Home</a> / <span>My Account</span>
            </div>
        </div>
    </div>
</section>

<!-- ==================== Account Section ==================== -->
<section class="ac_section">
    <div class="container">
        <div class="row ">
            @include('user.sidebar')  
            <div class="col-md-9">
                <div class="col-md-9">
                    {{-- <div class="col-auto">
                        <form action="{{ route('user.businessService.index') }}">
                        <div class="row g-3 align-items-center">
                            <div class="col-auto">
                            <input type="search" name="term" id="term" class="form-control" placeholder="Search here.." value="{{app('request')->input('term')}}" autocomplete="off">
                            </div>
                            <div class="col-auto">
                            <button type="submit" class="btn btn-outline-danger btn-sm">Search Product</button>
                            </div>
                        </div>
                        </form>
                    </div> --}}
                    <div class="col-auto">
                    <form action="{{ route('user.businessService.index') }}" id="checkout-form">
                        <div class="row m-0">
                            <div class="col-12 col-lg-3 plr-3 pl-lg-0 fcontrol position-relative filter_selectWrap filter_selectWrap2">
                                {{-- <img src="{{ asset('front/img/grid.svg')}}"> --}}
                                <select class="filter_select form-control" name="type_id">
                                    <option value="" hidden selected>Select Categoy...</option>
                                    @foreach ($types as $index => $item)
                                        <option value="{{$item->id}}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- <div class="col-12 col-lg-3 plr-3 pl-lg-0 fcontrol position-relative filter_selectWrap filter_selectWrap2">
                                <img src="{{ asset('front/img/map-pin.svg')}}">
                                <select class="filter_select form-control" name="pincode">
                                    <option value="" hidden selected>Search by postcode</option>
                                    @foreach ($pin as $index => $item)
                                        <option value="{{$item->id}}">{{ $item->pin }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 col-lg-3 plr-3 pl-lg-0 fcontrol position-relative filter_selectWrap filter_selectWrap2">
                                <img src="{{ asset('front/img/map-pin.svg')}}">
                                <select class="filter_select form-control" name="suburb_id">
                                    <option value="" hidden selected>Search by Suburb</option>
                                    @foreach ($suburb as $index => $item)
                                        <option value="{{$item->id}}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div> --}}
                            <div class="col-9 col-lg-2 plr-3">
                                <input type="search" name="name" class="form-control pl-3" placeholder="Search by keyword...">
                            </div>
                            {{-- <div class="col-3 col-lg-1 plr-3 pr-lg-0">
                                <a href="javascript:void(0);" id="btnFilter" class="btn btn-outline-danger btn-sm"></a>
                            </div> --}}
                            <div class="col-auto">
                                <button type="submit" class="btn btn-outline-danger btn-sm">Search Product</button>
                                </div>
                        </div>
                    </form>
                    </div>
                <div class="my-account-form-wrapper">
                    <h3>Business Service</h3>
                   
                    <div class="col-md-3">
                        {{-- <nav class="sticky-top my-account-navigation">
                            <ul>
                                @foreach ($businessServices as $businessService)
                                <li>
                                    {{$businessService->name}}<a href="{{ route('user.businessService.edit', $businessService['id']) }}"></a>
                                </li>
                                @endforeach
                                
                                
                            </ul>
                        </nav> --}}
                        <table class="table table-hover custom-data-table-style table-striped" id="sampleTable">
                            <div class="fixed-row">
                                <div class="app-title">
                                    <a href="{{ route('user.businessService.create') }}" class="btn btn-primary pull-right"><i class="fa fa-fw fa-lg fa-plus"></i>Add</a>
                                </div>
                            </div>
                            
                            <tbody>
                                @foreach ($businessServices as $businessService)
                                {{-- dd{{$businessServices}} --}}
                                        <tr>
                                          
                                            <td>{{ $businessService['name'] }}</td>
                                            
                                                {{-- <td>{{ $category['slug'] }}</td> --}}
                                            
                                            
                                            <td class="text-center">
                                                <div class="btn-group" role="group" aria-label="Second group">
                                                    <a href="{{ route('user.businessService.show', $businessService['id']) }}" class="btn btn-sm btn-primary show-btn"><i class="fa fa-eye"></i></a>
                                                    @if(auth()->user()->id == $businessService->user_id)
                                                    <a href="{{ route('user.businessService.edit', $businessService['id']) }}" class="btn btn-sm btn-primary edit-btn"><i class="fa fa-edit"></i></a>
                                                    @endif
                                                    @if(auth()->user()->id != $businessService->user_id)
                                                        @if(!$exist)
                                                            <a href="{{ route('user.bid.create', $businessService['id']) }}" class="btn btn-sm btn-primary edit-btn">BID</i></a>
                                                        @else   
                                                            <a href="{{ route('user.bid.create', $businessService['id']) }}" class="btn btn-sm btn-primary edit-btn">BID</i></a> 
                                                        @endif
                                                            <a href="{{ route('user.bid.edit', $businessService['id']) }}" class="btn btn-sm btn-primary edit-btn">BID Edit</i></a>
                                                        {{-- @endif     --}}
                                                    @endif

                                                    {{-- <a href="#" data-id="{{$data['id']}}" class="sa-remove btn btn-sm btn-danger edit-btn"><i class="fa fa-trash"></i></a> --}}
                                                </div>
                                            </td>
                                            @if(session()->has('message'))
                                                <div class="alert alert-success">
                                                    {{ session()->get('message') }}
                                                </div>
                                            @endif
                                        </tr> 
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                
            </div>
        
        </div>
    </div>
</section>

@endsection


@push('scripts')
    <script type="text/javascript">
    $(document).on("click", "#btnFilter", function() {
        $('#checkout-form').submit();
    });
    </script>
@endpush