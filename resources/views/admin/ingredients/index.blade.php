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
                                    <h4 class="card-title"><i class="fa fa-list"></i> @lang('locale.ingredient', ['suffix'=>app()->getLocale() == 'en' ? 'ies' : 's', 'prefix'=>''])</h4>
                                </div>
                                <div class="col-md-6">
                                    <a class="btn btn-success btn-icon" style="float: right" data-target="#create-ingredient" data-toggle="modal">
                                        <i class="typcn icon typcn-plus text-white"></i> 
                                    </a>
                                </div>
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
                                            <th>@lang('locale.name') @lang('locale.ingredient', ['suffix'=>'', 'prefix'=>''])</th>
                                            <th>@lang('locale.qty')</th>
                                            <th>@lang('locale.price')</th>
                                            <th>@lang('locale.created_by')</th>
                                            <th>@lang('locale.action', ['suffix'=>'s'])</th>
                                        </thead>
                                        <tbody>
                                            @foreach($ingredients as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ date('d/m/Y H:i:s', strtotime($item->created_at)) }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->qty." ".$item->unit }}</td>
                                                <td>{{ moneyFormat($item->price) }}</td>
                                                <td>{{ $item->creator->firstname ." ". $item->creator->name }}</td>
                                                <td>
                                                    <div style="display: inline-block">
                                                        <a class="btn btn-primary" data-target="#edit-ingredient{{ $item->id }}" data-toggle="modal">
                                                            <i class="typcn icon typcn-edit"></i>
                                                        </a>
                                                        <x-edit-ingredient :ingredient="$item"></x-edit-ingredient>
                                                    </div>
                                                    <form action="{{ route('ingredients.destroy', $item->id) }}" style="display: inline-block" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger" onclick="if(!confirm('@lang('locale.do_you_confirm')')){ return false }">
                                                            <i class="typcn typcn-trash"></i>
                                                        </button>
                                                    </form>
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

    <x-create-ingredient></x-create-ingredient>
    @push('scripts')
    <x-app-datascript></x-app-datascript>
    @endpush
</x-app-layout>
