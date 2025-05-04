<div class="az-navbar az-navbar-two az-navbar-dashboard-eight">
    <div class="container">
        <div class="az-navbar-header">
            <a class="az-logo" href="{{ route('dashboard') }}"><x-app-logo :width="70" :height="70"></x-app-logo></a>
        </div>
        <div class="az-navbar-search"></div>
        <ul class="nav">
            <li class="nav-label">Main Menu</li>
            <li class="nav-item {{ Route::is('dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <i class="fa fa-clipboard"></i> @lang('locale.dashboard')
                </a>
            </li>
            
            <li class="nav-item {{ Route::is('orders.index') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('orders.index') }}">
                    <i class="fa fa-shopping-bag"></i> @lang('locale.order', ['suffix'=>'s', 'prefix'=>''])
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link with-sub" href="">
                    <i class="fa fa-utensils"></i>@lang('locale.kitchen')
                </a>
                <ul class="nav-sub">
                    <li class="nav-sub-item {{ Route::is('products.index') ? 'active' : '' }}">
                        <a class="nav-sub-link" href="{{ route('products.index') }}"><i class="fa fa-utensils"></i>- @lang('locale.product', ['prefix'=>'', 'suffix'=>'s'])</a> 
                    </li>
                    @if(isAuthorize([1, 2]))
                    <li class="nav-sub-item {{ Route::is('ingredients.index') ? 'active' : '' }}">
                        <a class="nav-sub-link" href="{{ route('ingredients.index') }}"><i class="fa fa-list"></i>- @lang('locale.ingredient', ['prefix'=>'', 'suffix'=>'s'])</a> 
                    </li>
                    <li class="nav-sub-item {{ Route::is('categories.index') ? 'active' : '' }}">
                        <a class="nav-sub-link" href="{{ route('categories.index') }}"><i class="fa fa-list"></i>- @lang('locale.category', ['suffix'=>app()->getLocale() == 'en' ? 'ies' : 's', 'prefix'=>''])</a> 
                    </li>
                    @endif
                </ul>
            </li>
            @if(isAuthorize([1]))
            <li class="nav-item">
                <a class="nav-link with-sub" href="">
                    <i class="fa fa-users"></i>@lang('locale.administration')
                </a>
                <ul class="nav-sub">
                    <li class="nav-sub-item {{ Route::is('users.index') ? 'active' : '' }}">
                        <a class="nav-sub-link" href="{{ route('users.index') }}"><i class="fa fa-users"></i>- @lang('locale.user', ['prefix'=>'', 'suffix'=>'s'])</a> 
                    </li>
                </ul>
            </li>
            @endif
        </ul>
    </div>
</div>