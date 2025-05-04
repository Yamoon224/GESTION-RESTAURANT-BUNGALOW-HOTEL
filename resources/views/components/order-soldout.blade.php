<div class="modal" id="soldout">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">@lang('locale.soldout')</h6>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('orders.update', $order->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <x-input-label for="received">@lang('locale.received') <span class="text-danger">*</span></x-input-label>
                                <x-text-input id="received" type="number" name="order[received]" placeholder="{{ __('locale.received') }}" required />
                            </div> 
                            <div class="form-group">
                                <x-input-label for="rest">@lang('locale.rest') <span class="text-danger">*</span></x-input-label>
                                <x-text-input id="rest" type="number" name="order[rest]" placeholder="{{ __('locale.rest') }}" required />
                            </div> 
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <x-app-button class="btn-warning">@lang('locale.submit')</x-app-button>
                </div>
            </form>            
        </div>
    </div>
</div>