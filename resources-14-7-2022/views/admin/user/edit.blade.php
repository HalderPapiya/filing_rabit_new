@extends('admin.app')
@section('title') User @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-tags"></i> User</h1>
        </div>
    </div>
    @include('admin.partials.flash')
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="tile">
                <h3 class="tile-title">Edit User</h3>
                <form action="{{ route('admin.user.update',$user->id) }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $user->id }}">
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="abvp_no">ABVP NO</label>
                            <input class="form-control @error('abvp_no') is-invalid @enderror" type="text" name="abvp_no" id="abvp_no" value="{{$user->abvp_no }}"/>
                            @error('abvp_no') {{ $message ?? '' }} @enderror
                        </div>
                    </div>
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="member_name">Members Name <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('member_name') is-invalid @enderror" type="text" name="member_name" id="member_name" value="{{ $user->member_name }}"/>
                            @error('member_name') {{ $message ?? '' }} @enderror
                        </div>
                    </div>
                     <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="father_or_husband_name">Father Or Husband Name <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('father_or_husband_name') is-invalid @enderror" type="text" name="father_or_husband_name" id="father_or_husband_name" value="{{ $user->father_or_husband_name }}"/>
                            @error('father_or_husband_name') {{ $message ?? '' }} @enderror
                        </div>
                    </div>
                     <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="gender">Sex <span class="m-l-5 text-danger"> *</span></label>
                            <select name="gender" id="" class="form-control @error('gender') is-invalid @enderror">
                                <option value="Male" {{ $user->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ $user->gender == 'Female' ? 'selected' : '' }}>Female</option>
                            </select>
                            @error('gender') {{ $message ?? '' }} @enderror
                        </div>
                    </div>
                     <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="dob">DOB</label>
                            <input class="form-control @error('dob') is-invalid @enderror" type="date" name="dob" id="dob" value="{{ $user->dob }}"/>
                            @error('dob') {{ $message ?? '' }} @enderror
                        </div>
                    </div>
                     <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="ma">M.A</label>
                            <input class="form-control @error('ma') is-invalid @enderror" type="date" name="ma" id="ma" value="{{ $user->ma }}"/>
                            @error('ma') {{ $message ?? '' }} @enderror
                        </div>
                    </div>
                     <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="ma">AAdhaar No</label>
                            <input class="form-control @error('aadhar_no') is-invalid @enderror" type="text" name="aadhar_no" id="aadhar_no" value="{{ $user->aadhar_no }}"/>
                            @error('aadhar_no') {{ $message ?? '' }} @enderror
                        </div>
                    </div>
                     <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="qualification">Qualification</label>
                            <input class="form-control @error('qualification') is-invalid @enderror" type="text" name="qualification" id="qualification" value="{{ $user->qualification }}"/>
                            @error('qualification') {{ $message ?? '' }} @enderror
                        </div>
                    </div>
                     <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="blood_group">Blood Group</label>
                            <input class="form-control @error('blood_group') is-invalid @enderror" type="text" name="blood_group" id="blood_group" value="{{ $user->blood_group }}"/>
                            @error('blood_group') {{ $message ?? '' }} @enderror
                        </div>
                    </div>
                     <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="address">Address<span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('address') is-invalid @enderror" type="text" name="address" id="address" value="{{ $user->address }}"/>
                            @error('address') {{ $message ?? '' }} @enderror
                        </div>
                    </div>
                     <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="city">City<span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('city') is-invalid @enderror" type="text" name="city" id="city" value="{{ $user->city }}"/>
                            @error('city') {{ $message ?? '' }} @enderror
                        </div>
                    </div>
                     <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="pin_code">PIN<span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('pin_code') is-invalid @enderror" type="text" name="pin_code" id="pin_code" value="{{ $user->pin_code }}"/>
                            @error('pin_code') {{ $message ?? '' }} @enderror
                        </div>
                    </div>
                     <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="mobile_mo">Mobile Number</label>
                            <input class="form-control @error('mobile_mo') is-invalid @enderror" type="text" name="mobile_mo" id="mobile_mo" value="{{ $user->mobile_mo }}"/>
                            @error('mobile_mo') {{ $message ?? '' }} @enderror
                        </div>
                    </div>
                     <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="email">Email</label>
                            <input class="form-control @error('email') is-invalid @enderror" type="text" name="email" id="email" value="{{ $user->email }}"/>
                            @error('email') {{ $message ?? '' }} @enderror
                        </div>
                    </div>
                     {{-- <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="password">Password <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('password') is-invalid @enderror" type="text" name="password" id="password" value="{{ old('password') }}"/>
                            @error('password') {{ $message ?? '' }} @enderror
                        </div>
                    </div> --}}
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update</button>
                        &nbsp;&nbsp;&nbsp;
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection