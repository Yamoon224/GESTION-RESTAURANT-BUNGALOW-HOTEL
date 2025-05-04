<div class="modal" id="create-product">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">@lang('locale.add', ['param'=>__('locale.product', ['suffix'=>'', 'prefix'=>''])])</h6>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('products.store') }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <x-input-label for="product">@lang('locale.product', ['suffix'=>'', 'prefix'=>'']) <span class="text-danger">*</span></x-input-label>
                                <x-text-input id="product" type="text" name="name" placeholder="{{ __('locale.name') }}" required />
                            </div>
                            
                            <div class="form-group">
                                <x-input-label for="price">@lang('locale.price') <span class="text-danger">*</span></x-input-label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Fcfa</span>
                                    </div>
                                    <x-text-input id="price" type="number" name="price" placeholder="1000, 2000, 3000, etc..." required />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <x-input-label for="category">@lang('locale.category', ['suffix'=>app()->getLocale() == 'en' ? 'y' : '', 'prefix'=>'']) <span class="text-danger">*</span></x-input-label>
                                <select id="category" class="form-control select2" name="category_id" style="width: 100%" required>
                                    <option label="@lang('locale.choose')"></option>
                                    @foreach ($categories as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <x-input-label for="img">@lang('locale.image', ['suffix'=>''])</x-input-label>
                                <div class="custom-file">
                                    <x-text-input id="img" class="custom-file-input" type="file" name="img" />
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
                                <tbody id="tbody"></tbody>
                            </table>
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