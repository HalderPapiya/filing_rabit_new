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
                <div>
                    <div>
                        <div class="tile">
                            <form action="{{route('user.broker.bid.mail.store')}}" method="post">
                                @csrf
                                <input type="hidden" name="product_id" value="{{$bid['pid']}}">
                                <input type="hidden" name="product_type" value="{{$bid['typeid']}}">
                                <input type="hidden" name="receiver_id" value="{{$bid['uid']}}">
                                
                                <input type="text" class="form-control my-2 @error('subject') is-invalid @enderror" value="{{@old('subject')}}" id="subject" name="subject" placeholder="Subject...">
                                @error('subject')<span class="invalid-feedback" role="alert"><strong> {{ $message }}</strong></span>@enderror

                                <textarea name="message" class="form-control my-2 @error('message') is-invalid @enderror" id="message" cols="30" placeholder="Message..." rows="10">{{@old('message')}}</textarea>    
                                @error('message')<span class="invalid-feedback" role="alert"><strong> {{ $message }}</strong></span>@enderror
                                
                                <button type="submit" class="btn btn-sm btn-primary">send</button>
                            </form>                            
                        </div>
                    </div>
                </div>
                
            </div>
        
        </div>
    </div>
</section>

@endsection

@section('script')
{{-- <script type="text/javascript">
    $(document).ready(function(){
        $("#btnSave").on("click",function(){
            $('#form1').submit();
        })
    })
</script> --}}

{{-- <script type="text/javascript">
    $('#mailForm').on('submit', function(event) {
        // event.preventDefault();
        alert();
        var receiver_id = $("input[name=receiver_id]").val();
        var subject = $("input[name=subject]").val();
        var message = $("input[name=message]").val();
        // var email = $(this).data('email');
        // var password = $(this).data('password');
        // var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        // "_token": "{{ csrf_token() }}",
        // var CSRF_TOKEN : "{{ csrf_token() }}",
        $.ajax({
            type:'POST',
            dataType:'JSON',
            url:"{{route('user.broker.bid.mail',$bid->id)}}",
            data:{ _token: '{{csrf_token()}}', receiver_id:receiver_id, subject:subject , message:message},
            success:function(response) {
                if(response.success == true){
                    $('#mailMessage').addClass('text-success').html(response.message);
                } else {
                    $('#mailMessage').addClass('text-danger').html(response.message);
                }
            },
            error: function(response) {
                $('#mailMessage').html(response.message);
                // console.log(error)
            }
        });
    });

</script> --}}
@endsection