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
                            <h6 class="card-title text-uppercase">@lang('locale.product', ['suffix'=>'', 'prefix'=>''])</h6>
                        </div>
                        <form action="{{ route('products.update', $product->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="row overflow-auto">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <x-input-label for="product">@lang('locale.product', ['suffix'=>'', 'prefix'=>'']) <span class="text-danger">*</span></x-input-label>
                                            <x-text-input id="product" type="text" name="product[name]" :value="$product->name" placeholder="{{ __('locale.name') }}" required />
                                        </div>                                        
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <x-input-label for="category">@lang('locale.category', ['suffix'=>app()->getLocale() == 'en' ? 'y' : '', 'prefix'=>'']) <span class="text-danger">*</span></x-input-label>
                                            <select id="category" class="form-control select2" name="product[category_id]" style="width: 100%" required>
                                                <option label="@lang('locale.choose')"></option>
                                                @foreach ($categories as $item)
                                                <option value="{{ $item->id }}" {{ $product->category_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>                                        
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <x-input-label for="price">@lang('locale.price') <span class="text-danger">*</span></x-input-label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Fcfa</span>
                                                </div>
                                                <x-text-input id="price" type="number" name="product[price]" :value="$product->price" placeholder="1000, 2000, 3000, etc..." required />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <x-input-label for="qty">@lang('locale.qty') <span class="text-danger">*</span></x-input-label>
                                            <x-text-input type="number" id="qty" name="product[qty]" min="{{ $product->qty }}" :value="$product->qty" placeholder="{{ __('locale.qty') }}" style="text-align: center" />
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <x-input-label for="img">@lang('locale.image', ['suffix'=>''])</x-input-label>
                                            <div class="custom-file">
                                                <x-text-input id="img" class="custom-file-input" type="file" name="product[img]" />
                                                <x-input-label class="custom-file-label">@lang('locale.choose')</x-input-label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-2 bg-gray-200 pd-10">
                                            <div class="row">
                                                <div class="col-md-8 col-sm-8 col-xs-12">
                                                    <select class="form-control select2" id="ingredient_name" style="width: 100%;">
                                                        <option label="@lang('locale.choose')" value=""></option>
                                                        @foreach ($ingredients as $item)
                                                        <option value="{{ $item->id }}" title="{{ $item->price }}">{{ $item->name." | ".moneyFormat($item->price) }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-4 col-sm-4 col-xs-12">
                                                    <div class="input-group">
                                                        <x-text-input type="number" id="ingredient_qty" placeholder="{{ __('locale.qty') }}" style="text-align: center" />
                                                        <div class="input-group-append">
                                                            <button type="button" class="btn btn-info btn-icon float-right" id="newrow"><i class="typcn typcn-plus"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <table cellspacing="0" class="table table-striped table-bordered">
                                            <thead>
                                                <th>@lang('locale.ingredient', ['suffix'=>'', 'prefix'=>''])</th>
                                                <th>@lang('locale.qty')</th>
                                                <th>@lang('locale.amount') (Fcfa)</th>
                                                <th>@lang('locale.action', ['suffix'=>''])</th>
                                            </thead>
                                            <tbody id="tbody">
                                                @foreach ($product->product_details as $item)
                                                <tr>
                                                    <td>{{ $item->ingredient->name }}</td>
                                                    <td>{{ $item->qty }}</td>
                                                    <td>{{ moneyFormat($item->amount) }}</td>
                                                    <td class="text-center">
                                                        <i class="typcn typcn-trash text-danger" onclick="deleter(this)" title="{{ $item->amount }}"></i>
                                                    </td>
                                                    <input type="hidden" name="ingredient_id[]" value="{{ $item->ingredient->id }}" /><input type="hidden" name="qty[]" value="{{ $item->qty }}" /><input type="hidden" name="price[]" value="{{ $item->price }}" /><input type="hidden" name="amount[]" value="{{ $item->amount }}" />
                                                </tr>
                                                @endforeach
                                            </tbody>
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
            var deleter = (item) => $(item).closest('tr').remove(); 
        
            $('#newrow').on('click', function() {
                let ingredient = $('#ingredient_name').children('option:selected').text(),
                    id = $('#ingredient_name').children('option:selected').val(),
                    price = parseInt($('#ingredient_name').children('option:selected').attr('title')),
                    qty = parseInt($('#ingredient_qty').val());
        
                if(qty != undefined && qty > 0  && id != undefined && id != '') {
                    let ingredients = {'id':id, 'ingredient':ingredient, 'price':price, 'qty':qty, 'amount':qty * price};
                    $('#tbody').append('<tr class="mg-0"><td>'+ ingredients.ingredient +'</td><td><input type="number" class="form-control" style="text-align: center" name="qty[]" value="'+ingredients.qty+'" /></td><td><input type="number" name="amount[]" class="form-control" style="text-align: center" value="'+ingredients.amount+'" /></td><td class="text-center"><i class="typcn typcn-trash text-danger" onclick="deleter(this)" title="'+ingredients.amount+'"></i></td><input type="hidden" name="ingredient_id[]" value="'+ingredients.id+'" /><input type="hidden" name="price[]" value="'+ingredients.price+'" /></tr>');
                }
            })                 
        </script>
    @endpush
</x-app-layout>
