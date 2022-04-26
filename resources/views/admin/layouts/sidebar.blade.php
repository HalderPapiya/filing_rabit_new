<div class="dashboard-menubar" id="sidebar">
    <div class="image-wrapper logo-wrapper customer-logo">
        <img src="{{ asset('admin/img/logo-inverse.png') }}" class="img-fluid logo">
    </div>
    <nav class="">
        <ul class=" menu">
            <li>
                <a class="app-menu__item  {{ Route::currentRouteName() == 'admin.dashboard' ? 'active' : '' }}"
                    href="{{ route('admin.dashboard') }}"><i class="app-menu__icon fa fa-dashboard"></i>
                    <span class="app-menu__label">Dashboard</span>
                </a>
            </li>
            <li>
                <a class="app-menu__item user {{ request()->is('admin/user*') ? 'active' : '' }}" href="{{ route('admin.user.index') }}"><i class="app-menu__icon fa fa-group"></i>
                    <span class="app-menu__label">User</span>
                </a>
            </li>
             <li>
                <a class="app-menu__item category {{ request()->is('admin/category*') ? 'active' : '' }}" href="{{ route('admin.category.index') }}"><i class="app-menu__icon fa fa-group"></i>
                    <span class="app-menu__label">Category</span>
                </a>
            </li>
            <li>
                <a class="app-menu__item package {{ request()->is('admin/package*') ? 'active' : '' }}" href="{{ route('admin.package.index') }}"><i class="app-menu__icon fa fa-group"></i>
                    <span class="app-menu__label">Package</span>
                </a>
            </li>
            <li>
                <a class="dropdown-item" href=""  onclick="event.preventDefault();
                     document.getElementById('logout-form').submit();"><i class="fa fa-sign-out fa-lg"></i> Logout</a>
            </li>
            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                @csrf
            </form>
            </li>
        </ul>
    </nav>
</div>
