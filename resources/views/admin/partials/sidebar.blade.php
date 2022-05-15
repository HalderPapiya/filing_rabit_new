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
            <a class="app-menu__item banner {{ request()->is('admin/banner*') ? 'active' : '' }}" href="{{ route('admin.banner.index') }}"><i class="app-menu__icon fa fa-group"></i>
                <span class="app-menu__label">Banner</span>
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
        <li>
            <a class="app-menu__item sub-subcategory {{ request()->is('admin/sub-subcategory*') ? 'active' : '' }}" href="{{ route('admin.sub-subcategory.index') }}"><i class="app-menu__icon fa fa-group"></i>
                <span class="app-menu__label">Sub-Subcategory</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item why-us {{ request()->is('admin/why-us*') ? 'active' : '' }}" href="{{ route('admin.why-us.index') }}"><i class="app-menu__icon fa fa-group"></i>
                <span class="app-menu__label">Why Us</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item businessService {{ request()->is('admin/businessService*') ? 'active' : '' }}" href="{{ route('admin.businessService.index') }}"><i class="app-menu__icon fa fa-group"></i>
                <span class="app-menu__label">Business Service</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item package {{ request()->is('admin/package*') ? 'active' : '' }}" href="{{ route('admin.package.index') }}"><i class="app-menu__icon fa fa-group"></i>
                <span class="app-menu__label">Package</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item testimonial {{ request()->is('admin/testimonial*') ? 'active' : '' }}" href="{{ route('admin.testimonial.index') }}"><i class="app-menu__icon fa fa-group"></i>
                <span class="app-menu__label">Testimonial</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item contact_us {{ request()->is('admin/contact-us*') ? 'active' : '' }}" href="{{ route('admin.contact-us.index') }}"><i class="app-menu__icon fa fa-group"></i>
                <span class="app-menu__label">Contact Us</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item about_us {{ request()->is('admin/about-us*') ? 'active' : '' }}" href="{{ route('admin.about-us.index') }}"><i class="app-menu__icon fa fa-group"></i>
                <span class="app-menu__label">About Us</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item industries_serve {{ request()->is('admin/industries-serve*') ? 'active' : '' }}" href="{{ route('admin.industries_serve.index') }}"><i class="app-menu__icon fa fa-group"></i>
                <span class="app-menu__label">Industries Serve</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item process {{ request()->is('admin/process*') ? 'active' : '' }}" href="{{ route('admin.process.index') }}"><i class="app-menu__icon fa fa-group"></i>
                <span class="app-menu__label">Process</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item setting {{ request()->is('admin/setting*') ? 'active' : '' }}" href="{{ route('admin.setting.index') }}"><i class="app-menu__icon fa fa-group"></i>
                <span class="app-menu__label">Settings</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item product {{ request()->is('admin/product*') ? 'active' : '' }}" href="{{ route('admin.product.index') }}"><i class="app-menu__icon fa fa-group"></i>
                <span class="app-menu__label">Product</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item product {{ request()->is('admin/coupon*') ? 'active' : '' }}" href="{{ route('admin.coupon.index') }}"><i class="app-menu__icon fa fa-group"></i>
                <span class="app-menu__label">Coupon</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item description {{ request()->is('admin/description*') ? 'active' : '' }}" href="{{ route('admin.description.index') }}"><i class="app-menu__icon fa fa-group"></i>
                <span class="app-menu__label">Product Description</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item business_type {{ request()->is('admin/business_type*') ? 'active' : '' }}" href="{{ route('admin.business_type.index') }}"><i class="app-menu__icon fa fa-group"></i>
                <span class="app-menu__label">Business Type</span>
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