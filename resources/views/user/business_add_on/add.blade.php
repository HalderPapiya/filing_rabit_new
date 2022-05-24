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
                    <form action="{{route('user.business_add_on.store')}}" method="POST">
                        @csrf
                        {{-- <input type="hidden" value="{{$address->id}}" name="id" class="form-control"> --}}
                        <div class="row">
                            {{-- <div class="col-md-6">
                                <div class="form-group">
                                    <label>Business Add-On Name</label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror">
                                    @error('name')<span class="invalid-feedback" role="alert"><strong> {{ $message }}</strong></span>@enderror
                                </div>
                            </div> --}}
                            <div class="form-group">
                                <label class="control-label" for="add_on_id">Business Add-On Name <span class="m-l-5 text-danger"> *</span></label>
                                <select class="form-control @error('add_on_id') is-invalid @enderror" name="add_on_id" id="add_on_id" value="{{ old('
                                    add_on_id') }}">
                                    <option selected disabled>Select one</option>
                                    @foreach($addOns as $data)
                                    <option value="{{$data->id}}">{{$data->name}}</option>
                                    @endforeach
                                </select>
                                @error('add_on_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label class="control-label" for="business_id">Business Name <span class="m-l-5 text-danger"> *</span></label>
                                <select class="form-control @error('type_id') is-invalid @enderror" name="business_id" id="business_id" value="{{ old('
                                    business_id') }}">
                                    <option selected disabled>Select one</option>
                                    @foreach($businessServices as $data)
                                    <option value="{{$data->id}}">{{$data->name}}</option>
                                    @endforeach
                                </select>
                                @error('type_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label> Valuation</label>
                                    <input type="text" name="valuation" class="form-control @error('valuation') is-invalid @enderror">
                                    @error('valuation')<span class="invalid-feedback" role="alert"><strong> {{ $message }}</strong></span>@enderror
                                </div>
                            </div>
                           
                            <div class="col-12">
                                <button type="submit" class="btn ur-submit-button w-auto">Save</button>
                            </div>
                            <div class="col-12">
                            @if (Session::has('success'))
                                   <div class="alert alert-success" role="alert">
                                    {{ Session::get('success') }}
                                </div>
                            @endif 
                            </div>
                        </div>
                    </form>
                   
                </div>
                
            </div>
        
        </div>
    </div>
</section>

@endsection