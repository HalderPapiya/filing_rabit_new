<div class="col-md-3">
    <nav class="sticky-top my-account-navigation">
        <ul>
            <li>
                <a href="{{ route('user.dashboard') }}">Dashboard</a>
            </li>
            @if(Auth::user()->type == 'user')
            <li>
                <a href="{{ route('user.order') }}">Orders</a>
            </li>
            <li>
                <a href="{{ route('user.download') }}">Downloads</a>
            </li>
            <li>
                <a href="{{ route('user.address') }}">Addresses</a>
            </li>
            <li class="">
                <a href="{{ route('user.account') }}">Account Details</a>
            </li>

            <li class="">
                <a href="{{ route('user.businessService.index') }}">Busisness List</a>
            </li>
            <li class="">
                <a href="{{ route('user.business_add_on.index') }}">Busisness Add On</a>
            </li>
            <li class="">
                <a href="{{ route('user.bid.index') }}">Busisness Bid List</a>
            </li>
            {{-- <li class="">
                <a href="{{ route('user.add_on_bid.index') }}">Busisness Addon Bid List</a>
            </li> --}}
            <li class="">
                <a href="{{ route('user.mail.index') }}">Mail</a>
            </li>
            @elseif(Auth::user()->type == 'broker')
            <li class="">
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