<div class="col-md-3">
    <nav class="sticky-top my-account-navigation">
        <ul>
            <li class="{{ request()->is('user/dashboard*') ? 'active' : '' }}">
                <a href="{{ route('user.dashboard') }}">Dashboard</a>
            </li>
            @if(Auth::user()->type == 'user')
            <li class="{{ request()->is('user/order*') ? 'active' : '' }}">
                <a href="{{ route('user.order') }}">Orders</a>
            </li>
            <li class="{{ request()->is('user/download*') ? 'active' : '' }}">
                <a href="{{ route('user.download') }}">Downloads</a>
            </li>
            <li class="{{ request()->is('user/address*') ? 'active' : '' }}">
                <a href="{{ route('user.address') }}">Addresses</a>
            </li>
            <li class="{{ request()->is('user/account*') ? 'active' : '' }}">
                <a href="{{ route('user.account') }}">Account Details</a>
            </li>
            {{-- <li class="{{ request()->is('user/businessService/myBusiness*') || request()->is('user/business_add_on*') || request()->is('user/businessService/*') ? 'active' : '' }}">
                <a href="{{ route('user.businessService.myBusiness') }}">My Business</a>
            </li> --}}
            {{--<li class="{{ request()->is('user/business_add_on*') ? 'active' : '' }}">
            <a href="{{ route('user.business_add_on.index') }}">Busisness Add On Listing</a>
            </li>--}}


            {{-- <li class="{{ request()->is('user/businessServices*') ? 'active' : '' }}">
                <a href="{{ route('user.businessService.index') }}">Business Listing</a>
            </li> --}}
            {{-- <li class="{{ request()->is('user/businessService/new*') ? 'active' : '' }}">
                <a href="{{ route('user.businessService.newShow') }}">Business New Show</a>
            </li> --}}


            

            {{-- <li class="{{ request()->is('user/bid*') ? 'active' : '' }}">
                <a href="{{ route('user.bid.index') }}">Busisness Bid List</a>
            </li> --}}
            {{-- <li class="">
                <a href="{{ route('user.add_on_bid.index') }}">Busisness Addon Bid List</a>
            </li> --}}
            {{-- <li class="{{ request()->is('user/user/mail*') ? 'active' : '' }}">
                <a href="{{ route('user.mail.index') }}">Mail</a>
            </li> --}}
            @elseif(Auth::user()->type == 'broker')
            <li class="{{ request()->is('user/broker*') ? 'active' : '' }}">
                <a href="{{ route('user.broker.business.index') }}">Bid</a>
            </li>
            @endif
            {{-- <li>
                <a href="{{url('user-logout')}}">Logout</a>
            </li> --}}
            <li>
                <a class="btn btn-read btn-hover" href="{{ route('user.logout') }}" onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                    Logout
                </a>
                <form id="logout-form" action="{{url('user/logout')}}" method="POST">
                    @csrf
                </form>
            </li>
        </ul>
    </nav>
</div>