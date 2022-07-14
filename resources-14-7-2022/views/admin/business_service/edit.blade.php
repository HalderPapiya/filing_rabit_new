@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
    <div class="fixed-row">
        <div class="app-title">
            <div class="active-wrap">
                <h1><i class="fa fa-tags"></i> {{ $pageTitle }}</h1>
                <div class="form-group">
                    <button class="btn btn-primary" type="button" id="btnSave"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update business Service</button>
                    <a class="btn btn-secondary" href="{{ route('admin.businessService.index') }}"><i class="fa fa-fw fa-lg fa fa-angle-left"></i>Back</a>
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
                <form action="{{ route('admin.businessService.update') }}" method="POST" role="form" enctype="multipart/form-data" id="form1">
                    @csrf
                    <div class="tile-body form-body">
                        <div class="form-group">
                            <label class="control-label" for="title"> Title <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" id="title" value="{{old('title', $businessServices->title) }}"/>
                            <input type="hidden" name="id" value="{{ $businessServices->id }}">
                            @error('title')<span class="invalid-feedback" role="alert"><strong> {{ $message }}</strong></span>@enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="categoryId">Category <span class="m-l-5 text-danger"> *</span></label>
                            {{-- <input class="form-control" type="readOnly"  value="{{$businessServices->category->title}} "/> --}}
                            <select class="form-control @error('categoryId') is-invalid @enderror" name="categoryId" id="categoryId" value="{{ old('
                            ') }}">
                                <option selected disabled>Select one</option>
                                @foreach($categories as $category)
                                <option value="{{$category->id}}" {{ ($businessServices->category_id == $category->id) ? 'selected' : '' }} >{{$category->title}}</option>
                                @endforeach
                            </select>
                            @error('categoryId')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="subcategoryId">Sub Category <span class="m-l-5 text-danger"> *</span></label>
                            {{-- <input class="form-control" type="readOnly"  value="{{$businessServices->subcategory->title}} "/> --}}
                            <select class="form-control @error('subcategoryId') is-invalid @enderror" name="subcategoryId" id="subcategoryId" value="{{ old('
                            ') }}">
                                <option selected disabled>Select one</option>
                                @foreach($subcategories as $subcategory)
                                <option value="{{$subcategory->id}}" {{ ($businessServices->sub_category_id == $subcategory->id) ? 'selected' : '' }}>{{$subcategory->title}}</option>
                                @endforeach
                            </select>
                            @error('subcategoryId')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="packageId">Package Name<span class="m-l-5 text-danger"> *</span></label>
                            {{-- <input class="form-control" type="readOnly"  value="{{$businessServices->package->name}} "/> --}}
                            <select class="form-control @error('packageId') is-invalid @enderror" name="packageId" id="packageId" value="{{ old('
                            ') }}">
                                <option selected disabled>Select one</option>
                                @foreach($packages as $package)
                                <option value="{{$package->id}}" {{ ($businessServices->package_id == $package->id) ? 'selected' : '' }}>{{$package->name}}</option>
                                @endforeach
                            </select>
                            @error('packageId')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group required">
                            <label for="description" class="control-label">Description</label>
                            <textarea name="description" id="description" rows="3"
                                class="form-control @error('description') is-invalid @enderror">{{ $businessServices->description }} </textarea>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="image">Image <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('image') is-invalid @enderror" type="file" name="image" id="image" value="{{old('image', $businessServices->image) }}" {{ ($businessServices->image) ? 'selected' : '' }}/>
                            @error('image')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span> @enderror
                        </div>
                        <img src="{{URL::to('/').'/uploads/BusinessService/'}}{{$businessServices->image}}" width="60" />
                        {{-- <div class="form-group">
                            <label class="control-label" for="name">Slug <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('slug') is-invalid @enderror" type="text" name="slug" id="slug" value="{{ old('slug',$category->slug) }}"/>
                            @error('slug') {{ $message }} @enderror
                        </div> --}}
                        
                        
                        {{-- <div class="form-group toogle-lg">
                            <label class="control-label">Status</label>
                            <div class="toggle-button-cover">
                                <div class="button-cover">
                                    <div class="button-togglr b2" id="button-11">
                                        <input id="toggle-block" type="checkbox" data-category_id="{{$category->id}}" name="status" class="checkbox" {{ $category->status == 1 ? 'checked' : '' }}>
                                        <div class="knobs"><span>Inactive</span></div>
                                        <div class="layer"></div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
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