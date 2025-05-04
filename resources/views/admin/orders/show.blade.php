<x-app-layout>
    <div class="content-wrapper w-100">
        <div class="container d-block mt-2">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="card-title text-uppercase">@lang('locale.ref'): {{ $order->ref }}</h6>
                        </div>
                        <div class="card-body">
                            <div class="row overflow-auto">
                                <div class="col-md-8 mx-auto mb-2">
                                    <a class="btn btn-info d-inline-block" href="{{ route('orders.receipt', [$order->id, 'bill']) }}" title="@lang('locale.print_receipt')">
                                        <i class="typcn icon typcn-printer"></i> @lang('locale.bill')
                                    </a>
                                    @if ($order->received)
                                    <a class="btn btn-info d-inline-block" href="{{ route('orders.receipt', [$order->id, 'receipt']) }}" title="@lang('locale.print_receipt')">
                                        <i class="typcn icon typcn-printer"></i> @lang('locale.receipt')
                                    </a>                                       
                                    @else
                                    <a class="btn btn-success d-inline-block" data-toggle="modal" data-target="#soldout" title="@lang('locale.soldout')">
                                        <i class="typcn icon typcn-credit-card"></i> @lang('locale.soldout')
                                    </a>
                                    @endif                                    
                                </div>
                                <div class="col-12 mx-auto">
                                    <table cellspacing="0" class="table table-striped table-bordered">
                                        <thead>
                                            <th>@lang('locale.product', ['suffix'=>'', 'prefix'=>''])</th>
                                            <th>@lang('locale.qty')</th>
                                            <th>@lang('locale.price')</th>
                                            <th>@lang('locale.amount')</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($order->order_details as $item)
                                                <tr>
                                                    <td>{{ $item->product->name }}</td>
                                                    <td>{{ $item->qty }}</td>
                                                    <td>{{ moneyFormat($item->price) }}</td>
                                                    <td>{{ moneyFormat($item->amount) }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="2">{{ $order->received == 0 ? 'Net à Payer' : 'TOTAL' }}</td>
                                                <td colspan="2">{{ moneyFormat($order->amount) }}</td>
                                            </tr>
                                            @if($order->received)
                                            <tr class="bg-info text-white">
                                                <td colspan="2" class="text-uppercase">@lang('locale.received')</td>
                                                <td colspan="2">{{ moneyFormat($order->received) }}</td>
                                            </tr>
                                            @endif
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-order-soldout :order="$order"></x-order-soldout>
    @push('scripts')
    <script src="{{ asset('js/azia.js') }}"></script>
    @endpush
</x-app-layout>
