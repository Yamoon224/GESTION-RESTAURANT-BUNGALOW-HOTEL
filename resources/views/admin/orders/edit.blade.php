<x-app-layout>
    @push('links')
    <x-app-datalink></x-app-datalink>
    @endpush

    <div class="content-wrapper w-100">
        <div class="container d-block mt-2">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="card-title text-uppercase">@lang('locale.ref'): {{ $order->ref }}</h6>
                        </div>
                        <form action="{{ route('orders.update', $order->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="row overflow-auto">
                                    <div class="col-12">
                                        <div class="mb-2 bg-gray-200 pd-10">
                                            <div class="row">
                                                <div class="col-md-8 col-sm-8 col-xs-12">
                                                    <select class="form-control select2" id="product_name" style="width: 100%;">
                                                        <option label="@lang('locale.choose')" value=""></option>
                                                        @foreach ($products as $item)
                                                        <option value="{{ $item->id }}" accesskey="{{ $item->qty }}" title="{{ $item->price }}">{{ $item->name }}</option>
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
                                                <th>@lang('locale.amount')</th>
                                                <th>@lang('locale.action', ['suffix'=>''])</th>
                                            </thead>
                                            <tbody id="tbody">
                                                @foreach ($order->order_details as $item)
                                                <tr>
                                                    <td>{{ $item->product->name }}</td>
                                                    <td>{{ $item->qty }}</td>
                                                    <td>{{ $item->amount }}</td>
                                                    <td class="text-center">
                                                        <i class="typcn typcn-trash text-danger" onclick="deleter(this)" title="{{ $item->amount }}"></i>
                                                    </td>
                                                    <input type="hidden" name="product_id[]" value="{{ $item->product->id }}" /><input type="hidden" name="qty[]" value="{{ $item->qty }}" /><input type="hidden" name="price[]" value="{{ $item->price }}" /><input type="hidden" name="amount[]" value="{{ $item->amount }}" />
                                                </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="2">TOTAL (Fcfa)</td>
                                                    <td colspan="2"> 
                                                        <x-text-input type="number" name="order[amount]" :value="$order->amount" style="text-align: center" id="ttext" required readonly/>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                        {{-- <div class="mt-2">
                                            <div class="form-group">
                                                <x-input-label for="received">@lang('locale.received') <span class="text-danger">*</span></x-input-label>
                                                <div class="input-group">
                                                    <div class="input-group-preprend"><div class="btn btn-light">Fcfa</div></div>
                                                    <x-text-input type="number" name="order[received]" :value="$order->received" style="text-align: center" placeholder="{{ __('locale.input_amount') }}" required/>
                                                </div>
                                            </div>
                                        </div> --}}
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
            localStorage.setItem('total', {{ $order->amount }});
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
                    $('#tbody').append('<tr class="mg-0"><td>'+ products.product +'</td><td>'+ products.qty+'</td><td>'+ products.amount+'</td><td class="text-center"><i class="typcn typcn-trash text-danger" onclick="deleter(this)" title="'+products.amount+'"></i></td></tr><input type="hidden" name="product_id[]" value="'+products.id+'" /><input type="hidden" name="qty[]" value="'+products.qty+'" /><input type="hidden" name="price[]" value="'+products.price+'" /><input type="hidden" name="amount[]" value="'+products.amount+'" />');
                    localStorage.setItem('total', parseInt(localStorage.getItem('total'))+products.amount);
                    $('#ttext').val( localStorage.getItem('total') );        
                }
            })                 
        </script>
    @endpush
</x-app-layout>
