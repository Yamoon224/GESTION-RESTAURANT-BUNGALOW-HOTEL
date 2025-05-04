<x-auth-layout>
    <!-- Session Status -->
    <div class="az-signin-wrapper">
        <div class="az-card-signin">
            <a class="text-center" href="{{ route('welcome') }}"><x-app-logo></x-app-logo></a>
            <div class="az-signin-header">
                <h6 class="text-center {{ $errors->get('email') ? 'text-danger' : '' }}">{{ $errors->get('email') ? $errors->get('email')[0] : __('locale.pls_sign_to_continue') }}</h6>
                <form method="POST" action="{{ route('password.store') }}">
                    @csrf
                    <!-- Password Reset Token -->
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">
                    
                    <!-- Email Address -->
                    <div class="form-group">
                        <x-input-label for="email" :value="__('locale.email').' | '.__('locale.username')" />
                        <x-text-input id="email" type="text" name="email" placeholder="{{ __('locale.email').' | '.__('locale.username') }}" :value="old('email')" required autofocus autocomplete="off" />
                    </div>
            
                    <!-- Password -->
                    <div class="form-group">
                        <x-input-label for="password" :value="__('locale.password')" />
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-primary text-white">
                                    <i class="fa fa-eye-slash"></i>
                                </span>
                            </div>
                            <x-text-input id="password" type="password" name="password" placeholder="{{ __('locale.password') }}" required autocomplete="new-password" />
                        </div>
                    </div>
                    <!-- Password -->
                    <div class="form-group">
                        <x-input-label for="password_confirmation" :value="__('locale.password_confirmation')" />
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-primary text-white">
                                    <i class="fa fa-eye-slash"></i>
                                </span>
                            </div>
                            <x-text-input id="password_confirmation" type="password" name="password_confirmation" placeholder="{{ __('locale.password_confirmation') }}" required autocomplete="new-password" />
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