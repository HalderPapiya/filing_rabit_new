<div class="col-md-3">
    <nav class="sticky-top my-account-navigation">
        <ul>
            <li>
                <a href="{{ route('user.dashboard') }}">Dashboard</a>
            </li>
            <li>
                <a href="{{ route('user.order') }}">Orders</a>
            </li>
            <li>
                <a href="{{ route('user.download') }}">Downloads</a>
            </li>
            <li>
                <a href="{{ route('user.address') }}">Addresses</a>
            </li>
            <li class="active">
                <a href="{{ route('user.account') }}">Account Details</a>
            </li>
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