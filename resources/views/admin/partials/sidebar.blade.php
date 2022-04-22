<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <ul class="app-menu">
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
            <a class="app-menu__item blog {{ request()->is('admin/blog*') ? 'active' : '' }}" href="{{ route('admin.blog.index') }}"><i class="app-menu__icon fa fa-group"></i>
                <span class="app-menu__label">Blog</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item category {{ request()->is('admin/category*') ? 'active' : '' }}" href="{{ route('admin.category.index') }}"><i class="app-menu__icon fa fa-group"></i>
                <span class="app-menu__label">Category</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item subcategory {{ request()->is('admin/subcategory*') ? 'active' : '' }}" href="{{ route('admin.subcategory.index') }}"><i class="app-menu__icon fa fa-group"></i>
                <span class="app-menu__label">Subcategory</span>
            </a>
        </li>
    </ul>
</aside>

<script>
    $urlData = document.getElementsByClassName('app-menu__item');
    $a = window.location.href;
    console.log($a)
    if($a.includes('banner')){
        $urlData.add('active');
    }else{
        console.log('false')
    }
</script>