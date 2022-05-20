<div class="modal fade login_modal" id="mailModal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">x</span>
                                        </button>
                                        <div class="row m-0">
                                            <div class="col-sm-12 p-0">
                                                <div class="login_block">
                                                    <a href="https://filingrabbit.in/" rel="home" class="login_logo">
                                                        <img src="{{asset('frontend/img/logo.png')}}" >
                                                    </a>
                                                    {{-- <p class="text-center">or</p> --}}
                                                    <div class="user-mail ur-frontend-form  " id="user-mail-form-784">
                                                        <form class="mailForm" action="{{route('user.broker.bid.mail.store')}}" method="POST" id="mailForm">
                                                            @csrf
                                                            <input class="form-control"  type="hidden" name="receiver_id" id="receiver_id" value="{{$bid->user_id}}">
                                                            
                                                            <div class="ur-form-row">
                                                                <div class="ur-form-grid ur-grid-1" style="width:99%">
                                                                    <div data-field-id="subject" class="ur-field-item field-subject ">
                                                                        <div class="form-group">
                                                                            <label class="d-block">Subject</label>
                                                                            <span class="input-wrapper">
                                                                                <input class="form-control @error('subject') is-invalid @enderror"  type="text" name="subject" id="subject">
                                                                                @error('subject')<span class="invalid-feedback" role="alert"><strong> {{ $message }}</strong></span>@enderror
                                                                            </span> 
                                                                        </div>
                                                                    </div>
                                                                   
                                                                    <div data-field-id="message" class="ur-field-item field-message ">
                                                                        <div class="form-group">
                                                                            <label class="d-block">Body</label>
                                                                            <span class="input-wrapper">
                                                                                <input class="form-control" type="text" name="message" id="message">
                                                                            </span> 
                                                                        </div>
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                            <div class="ur-button-container ">
                                                                <button type="submit" class="btn button ur-submit-button">Send</button>
                                                            </div>
                                                            @if(Session::has('message'))
                                                            <p class="alert alert-info">{{ Session::get('message') }}</p>
                                                            @endif
                                                        </form>
                    
                                                        <div style="clear:both"></div>
                                                    </div>
                    
                                                   
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>