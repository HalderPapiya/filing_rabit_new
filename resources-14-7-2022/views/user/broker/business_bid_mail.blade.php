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
                            {{-- @foreach ($Mails as $mail)
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
                            <table class="w-100 table table-hover custom-data-table-style table-striped">
                            <thead>
                                <tr>
                                    <th>Subject</th>
                                    <th>Message</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if(count($chats)==0)
                            <tr>
                                <td colspan="2" style="text-align: center;"> No chats yet! </td>
                            </tr>
                            @else
                            @foreach ($chats as $chat)
                                <tr class="tile-body form-body">
                                    <td>
                                        {{$chat->subject}}
                                    </td>
                                     <td>
                                        {{$chat->message}}
                                    </td>
                                </tr>
                            @endforeach
                            @endif
                            </tbody>
                            </table>

                            <div class="app-title">
                                <div class="active-wrap">
                                    <div class="form-group">
                                        {{-- <button class="btn btn-primary" type="button" id="btnSave"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save Category</button> --}}
                                        {{-- <a class="btn btn-primary" href=""><i style="vertical-align: baseline;" class=""></i>Send Mail</a> --}}
                                        <p class="text-center">For Send New Mail
                                            {{-- <a class="button button-primary" href="#" data-toggle="modal" data-target="#mailModal" data-dismiss="modal">
                                                Click Here
                                            </a> --}}
                                             {{-- <a class="button button-primary" href="#" data-toggle="modal" data-target="#mailModal" data-dismiss="modal">
                                                Click Here
                                            </a> --}}
                                            <a href="{{route('user.broker.bid.mail',[$pid,$bid->user_id,$typeid])}}">
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