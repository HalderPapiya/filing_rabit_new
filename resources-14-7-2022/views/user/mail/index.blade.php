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
                <div class="row section-mg row-md-body no-nav">
                    <div>
                        <div class="tile">
                            <h3>All Messages</h3>
                            <table class="w-100 table table-hover custom-data-table-style table-striped">
                                <thead>
                                    <tr>
                                        <th>Product ID</th>
                                        <th>Product TYPE</th>
                                        <th>Product Name</th>
                                        <th>Sender</th>
                                        <th>Subject</th>
                                        <th>Message</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($mails as $mail)
                                    <tr>
                                        <td>{{$mail->product_id}}</td>
                                        @if($mail->product_type == "add_on")
                                        <td>Business Add On</td>
                                        <td>Add On</td>
                                        @else
                                        <td>Business</td>
                                        <td>{{App\Models\BusinessService::where('id',$mail->product_id)->get('name')[0]->name}}</td>
                                        @endif
                                        @if($mail->sender_id == Illuminate\Support\Facades\Auth::guard('user')->user()->id)
                                        <td>You</td>
                                        @else
                                        <td>Broker</td>
                                        @endif
                                        <td>{{$mail->subject}}</td>
                                        <td>{{$mail->message}}</td>
                                        <td><button class="btn btn-danger btn-sm">Send Reply</button></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            
                            {{-- <div>
                                <div class="tile-body form-body">
                                    <div class="form-group">
                                        <label class="control-label" for="title">Subject </label>
                                    </div>
                                     <div class="form-group required">
                                        body
                                    </div>
                                </div>
                            </div> --}}
                            {{-- <form> --}}
                                {{-- <div class="tile-body form-body">
                                    <div class="form-group">
                                        <label class="control-label" for="title">Subject </label>
                                       
                                    </div>
                                     <div class="form-group required">
                                        body
                                    </div>
                                </div> --}}
                            {{-- </form> --}}
                            {{-- @foreach ($senderMails as $mail)
                            <div>
                                <div class="tile-body form-body">
                                    <div class="form-group">
                                        <label class="control-label" for="title">Subject </label>
                                        {{$mail->subject}}
                                       
                                    </div>
                                     <div class="form-group required">
                                        {{$mail->message}}
                                    </div>
                                </div>
                            </div>
                            @endforeach --}}
                            {{-- @if($mails->count() > 0) --}}
                            {{-- <div class="app-title">
                                <div class="active-wrap">
                                    <div class="form-group">
                                     
                                        <p class="text-center">For Send New Mail
                                       
                                            <a class="button button-primary" href="{{route('user.mail.create')}}"> --}}
                                                {{-- <a class="button button-primary" href="{{route('user.broker.bid.mail',$bid->id)}}"> --}}
                                                {{-- Click Here
                                            </a>
                                        </p>
                                    </div>
                                </div> --}}
                            </div>
                            {{-- @else --}}
                            {{-- <div class="app-title">
                                <div class="active-wrap">
                                    <div class="form-group">
                                     
                                        <p class="text-center">No Mail
                                       
                                            
                                        </p>
                                    </div>
                                </div>
                            </div> --}}
                            {{-- @endif --}}
                        </div>
                    </div>
                </div>
                
            </div>
        
        </div>
    </div>
</section>

@endsection
@push('scripts')

@endpush