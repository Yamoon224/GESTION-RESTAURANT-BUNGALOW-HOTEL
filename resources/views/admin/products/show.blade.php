<x-app-layout>
    <div class="content-wrapper w-100">
        <div class="container d-block mt-2">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="card-title text-uppercase">@lang('locale.product', ['suffix'=>'', 'prefix'=>'']): {{ $product->name." / ".moneyFormat($product->price) }}</h6>
                        </div>
                        <div class="card-body">
                            <div class="row overflow-auto">
                                <div class="col-12 mx-auto">
                                    <table cellspacing="0" class="table table-striped table-bordered">
                                        <thead>
                                            <th>@lang('locale.ingredient', ['suffix'=>'', 'prefix'=>''])</th>
                                            <th>@lang('locale.qty')</th>
                                            <th>@lang('locale.amount') (Fcfa)</th>
                                        </thead>
                                        <tbody id="tbody">
                                            @foreach ($product->product_details as $item)
                                            <tr>
                                                <td>{{ $item->ingredient->name }}</td>
                                                <td>{{ $item->qty }}</td>
                                                <td>{{ moneyFormat($item->amount) }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="{{ asset('js/azia.js') }}"></script>
    @endpush
</x-app-layout>
