<x-app-layout>
    @push('links')
    <x-app-datalink></x-app-datalink>
    @endpush

    <div class="content-wrapper w-100">
        <div class="container d-block mt-2">
            <div class="row">
                <div class="col-md-8 mx-auto">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-8">
                                    <h4 class="card-title"><i class="fa fa-shopping-bag"></i> @lang('locale.add', ['param'=>__('locale.order', ['suffix'=>'', 'prefix'=>''])])</h4>
                                </div>
                                <div class="col-md-4 text-right">
                                    <a class="btn btn-secondary btn-sm" href="{{ route('orders.index') }}">
                                        <i class="typcn typcn-arrow-left"></i> @lang('locale.back')
                                    </a>
                                </div>
                            </div>
                        </div>
                        <form action="{{ route('orders.store') }}" method="post">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="mb-2 bg-gray-200 pd-10">
                                            <div class="row">
                                                <div class="col-md-8 col-sm-8 col-xs-12">
                                                    <select class="form-control select2" id="product_name" style="width: 100%;">
                                                        <option label="@lang('locale.choose')" value=""></option>
                                                        @foreach ($products as $item)
                                                        <option value="{{ $item->id }}" title="{{ $item->price }}" accesskey="{{ $item->qty }}">{{ $item->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-4 col-sm-4 col-xs-12">
                                                    <div class="input-group">
                                                        <x-text-input type="number" id="product_qty" placeholder="{{ __('locale.qty') }}" style="text-align: center" />
                                                        <div class="input-group-append">
                                                            <button type="button" class="btn btn-info btn-icon float-right" id="newrow"><i class="typcn typcn-plus"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <table cellspacing="0" class="table table-striped table-bordered">
                                            <thead>
                                                <th>@lang('locale.product', ['suffix'=>'', 'prefix'=>''])</th>
                                                <th>@lang('locale.qty')</th>
                                                <th>@lang('locale.amount') (@lang('locale.xof'))</th>
                                                <th>@lang('locale.action', ['suffix'=>''])</th>
                                            </thead>
                                            <tbody id="tbody"></tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="2">@lang('locale.paid_net')</td>
                                                    <td colspan="2">
                                                        <x-text-input type="number" name="order[amount]" style="text-align: center" id="ttext" required readonly/>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <x-app-button class="btn-info btn-block" id="btn-submit" onclick="if(!confirm('@lang('locale.do_you_confirm')')){ return false }">@lang('locale.submit')</x-app-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <x-app-datascript></x-app-datascript>
    <script>
        localStorage.setItem('total', 0);
        var deleter = function(item) {
            let total = parseInt( $('#ttext').val() ) - parseInt( $(item).attr('title') );
            localStorage.setItem('total', total);
            $('#ttext').val( total );
            $(item).closest('tr').remove();
        };

        $('#newrow').on('click', function() {
            let product = $('#product_name').children('option:selected').text(),
                id = $('#product_name').children('option:selected').val(),
                price = parseInt($('#product_name').children('option:selected').attr('title')),
                qty = parseInt($('#product_qty').val()),
                qty_available = parseInt( $('#product_name').children('option:selected').attr('accesskey') );

            if(qty != undefined && qty > 0 && qty_available >= qty && id != undefined && id != '') {
                let products = {'id':id, 'product':product, 'price':price, 'qty':qty, 'amount':qty * price};
                $('#tbody').append('<tr class="mg-0"><td>'+ products.product +'</td><td><input type="number" class="form-control" style="text-align: center" name="qty[]" value="'+products.qty+'" /></td><td><input type="number" name="amount[]" class="form-control" style="text-align: center" value="'+products.amount+'" /></td><td class="text-center"><i class="typcn typcn-trash text-danger" onclick="deleter(this)" title="'+products.amount+'"></i></td><input type="hidden" name="product_id[]" value="'+products.id+'" /><input type="hidden" name="price[]" value="'+products.price+'" /></tr>');
                localStorage.setItem('total', parseInt(localStorage.getItem('total'))+products.amount);
                $('#ttext').val( localStorage.getItem('total') );
            }
        });
    </script>
    @endpush
</x-app-layout>
