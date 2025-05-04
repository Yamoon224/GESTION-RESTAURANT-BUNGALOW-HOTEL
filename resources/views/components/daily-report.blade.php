<div class="modal" id="dailyreport">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">@lang('locale.daily_report')</h6>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('orders.dailyreport') }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <x-input-label for="start">@lang('locale.start') <span class="text-danger">*</span></x-input-label>
                                <x-text-input id="start" type="datetime-local" name="start" placeholder="{{ __('locale.start') }}" required />
                            </div> 
                            <div class="form-group">
                                <x-input-label for="start">@lang('locale.end') <span class="text-danger">*</span></x-input-label>
                                <x-text-input id="end" type="datetime-local" name="end" placeholder="{{ __('locale.end') }}" required />
                            </div> 
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <x-app-button class="btn-warning"><i class="typcn icon typcn-printer"></i> PDF</x-app-button>
                </div>
            </form>            
        </div>
    </div>
</div>