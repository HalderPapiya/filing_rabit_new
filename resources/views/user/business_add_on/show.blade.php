@extends('frontend.layouts.master')
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
                        <h3>Business Add on</h3>
                        <form action="{{route('user.business_add_on.update')}}" method="POST">
                            @csrf
                            <input type="hidden" value="{{$businessAddOn->id}}" name="id" class="form-control">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Business Add on Name</label>
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{$businessAddOn->addOn->name}}">
                                        @error('name')<span class="invalid-feedback" role="alert"><strong> {{ $message }}</strong></span>@enderror
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="control-label" for="type_id">Type <span class="m-l-5 text-danger"> *</span></label>
                                    <input type="readOnly" name="name" class="form-control @error('name') is-invalid @enderror" value="{{$businessAddOn->business->name}}">
                                  
                                </div>
                                {{-- <div class="form-group">
                                    
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
                                </div> --}}
                                <div class="col-12">
                                    <div class="form-group">
                                        <label> Valuation</label>
                                        <input type="text" name="valuation" class="form-control @error('valuation') is-invalid @enderror" value="{{old('valuation', $businessAddOn->valuation) }}">
                                        @error('valuation')<span class="invalid-feedback" role="alert"><strong> {{ $message }}</strong></span>@enderror
                                    </div>
                                </div>
                               
                                {{-- <div class="col-12">
                                    <button type="submit" class="btn ur-submit-button w-auto">Update Business Service</button>
                                </div> --}}
                            </div>
                        </form>
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