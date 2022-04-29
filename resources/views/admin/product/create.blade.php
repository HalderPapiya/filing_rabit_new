@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
    <div class="fixed-row">
        <div class="app-title">
            <div class="active-wrap">
                <h1><i class="fa fa-tags"></i> {{ $pageTitle }}</h1>
                <div class="form-group">
                    <button class="btn btn-primary" type="button" id="btnSave"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save Product</button>
                    <a class="btn btn-secondary" href="{{ route('admin.product.index') }}"><i style="vertical-align: baseline;" class="fa fa-chevron-left"></i>Back</a>
                </div>
            </div>
        </div>
    </div>
    @include('admin.partials.flash')
    <div class="row section-mg row-md-body no-nav">
        <div class="col-md-12 mx-auto">
            <div class="tile">
                <form action="{{ route('admin.product.store') }}" method="POST" role="form" enctype="multipart/form-data" id="form1">
                    @csrf
                    <div class="tile-body form-body">
                        <div class="form-group">
                            <label class="control-label" for="name">Name <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="name" value="{{ old('name') }}"/>
                            @error('name')<span class="invalid-feedback" role="alert"><strong> {{ $message }}</strong></span>@enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="categoryId">Category <span class="m-l-5 text-danger"> *</span></label>
                            <select class="form-control @error('categoryId') is-invalid @enderror" name="categoryId" id="categoryId" value="{{ old('
                            ') }}">
                                <option selected disabled>Select one</option>
                                @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->title}}</option>
                                @endforeach
                            </select>
                            @error('categoryId')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="subCategoryId">SubCategory <span class="m-l-5 text-danger"> *</span></label>
                            <select class="form-control @error('subCategoryId') is-invalid @enderror" name="subCategoryId" id="categoryId" value="{{ old('
                            ') }}">
                                <option selected disabled>Select one</option>
                                @foreach($subCategories as $subCategory)
                                <option value="{{$subCategory->id}}">{{$subCategory->title}}</option>
                                @endforeach
                            </select>
                            @error('subCategoryId')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="type_one_name">Type One Name <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('type_one_name') is-invalid @enderror" type="text" name="type_one_name" id="type_one_name" value="{{ old('type_one_name') }}"/>
                            @error('type_one_name')<span class="invalid-feedback" role="alert"><strong> {{ $message }}</strong></span>@enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="type_two_name">Type Two Name <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('type_two_name') is-invalid @enderror" type="text" name="type_two_name" id="type_two_name" value="{{ old('type_two_name') }}"/>
                            @error('type_two_name')<span class="invalid-feedback" role="alert"><strong> {{ $message }}</strong></span>@enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="type_one_description">Type One Description <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('type_one_description') is-invalid @enderror" type="text" name="type_one_description" id="type_one_description" value="{{ old('type_one_description') }}"/>
                            @error('type_one_description')<span class="invalid-feedback" role="alert"><strong> {{ $message }}</strong></span>@enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="type_two_description">Type Two Description <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('type_two_description') is-invalid @enderror" type="text" name="type_two_description" id="type_two_description" value="{{ old('type_two_description') }}"/>
                            @error('type_two_description')<span class="invalid-feedback" role="alert"><strong> {{ $message }}</strong></span>@enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="type_one_price">Type One Price  <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('type_one_price') is-invalid @enderror" type="text" name="type_one_price" id="type_one_price" value="{{ old('type_one_price') }}"/>
                            @error('type_one_price')<span class="invalid-feedback" role="alert"><strong> {{ $message }}</strong></span>@enderror
                        </div>
                         <div class="form-group">
                            <label class="control-label" for="type_two_price">Type Two Price <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('type_two_price') is-invalid @enderror" type="text" name="type_two_price" id="type_two_price" value="{{ old('type_two_price') }}"/>
                            @error('type_two_price')<span class="invalid-feedback" role="alert"><strong> {{ $message }}</strong></span>@enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="image">Image <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('image') is-invalid @enderror" type="file" name="image" id="image" value="{{ old('image') }}"/>
                            @error('image')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span> @enderror
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