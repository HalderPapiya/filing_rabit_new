@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
<div class="fixed-row">
    <div class="app-title">
        <div class="active-wrap">
            <h1><i class="fa fa-tags"></i> {{ $pageTitle }}</h1>
            <div class="form-group">
                <button class="btn btn-primary" type="button" id="btnSave"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save Setting</button>
                <a class="btn btn-secondary" href="{{ route('admin.setting.index') }}"><i style="vertical-align: baseline;" class="fa fa-chevron-left"></i>Back</a>
            </div>
        </div>
    </div>
</div>
@include('admin.partials.flash')
<div class="row section-mg row-md-body no-nav">
    <div class="col-md-12 mx-auto">
        <div class="tile">
            <form action="{{ route('admin.setting.store') }}" method="POST" role="form" enctype="multipart/form-data" id="form1">
                @csrf
                <div class="tile-body form-body">
                    <div class="form-group">
                        <label class="control-label" for="key">Key <span class="m-l-5 text-danger"> *</span></label>
                        <input class="form-control @error('key') is-invalid @enderror" type="text" name="key" id="key" value="{{ old('key') }}" />
                        @error('key')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span> @enderror
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="product_id">Product <span class="m-l-5 text-danger"> *</span></label>
                        <select name="product_id" id="product_id" class="form-control @error('product_id') is-invalid @enderror">
                            <option value="">--Select a product--</option>
                            @foreach($listProducts as $lps)
                            <option value="{{$lps->id}}">{{$lps->name}}</option>
                            @endforeach
                        </select>
                        @error('product_id')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span> @enderror
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="title">Title <span class="m-l-5 text-danger"> *</span></label>
                        <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" id="title" value="{{ old('title') }}" />
                        @error('title')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span> @enderror
                    </div>
                    <div class="form-group required">
                        <label for="description" class="control-label">Description</label>
                        <textarea name="description" id="description" rows="3" class="form-control @error('description') is-invalid @enderror"></textarea>
                        @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('scripts')
{{-- <script type="text/javascript">
    $(document).ready(function() {
        $("#btnSave").on("click", function() {
            if ($('#product_id').val() == '') {
                alert('Please Select a category!')
                return false
            }
            $('#form1').submit();
        })
    })
</script> --}}

<script type="text/javascript">
    $(document).ready(function(){
        $("#btnSave").on("click",function(){
            $('#form1').submit();
        })
    })
</script>
@endpush