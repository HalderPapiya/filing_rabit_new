tt+bid details@extends('frontend.layouts.master')
@extends('frontend.layouts.master')
@section('content')
    {{-- <div class="fixed-row">
        <div class="app-title">
            <div class="active-wrap">
                <h1><i class="fa fa-tags"></i> {{ $pageTitle }}</h1>
                <div class="form-group">
                    <button class="btn btn-primary" type="button" id="btnSave"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update business Service</button>
                    <a class="btn btn-secondary" href="{{ route('admin.business_add_on.index') }}"><i class="fa fa-fw fa-lg fa fa-angle-left"></i>Back</a>
                </div>
            </div>
        </div>
    </div> --}}
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

    <section class="ac_section">
        <div class="container">
            <div class="row ">
                @include('user.sidebar')  
                <div class="col-md-9">
                    <div class="col-md-9">
                    <div class="my-account-form-wrapper">
                        <div class="tile-body">
                            <table class="table table-hover custom-data-table-style table-striped" id="sampleTable">
                                <thead>
                                    <tr>
                                        <th> First Name </th>
                                        <th> Last Name </th>
                                        {{-- <th> Email </th> --}}
                                        <th> Ammount </th>
                                        {{-- <th class="text-center"> Status </th> --}}
                                        <th style="width:100px; min-width:100px;" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($bids as $bid)
                                    <tr>
                                          <td>{{$bid->user ? $bid->user->first_name : ''}}</td>
                                          <td>{{$bid->user ? $bid->user->last_name : ''}}</td>
                                          {{-- <td>{{$bid->user ? $bid->user->email : ''}}</td> --}}
                                          <td>{{$bid->valuation}}</td>
                                          
                                          <td class="text-center">
                                              <div class="btn-group" role="group" aria-label="Second group">
                                                  <a href="" class="btn btn-sm btn-primary edit-btn"><i class="fa fa-edit"></i></a>
                                                  <a href="{{route('user.broker.addon.mail',$bid['id'])}}"  class="sa-remove btn btn-sm btn-danger edit-btn">Mail</a>
                                              </div>
                                          </td>
                                      </tr> 
                                @endforeach
                            </tbody>
                        </table>
                        </div>         
                                {{-- <div class="col-12">
                                    <button type="submit" class="btn ur-submit-button w-auto">Update Business Service</button>
                                </div> --}}
                    </div>
                        {{-- <div class="col-md-3">
                            <nav class="sticky-top my-account-navigation">
                                <ul>
                                    @foreach ($businessServices as $businessService)
                                    <li>
                                        <a href="{{ route('user.businessService.edit', $businessService['id']) }}">{{$businessService->name}}</a>
                                    </li>
                                    @endforeach
                                    
                                    
                                </ul>
                            </nav>
                        </div> --}}
                    </div>
                    
                </div>
            
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script type="text/javascript">
        $("#btnSave").on("click",function(){
            $('#form1').submit();
        })
    </script>
@endpush