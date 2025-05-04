<x-auth-layout>
    <!-- Session Status -->
    <div class="az-signin-wrapper">
        <div class="az-card-signin">
            <a class="text-center" href="{{ route('welcome') }}"><x-app-logo></x-app-logo></a>
            <div class="az-signin-header">
                <h6 class="text-center text-{{ $errors->get('password') ? 'danger' : 'success' }}">{{ $errors->get('password') ? $errors->get('password')[0] : __('locale.confirm_password_message') }}</h6>
                <form method="POST" action="{{ route('password.confirm') }}">
                    @csrf
                                
                    <!-- Password -->
                    <div class="form-group">
                        <x-input-label for="password" :value="__('locale.password')" />
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-primary text-white">
                                    <i class="fa fa-eye-slash"></i>
                                </span>
                            </div>
                            <x-text-input id="password" type="password" name="password" placeholder="{{ __('locale.password') }}" required autocomplete="current-password" />
                        </div>
                    </div>
            
                    <x-app-button class="btn-warning btn-block">@lang('locale.submit')</x-app-button>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <x-app-pwd-script></x-app-pwd-script>
    @endpush
</x-auth-layout>
