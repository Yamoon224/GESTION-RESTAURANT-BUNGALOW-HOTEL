<div class="modal" id="create-user">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">@lang('locale.add', ['param'=>__('locale.user', ['suffix'=>'', 'prefix'=>''])])</h6>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('users.store') }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <x-input-label for="firstname">@lang('locale.firstname') <span class="text-danger">*</span></x-input-label>
                                <x-text-input id="firstname" type="text" name="firstname" placeholder="{{ __('locale.firstname') }}" required />
                            </div>                            
                            <div class="form-group">
                                <x-input-label for="phone">@lang('locale.phone') <span class="text-danger">*</span></x-input-label>
                                <div class="input-group">
                                    <div class="input-group-prepend"><button type="button" class="btn btn-light text-success"><i class="fa fa-mobile"></i></button></div>
                                    <x-text-input id="phone" type="tel" name="phone" placeholder="{{ __('locale.phone') }}" required />
                                </div>
                            </div>
                            <div class="form-group">
                                <x-input-label for="username">@lang('locale.username') <span class="text-danger">*</span></x-input-label>
                                <div class="input-group">
                                    <div class="input-group-prepend"><button type="button" class="btn btn-light text-success"><i class="fa fa-user"></i></button></div>
                                    <x-text-input id="username" type="text" name="username" placeholder="{{ __('locale.username') }}" required />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <x-input-label for="name">@lang('locale.name') <span class="text-danger">*</span></x-input-label>
                                <x-text-input id="name" type="text" name="name" placeholder="{{ __('locale.name') }}" required />
                            </div>
                            <div class="form-group">
                                <x-input-label for="email">@lang('locale.email') <span class="text-danger">*</span></x-input-label>
                                <div class="input-group">
                                    <div class="input-group-prepend"><button type="button" class="btn btn-light text-success"><i class="fa fa-envelope"></i></button></div>
                                    <x-text-input id="email" type="email" name="email" placeholder="{{ __('locale.email') }}" required />
                                </div>
                            </div>
                            <div class="form-group">
                                <x-input-label for="group">@lang('locale.group', ['suffix'=>'', 'prefix'=>'']) <span class="text-danger">*</span></x-input-label>
                                <select id="group" class="form-control select2" name="group_id" style="width: 100%" required>
                                    <option label="@lang('locale.choose')"></option>
                                    @foreach ($groups as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
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