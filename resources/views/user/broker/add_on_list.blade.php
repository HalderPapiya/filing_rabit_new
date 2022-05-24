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
                    

                
                <div class="my-account-form-wrapper">
                    <h3>Business Service</h3>
                   
                    <div class="col-md-3">
                        {{-- <nav class="sticky-top my-account-navigation">
                            <ul>
                                @foreach ($businessAddOns as $data)
                                <li>
                                    <a href="{{ route('user.business_add_on.edit', $data['id']) }}">{{$data->name}}</a>
                                </li>
                                @endforeach
                                
                                
                            </ul>
                        </nav> --}}
                        <table class="table table-hover custom-data-table-style table-striped" id="sampleTable">
                            {{-- <div class="fixed-row">
                                <div class="app-title">
                                    <a href="{{ route('user.business_add_on.create') }}" class="btn btn-primary pull-right"><i class="fa fa-fw fa-lg fa-plus"></i>Add New</a>
                                </div>
                            </div> --}}
                            <tbody>
                                @foreach ($businessAddOns as $data)
                                        <tr>
                                          
                                            {{-- <td>nametd> --}}
                                            <td>{{ $data->business->name }}</td>
                                            {{-- <td>{{ $data->user->id }}</td> --}}

                                            <td>{{ $data->addOn->name }}</td>
                                        {{-- <td>{{ $data->addOn->valuation }}</td> --}}
                                            
                                                {{-- <td>{{ $category['slug'] }}</td> --}}
                                            
                                            
                                            <td class="text-center">
                                                <div class="btn-group" role="group" aria-label="Second group">
                                                    {{-- <a href="{{ route('user.broker.business.show', $data['id']) }}" class="btn btn-sm btn-primary show-btn"><i class="fa fa-eye"></i></a> --}}
                                                {{-- </div> --}}
                                                {{-- <div class="btn-group" role="group" aria-label="Second group"> --}}
                                                    {{-- <a href="{{ route('user.broker.addon.show', $data['id']) }}" class="btn btn-sm btn-primary show-btn"><i>Add On</i></a> --}}
                                                    {{-- @if(auth()->user()->id == $data->user_id)
                                                    <a href="{{ route('user.business_add_on.edit', $data['id']) }}" class="btn btn-sm btn-primary edit-btn"><i class="fa fa-edit"></i></a>
                                                    @endif --}}
                                                    @if(auth()->user()->id != $data->user_id)
                                                    <a href="{{ route('user.broker.addonBid.show', $data['id']) }}" class="btn btn-sm btn-primary edit-btn">BID</i></a>
                                                    @endif

                                                    {{-- <a href="#" data-id="{{$data['id']}}" class="sa-remove btn btn-sm btn-danger edit-btn"><i class="fa fa-trash"></i></a> --}}
                                                </div>
                                            </td>
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