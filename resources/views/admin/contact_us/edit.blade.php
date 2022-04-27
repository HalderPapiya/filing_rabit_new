@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
    <div class="fixed-row">
        <div class="app-title">
            <div class="active-wrap">
                <h1><i class="fa fa-tags"></i> {{ $pageTitle }}</h1>
                <div class="form-group">
                    <button class="btn btn-primary" type="button" id="btnSave"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update Contact Us</button>
                    <a class="btn btn-secondary" href="{{ route('admin.contact-us.index') }}"><i class="fa fa-fw fa-lg fa fa-angle-left"></i>Back</a>
                </div>
            </div>
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
        <div class="col-md-12 mx-auto">
            <div class="tile">
                <form action="{{ route('admin.contact-us.update') }}" method="POST" role="form" enctype="multipart/form-data" id="form1">
                    @csrf
                    <div class="tile-body form-body">
                        <div class="form-group">
                            <label class="control-label" for="title">Title <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" id="title" value="{{ old('title', $data->title) }}"/>
                            <input type="hidden" name="id" value="{{ $data->id }}">
                            @error('title') {{ $message }} @enderror
                        </div>
                        
                        <div class="form-group">
                            <label class="control-label" for="image">Image <span class="m-l-5 text-danger"> *</span></label>
                               <input class="form-control @error('image') is-invalid @enderror" type="file" name="image" id="image" value="{{ old('image') }}"/>
                         
                            @error('image')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span> @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="banner">Banner <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('banner') is-invalid @enderror" type="file" name="banner" id="banner" value="{{ old('banner') }}"/>
                            @error('banner')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span> @enderror
                        </div>
                       
                        <div class="form-group">
                            <label class="control-label" for="email">Email <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('email') is-invalid @enderror" type="text" name="email" id="email" value="{{ old('email', $data->email) }}"/>
                            @error('email')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span> @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="address">Address <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('address') is-invalid @enderror" type="text" name="address" id="address" value="{{ old('address', $data->address) }}"/>
                            @error('address')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span> @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="sales_phone">Sales Phone <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('sales_phone') is-invalid @enderror" type="text" name="sales_phone" id="sales_phone" value="{{ old('sales_phone', $data->sales_phone) }}"/>
                            @error('sales_phone')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span> @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="support_phone">Support Phone <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('support_phone') is-invalid @enderror" type="text" name="support_phone" id="support_phone"  value="{{ old('support_phone', $data->support_phone) }}"/>
                            @error('support_phone')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span> @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="facebook_link">Facebook Link <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('facebook_link') is-invalid @enderror" type="text" name="facebook_link" id="facebook_link" value="{{ old('facebook_link', $data->facebook_link) }}"/>
                            @error('facebook_link')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span> @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="twitter_link">Twitter Link <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('twitter_link') is-invalid @enderror" type="text" name="twitter_link" id="twitter_link" value="{{ old('twitter_link', $data->twitter_link) }}"/>
                            @error('twitter_link')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span> @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="instagram_link">instagram_link <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('instagram_link') is-invalid @enderror" type="text" name="instagram_link" id="instagram_link" value="{{ old('instagram_link', $data->instagram_link) }}"/>
                            @error('instagram_link')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span> @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="pinterest_link">Pinterest Link <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('pinterest_link') is-invalid @enderror" type="text" name="pinterest_link" id="pinterest_link"  value="{{ old('pinterest_link', $data->pinterest_link) }}"/>
                            @error('pinterest_link')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span> @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="youtube_link">Youtube Link <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('youtube_link') is-invalid @enderror" type="text" name="youtube_link" id="youtube_link" value="{{ old('youtube_link', $data->youtube_link) }}"/>
                            @error('youtube_link')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span> @enderror
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript">
        $("#btnSave").on("click",function(){
            $('#form1').submit();
        })
    </script>
@endpush