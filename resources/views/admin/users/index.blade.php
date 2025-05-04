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
                                    <h4 class="card-title"><i class="fa fa-users"></i> @lang('locale.user', ['suffix'=>'s', 'prefix'=>''])</h4>
                                </div>
                                <div class="col-md-6">
                                    <a class="btn btn-success btn-icon" style="float: right" data-target="#create-user" data-toggle="modal">
                                        <i class="typcn icon typcn-plus"></i>
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
                                            <th>@lang('locale.group', ['suffix'=>'', 'prefix'=>''])</th>
                                            <th>@lang('locale.fullname')</th>
                                            <th>@lang('locale.phone')</th>
                                            <th>@lang('locale.email')</th>
                                            <th>@lang('locale.username')</th>
                                            <th>@lang('locale.action', ['suffix'=>'s'])</th>
                                        </thead>
                                        <tbody>
                                            @foreach($users as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ date('d/m/Y H:i:s', strtotime($item->created_at)) }}</td>
                                                <td>{{ $item->group->name }}</td>
                                                <td>{{ $item->firstname ." ". $item->name }}</td>
                                                <td>{{ $item->phone }}</td>
                                                <td>{{ $item->email }}</td>
                                                <td>{{ $item->username }}</td>
                                                <td>
                                                    <div style="display: inline-block">
                                                        <a class="btn btn-primary" data-target="#edit-user{{ $item->id }}" data-toggle="modal">
                                                            <i class="typcn icon typcn-edit"></i>
                                                        </a>
                                                        <x-edit-user :user="$item" :groups="$groups"></x-edit-user>
                                                    </div>
                                                    <form action="{{ route('users.destroy', $item->id) }}" style="display: inline-block" method="post">
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

    <x-create-user :groups="$groups"></x-create-user>
    @push('scripts')
    <x-app-datascript></x-app-datascript>
    @endpush
</x-app-layout>
