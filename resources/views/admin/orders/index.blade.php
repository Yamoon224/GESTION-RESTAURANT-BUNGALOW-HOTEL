<x-app-layout>
    @push('links')
    <x-app-datalink></x-app-datalink>
    @endpush

    <div class="content-wrapper w-100">
        <div class="container d-block mt-2">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="card-title"><i class="fa fa-shopping-bag"></i> @lang('locale.order', ['suffix'=>'s', 'prefix'=>''])</h4>
                                </div>
                                @if(isAuthorize([1, 3]))
                                <div class="col-md-6">
                                    <a class="btn btn-success btn-icon" style="float: right" data-toggle="modal" data-target="#create-order">
                                        <i class="typcn icon typcn-plus"></i>
                                    </a>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row grid-margin mb-2">
                                @if (!empty(session('message')))
                                <div class="col-12">
                                    <div class="alert alert-success" role="alert">
                                        <strong>@lang('locale.success')</strong>
                                        {{ session('message') }}
                                    </div>
                                </div>
                                @endif
                            </div>
                            <div class="row overflow-auto">
                                <div class="col-12">
                                    <table cellspacing="0" class="table table-striped" id="order-listing" width="100%">
                                        <thead>
                                            <th>#</th>
                                            <th>@lang('locale.created_at')</th>
                                            <th>@lang('locale.ref')</th>
                                            <th>@lang('locale.paid_net')</th>
                                            <th>@lang('locale.received')</th>
                                            <th>@lang('locale.rest')</th>
                                            @if(isAuthorize([1]))
                                            <th>@lang('locale.created_by')</th>
                                            @endif
                                            <th>@lang('locale.action', ['suffix'=>'s'])</th>
                                        </thead>
                                        <tbody>
                                            @foreach($orders as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ date('d/m/Y H:i:s', strtotime($item->created_at)) }}</td>
                                                <td>{{ $item->ref }}</td>
                                                <td>{{ moneyFormat($item->amount) }}</td>
                                                <td>{{ moneyFormat($item->received) }}</td>
                                                <td>{{ moneyFormat($item->rest) }}</td>
                                                @if(isAuthorize([1]))
                                                <td>{{ $item->creator->firstname ." ". $item->creator->name }}</td>
                                                @endif
                                                <td>
                                                    <div style="display: inline-block">
                                                        @if(isAuthorize([1, 2]))
                                                        <a class="btn btn-primary" href="{{ route('orders.edit', $item->id) }}">
                                                            <i class="typcn icon typcn-edit"></i>
                                                        </a>                                                        
                                                        @endif
                                                        <a class="btn btn-warning" href="{{ route('orders.show', $item->id) }}" title="@lang('locale.details')">
                                                            <i class="typcn icon typcn-eye"></i>
                                                        </a>                                                        
                                                    </div>
                                                    @if(isAuthorize([1]))
                                                    <form action="{{ route('orders.destroy', $item->id) }}" style="display: inline-block" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger" onclick="if(!confirm('@lang('locale.do_you_confirm')')){ return false }">
                                                            <i class="typcn typcn-trash"></i>
                                                        </button>
                                                    </form>
                                                    @endif
                                                </td>
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
    <x-create-order :products="$products"></x-create-order>

    @push('scripts')
    <x-app-datascript></x-app-datascript>
    @endpush
</x-app-layout>
