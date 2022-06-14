@extends('frontend.layouts.master')
@section('content')
    <section class="py-4 py-lg-5">
        <div class="container">
            @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success')[0] }}
                </div>
            @endif
            <div class="row m-0">
                <h3 class="bd_title">{{ $businessService['name'] }}</h3>
            </div>

            <div class="row">
                <div class="col-sm-9">
                    <div class="card border-0 bdd_body">
                        <h3 class="text-muted">Rs.{{ number_format($businessService['valuation']) }}</h3>
                        <p class="d-flex">
                            {{-- <span class="mr-5">Rs.{{ number_format($businessService['valuation']) }}</b></span> --}}
                            {{-- <span class="mr-5">DURATION <b class="d-block">2 Months</b></span>
                            <span class="mr-5">STIPEND <b class="d-block">Performance Based</b></span>
                            <span class="mr-5">APPLY BY<b class="d-block">3 Jun' 22</b></span> --}}
                        </p>
                        <ul class="bl_tag mt-3 mb-4">
                            <li>{{ App\Models\BusinessType::where('id', $businessService['type_id'])->get('name')[0]->name }}
                            </li>
                            {{-- <li>Certified</li>
                        <li>Trainings</li> --}}
                        </ul>
                        <p>
                            {!! $businessService['description'] !!}
                        </p>
                        {{-- <p>
                            Internshala Student Partner 30 is a Campus Rep program aimed at building the leaders of tomorrow. We are hunting for the most passionate college students all over India who have the drive, the creativity, the influence, and the dedication to become Internshala’s face from their homes. During the entire duration of the program, you will learn to lead from the front and develop essential skills like marketing & communication. From time to time, you will be participating in various fun activities and contests with a fair chance of winning really cool rewards and performance-based stipends.
                        </p>
                        <h3 class="mt-3">About the work from home job/internship</h3>
                        
                        <p>The selected intern's day-to-day responsibilities include:</p>
                        
                        <ol>
                            <li>Promote Internshala internships among your peers and assist them in jump-starting their careers</li>
                            <li>Inform your peers about the latest training offers and help them up-skill themselves via Internshala Trainings</li>
                            <li>Become the new Internship guide among your peers by conducting online internship talks</li>
                            <li>Build the influencer vibe by participating in terrific social media contests and challenges</li>
                        </ol> --}}
                        <div class="broker_div mt-5">
                            <div class="broker_price">
                                <img src="{{ asset('frontend/img/logo1.png') }}" alt="">
                                <p>
                                    Broker Fee
                                    <a class="info">
                                        <i class="fas fa-info-circle text-warning"></i>
                                        <strong class="info_Text">
                                            When you purchase our Broker Service, you get a dedicated broker who will
                                            contact the current owner and negotiate a sale price on your behalf. If the
                                            seller agrees to sell the business, you pay the negotiated sale price plus a 2%
                                            commission, and we will securely transfer the business to you.
                                        </strong>
                                    </a>
                                    {{-- <span>Rs.{{ number_format($businessService['valuation']) }}</span> --}}
                                    <span>Rs.{{ number_format(5000) }}</span>
                                </p>
                            </div>
                            <div>
                                {{-- <a class="btn bide_btn" href="{{route('user.bid.create',[$businessService['id']])}}">Bid Now</a> --}}
                                <div class="d-flex bide_button">
                                    @if (Auth::guard('user')->user() && $businessService['user_id'] != Auth::guard('user')->user()->id)
                                        <a href="javascript:void(0)" class="btn bide_btn" id="details_bid_btn"
                                            data-toggle="modal" data-target="#bidModal">Bid</a>
                                    @elseif(!Auth::guard('user')->user())
                                        <a href="javascript:void(0)" class="btn bide_btn" id="details_bid_btn"
                                            data-toggle="modal" data-target="#loginModal">Bid</a>
                                    @else
                                        <a href="javascript:void(0)" class="btn bide_btn" id="details_bid_btn">Bid</a>
                                    @endif
                                </div>
                                <div class="modal fade" id="bidModal" tabindex="-1" role="dialog"
                                    aria-labelledby="bidModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <form action="{{ route('user.bid.store') }}" method="POST" class="modal-content">
                                            @csrf
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="bidModalLabel">BID</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <input type="hidden" name="business_id"
                                                        value="{{ $businessService['id'] }}">
                                                    <label>Set a Valuation</label>
                                                    <input type="text" name="valuation"
                                                        class="form-control @error('valuation') is-invalid @enderror">
                                                    @error('valuation')
                                                        <span class="invalid-feedback" role="alert"><strong>
                                                                {{ $message }}</strong></span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn bide_btn">BID</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <h5 class="text-muted text-right my-2">{{ count($businessAddOns) != 0 ? 'Addons' : 'No Addons' }}</h5>
                    <div class="right-part">
                        @foreach ($businessAddOns as $bs)
                            {{-- <a href="{{ route('user.businessService.show', [$bs->id]) }}"> --}}
                            <div class="card">
                                <h3>{{ $bs->addOn->name }}</h3>
                                {{-- <p>{{ strlen($bs->description) > 200 ? substr($bs->description, 0, 200) . '...' : $bs->description }} --}}
                                </p>
                                <h6>Rs.{{ number_format($bs->valuation) }}</h6>
                                <div class="d-flex justify-content-between align-items-center mt-4">
                                    {{-- <div>
                                        <ul class="bl_tag">
                                            <li>{{ App\Models\BusinessType::where('id', $bs->type_id)->get('name')[0]->name }}
                                            </li>
                                        </ul>
                                    </div> --}}
                                    <div>
                                        {{-- <a href="{{ Auth::guard('user')->user() ? route('user.businessService.show', [$bs->id]) : route('frontend.businessService.show', [$bs->id]) }}">View details <i class="fas fa-angle-right"></i></a> --}}
                                    </div>
                                </div>
                                @if ($bs->status == 0)
                                    <div class="logo_container">SOLD</div>
                                @endif
                            </div>
                            {{-- </a> --}}
                        @endforeach

                        {{-- {{ $businessAddOns->links() }} --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
