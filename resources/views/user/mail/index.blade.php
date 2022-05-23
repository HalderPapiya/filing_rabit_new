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
                    <div class="col-md-4 mx-auto">
                        <div class="tile">
                            @foreach ($mails as $mail)
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
                            @endforeach
                            
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
                            @foreach ($senderMails as $mail)
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
                            @endforeach
                            <div class="app-title">
                                <div class="active-wrap">
                                    <div class="form-group">
                                     
                                        <p class="text-center">For Send New Mail
                                       
                                            <a class="button button-primary" href="{{route('user.mail.create')}}">
                                                {{-- <a class="button button-primary" href="{{route('user.broker.bid.mail',$bid->id)}}"> --}}
                                                Click Here
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </div>
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