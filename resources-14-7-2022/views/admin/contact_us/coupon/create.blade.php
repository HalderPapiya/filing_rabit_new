@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
    <div class="fixed-row">
        <div class="app-title">
            <div class="active-wrap">
                <h1><i class="fa fa-tags"></i> {{ $pageTitle }}</h1>
                <div class="form-group">
                    <button class="btn btn-primary" type="button" id="btnSave"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save Coupon</button>
                    <a class="btn btn-secondary" href="{{ route('admin.coupon.index') }}"><i style="vertical-align: baseline;" class="fa fa-chevron-left"></i>Back</a>
                </div>
            </div>
        </div>
    </div>
    @include('admin.partials.flash')
    <div class="row section-mg row-md-body no-nav">
        <div class="col-md-12 mx-auto">
            <div class="tile">
                <form action="{{ route('admin.coupon.store') }}" method="POST" role="form" enctype="multipart/form-data" id="form1">
                    @csrf
                    <div class="tile-body form-body">
                        <div class="form-group">
                            <label class="control-label" for="name">Name <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="name" value="{{ old('name') }}"/>
                            @error('name')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span> @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="coupon_code">Coupon Code <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('coupon_code') is-invalid @enderror" type="text" name="coupon_code" id="coupon_code" value="{{ old('coupon_code') }}"/>
                            @error('coupon_code')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span> @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="amount">Amount <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('amount') is-invalid @enderror" type="text" name="amount" id="amount" value="{{ old('amount') }}"/>
                            @error('amount')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span> @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="max_time_of_use">Maximum Usage Time <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('max_time_of_use') is-invalid @enderror" type="max_time_of_use" name="max_time_of_use" id="max_time_of_use" value="{{ old('max_time_of_use') }}"/>
                            @error('max_time_of_use')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span> @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="max_time_one_can_use">Maximum Time One Can Use <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('max_time_one_can_use') is-invalid @enderror" type="text" name="max_time_one_can_use" id="max_time_one_can_use" value="{{ old('max_time_one_can_use') }}"/>
                            @error('max_time_one_can_use')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span> @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="no_of_usage">No of Usage <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('no_of_usage') is-invalid @enderror" type="text" name="no_of_usage" id="no_of_usage" value="{{ old('no_of_usage') }}"/>
                            @error('no_of_usage')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span> @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="start_date">Start Date <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('start_date') is-invalid @enderror" type="date" name="start_date" id="start_date" value="{{ old('start_date') }}"/>
                            @error('start_date')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span> @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="end_date">End Date <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('end_date') is-invalid @enderror" type="date" name="end_date" id="end_date" value="{{ old('end_date') }}"/>
                            @error('end_date')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span> @enderror
                        </div>
                         
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        $("#btnSave").on("click",function(){
            $('#form1').submit();
        })
    })
</script>
@endpush