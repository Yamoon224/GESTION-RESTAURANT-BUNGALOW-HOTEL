<x-app-layout>
    <div class="az-content az-content-dashboard-eight">
        <div class="container d-block">
            <div class="row">
                <div class="col-md-5 mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <div class="az-content-body az-content-body-contacts">
                                <div class="az-contact-info-header">
                                    <div class="media">
                                        <div class="az-img-user">
                                            <img alt="" src="{{ uiavatar(auth()->user()->name) }}"/>
                                        </div>
                                        <div class="media-body">
                                            <h5 class="text-capitalize">{{ auth()->user()->group->name }}</h5>
                                            <p>{{ auth()->user()->firstname." ".auth()->user()->name }}</p>
                                        </div>
                                    </div>
                                    <div class="az-contact-action">
                                        <a data-toggle="modal" data-target="#pwd-change">
                                            <i class="typcn typcn-edit"></i> @lang('locale.password')
                                        </a>
                                    </div>
                                </div>
                                <div class="az-contact-info-body">
                                    <div class="media-list">
                                        <div class="media">
                                            <div class="media-icon">
                                                <i class="fas fa-mobile-alt"></i>
                                            </div>
                                            <div class="media-body">
                                                <div>
                                                    <label>@lang('locale.phone')</label>
                                                    <span class="tx-medium">{{ auth()->user()->phone }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="media">
                                            <div class="media-icon align-self-start">
                                                <i class="far fa-envelope"></i>
                                            </div>
                                            <div class="media-body">
                                                <div>
                                                    <label>@lang('locale.email')</label>
                                                    <span class="tx-medium">{{ auth()->user()->email }}</span>
                                                </div>
                                            </div>
                                        </div>                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="pwd-change">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">@lang('locale.password')</h6>
                    <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('users.update', auth()->id()) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <!-- Password -->
                                <div class="form-group">
                                    <x-input-label for="password" :value="__('locale.password')" />
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-warning text-white">
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
                                            <span class="input-group-text bg-warning text-white">
                                                <i class="fa fa-eye-slash"></i>
                                            </span>
                                        </div>
                                        <x-text-input id="password_confirmation" type="password" name="password_confirmation" placeholder="{{ __('locale.password_confirmation') }}" required autocomplete="new-password" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <x-app-button class="btn-success">@lang('locale.submit')</x-app-button>
                    </div>
                </form>            
            </div>
        </div>
    </div>
    @push('scripts')
    <x-app-pwd-script></x-app-pwd-script>
    <script src="{{ asset('js/azia.js') }}"></script>
    @endpush
</x-app-layout>
