<div class="modal" id="edit-product{{ $product->id }}">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">@lang('locale.edit', ['param'=>__('locale.product', ['suffix'=>'', 'prefix'=>''])])</h6>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('products.update', $product->id) }}" method="post">
                @method('PUT')
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <x-input-label for="product">@lang('locale.product', ['suffix'=>'', 'prefix'=>'']) <span class="text-danger">*</span></x-input-label>
                                <x-text-input id="product" type="text" name="name" :value="$product->name" placeholder="{{ __('locale.name') }}" required />
                            </div>
                            <div class="form-group">
                                <x-input-label for="price">@lang('locale.price') <span class="text-danger">*</span></x-input-label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Fcfa</span>
                                    </div>
                                    <x-text-input id="price" type="number" name="price" :value="$product->price" placeholder="1000, 2000, 3000, etc..." required />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <x-input-label for="category">@lang('locale.category', ['suffix'=>app()->getLocale() == 'en' ? 'y' : '', 'prefix'=>'']) <span class="text-danger">*</span></x-input-label>
                                <select id="category" class="form-control select2" name="category_id" style="width: 100%" required>
                                    <option label="@lang('locale.choose')"></option>
                                    @foreach ($categories as $item)
                                    <option value="{{ $item->id }}" {{ $product->category_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
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
                    </div>
                </div>
                <div class="modal-footer">
                    <x-app-button class="btn-primary">@lang('locale.submit')</x-app-button>
                </div>
            </form>            
        </div>
    </div>
</div>