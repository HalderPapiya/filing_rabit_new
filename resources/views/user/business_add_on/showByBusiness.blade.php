@extends('frontend.layouts.master')
@section('content')
    <style>
        .pagination {
            float: right;
        }

    </style>

    <section class="py-4 py-lg-5">
        <div class="container">
            <div class="row m-0">
                <div class="left-part col-12 col-lg-4 pr-lg-5">
                    <h4 class="mb-4">Filter</h4>
                    {{-- <form
                        action="{{ Auth::guard('user')->user() ? route('user.businessService.index') : route('frontend.businessService.index') }}">
                        <div class="card">
                            <h6 class="mb-4">Name</h6>
                            <div class="form-group">
                                <input type="text" name="name" class="form-control" placeholder="e.g. xyz pvt ltd">
                            </div>
                            <h6 class="mb-4">Valuation</h6>
                            <div class="form-group">
                                <input type="text" name="valuation" class="form-control" placeholder="e.g. 100000">
                            </div>
                            <h6 class="mb-4">Category</h6>
                            <div class="form-group">
                                <select type="text" name="type_id" class="form-control" placeholder="e.g. IT Industry">
                                    <option value="">Select a catgory</option>
                                    @foreach ($types as $type)
                                        <option value="{{ $type->id }}" style="color: black">{{ $type->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <button class="btn-sm btn btn-outline-success">Search</button>
                    </form> --}}
                </div>
                <div class="right-part col-12 col-lg-8 pl-lg-5 border-left">
                    @foreach ($businessAddOns as $bs)
                        <a href="{{ route('user.businessService.show', [$bs->id]) }}">
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
                                        <a
                                            href="{{ Auth::guard('user')->user() ? route('user.businessService.show', [$bs->id]) : route('frontend.businessService.show', [$bs->id]) }}">View
                                            details <i class="fas fa-angle-right"></i></a>
                                    </div>
                                </div>
                                @if ($bs->status == 0)
                                    <div class="logo_container">SOLD</div>
                                @endif
                            </div>
                        </a>
                    @endforeach

                    {{-- {{ $businessAddOns->links() }} --}}
                </div>
            </div>
        </div>
    </section>
@endsection
