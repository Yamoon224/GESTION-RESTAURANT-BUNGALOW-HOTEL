<div class="modal" id="create-ingredient">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">@lang('locale.add', ['param'=>__('locale.ingredient', ['suffix'=>'', 'prefix'=>''])])</h6>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('ingredients.store') }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <x-input-label for="name">@lang('locale.name') @lang('locale.ingredient', ['suffix'=>'', 'prefix'=>'']) <span class="text-danger">*</span></x-input-label>
                                <x-text-input id="name" type="text" name="name" placeholder="{{ __('locale.name') }}" required />
                            </div>
                            <div class="form-group">
                                <x-input-label for="qty">@lang('locale.qty') <span class="text-danger">*</span></x-input-label>
                                <x-text-input id="qty" type="number" name="qty" placeholder="{{ __('locale.qty') }}" required />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <x-input-label for="price">@lang('locale.price') <span class="text-danger">*</span></x-input-label>
                                <x-text-input id="price" type="number" name="price" placeholder="{{ __('locale.price') }}" required />
                            </div>
                            <div class="form-group">
                                <x-input-label for="unit">@lang('locale.unit') <span class="text-danger">*</span></x-input-label>
                                <x-text-input id="unit" type="text" name="unit" placeholder="{{ __('locale.unit') }}" required />
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