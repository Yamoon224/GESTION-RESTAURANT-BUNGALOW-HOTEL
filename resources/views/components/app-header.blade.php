<div class="az-header az-header-primary">
    <div class="container">
        <div class="az-header-left">
            <a class="az-logo" href="{{ route('dashboard') }}"><x-app-logo :width="70" :height="70"></x-app-logo></a>
            <a class="az-header-menu-icon d-lg-none" href="" id="azNavShow">
                <span></span>
            </a>
        </div>
        <div class="az-header-center text-white text-center" id="typed"></div>
        <div class="az-header-right">
            <div class="dropdown az-profile-menu">
                <a class="az-img-user" href="">
                    <img alt="" src="{{ uiavatar(auth()->user()->name) }}"/>
                </a>
                <div class="dropdown-menu">
                    <div class="az-dropdown-header d-sm-none">
                        <a class="az-header-arrow" href="">
                            <i class="icon ion-md-arrow-back"></i>
                        </a>
                    </div>
                    <div class="az-header-profile">
                        <div class="az-img-user">
                            <img alt="" src="{{ uiavatar(auth()->user()->name) }}"/>
                        </div>
                        <h6>{{ auth()->user()->firstname." ".auth()->user()->name }}</h6>
                        <span>{{ auth()->user()->group->name }}</span>
                    </div>
                    <a class="dropdown-item {{ Route::is('profile.index') ? 'active text-white' : '' }}" href="{{ route('profile.index') }}">
                        <i class="typcn typcn-user-outline"></i> @lang('locale.my_profile')
                    </a>
                    <a class="dropdown-item" href="{{ route('logout') }}">
                        <i class="typcn typcn-power-outline"></i> @lang('locale.logout')
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var typed = new Typed('#typed', {
        strings: ['BIENVENU A <b>EKLÔFE</b>', 'BUNGALOWS HÔTEL'],
        typeSpeed: 150,  
        smartBackspace: true,
        loop: true,
        loopCount: Infinity,
    });
</script>