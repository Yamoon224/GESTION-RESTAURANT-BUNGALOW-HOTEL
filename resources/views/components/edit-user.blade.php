<div class="modal" id="edit-user{{ $user->id }}">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">@lang('locale.edit', ['param'=>__('locale.user', ['suffix'=>'', 'prefix'=>''])])</h6>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('users.update', $user->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <x-input-label for="firstname">@lang('locale.firstname') <span class="text-danger">*</span></x-input-label>
                                <x-text-input id="firstname" type="text" name="firstname" :value="$user->firstname" placeholder="{{ __('locale.firstname') }}" required />
                            </div>                            
                            <div class="form-group">
                                <x-input-label for="phone">@lang('locale.phone') <span class="text-danger">*</span></x-input-label>
                                <div class="input-group">
                                    <div class="input-group-prepend"><button type="button" class="btn btn-light text-primary"><i class="fa fa-mobile"></i></button></div>
                                    <x-text-input id="phone" type="tel" name="phone" :value="$user->phone" placeholder="{{ __('locale.phone') }}" required />
                                </div>
                            </div>
                            <div class="form-group">
                                <x-input-label for="username">@lang('locale.username') <span class="text-danger">*</span></x-input-label>
                                <div class="input-group">
                                    <div class="input-group-prepend"><button type="button" class="btn btn-light text-primary"><i class="fa fa-user"></i></button></div>
                                    <x-text-input id="username" type="text" name="username" :value="$user->username" placeholder="{{ __('locale.username') }}" required />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <x-input-label for="name">@lang('locale.name') <span class="text-danger">*</span></x-input-label>
                                <x-text-input id="name" type="text" name="name" :value="$user->name" placeholder="{{ __('locale.name') }}" required />
                            </div>
                            <div class="form-group">
                                <x-input-label for="email">@lang('locale.email') <span class="text-danger">*</span></x-input-label>
                                <div class="input-group">
                                    <div class="input-group-prepend"><button type="button" class="btn btn-light text-primary"><i class="fa fa-envelope"></i></button></div>
                                    <x-text-input id="email" type="email" name="email" :value="$user->email" placeholder="{{ __('locale.email') }}" required />
                                </div>
                            </div>
                            <div class="form-group">
                                <x-input-label for="group">@lang('locale.group', ['suffix'=>'', 'prefix'=>'']) <span class="text-danger">*</span></x-input-label>
                                <select id="group" class="form-control" name="group_id" required>
                                    <option label="@lang('locale.choose')"></option>
                                    @foreach ($groups as $item)
                                    <option value="{{ $item->id }}" {{ $user->group_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <x-app-button class="btn-primary">@lang('locale.submit')</x-app-button>
                </div>
            </form>            
        </div>
    </div>
</div>