@extends('layouts/admin/app')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="col-12">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="accounts-tab" data-toggle="tab" href="#accounts" role="tab"
                           aria-controls="accounts" aria-selected="true">{{ __('accounts.index_active')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="deleted-tab" data-toggle="tab" href="#deleted" role="tab"
                           aria-controls="deleted" aria-selected="false">{{ __('accounts.index_deleted')}}</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="card-body">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="accounts" role="tabpanel" aria-labelledby="accounts-tab">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">{{ __('accounts.index_name')}}</th>
                        <th scope="col">{{ __('accounts.index_role')}}</th>
                        <th scope="col">{{ __('accounts.index_email')}}</th>
                        <th scope="col">{{ __('accounts.index_verified')}}</th>
                        <th scope="col">{{ __('accounts.index_created')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($accounts as $account)
                        <tr onclick="window.location='{{url('/admin/accounts/'. $account->id)}}';">
                            <th scope="row"><img class="img-fluid rounded-circle my-auto avatar"
                                                 src="data:image/jpeg;base64, {{base64_encode($account->avatar)}}"/>
                            </th>
                            <td>{{$account->firstName .' '. $account->middleName .' '. $account->lastName}}</td>
                            <td>{{$account->accountRole}}</td>
                            <td>{{$account->email}}</td>
                            <td>
                                @if($account->email_verified_at != null)
                                    <button disabled class="btn btn-success">{{$account->email_verified_at}}</button>
                                @else
                                    <button disabled class="btn btn-danger">---</button>
                                @endif
                            </td>
                            <td>{{$account->created_at}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                </div>
                <div class="tab-pane fade" id="deleted" role="tabpanel" aria-labelledby="deleted-tab">
                    <table class="table table-striped table-danger table-hover">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">{{ __('accounts.index_name')}}</th>
                            <th scope="col">{{ __('accounts.index_role')}}</th>
                            <th scope="col">{{ __('accounts.index_email')}}</th>
                            <th scope="col">{{ __('accounts.index_verified')}}</th>
                            <th scope="col">{{ __('accounts.index_created')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($deletedAccounts as $deletedAccount)
                            <tr onclick="window.location='{{url('/admin/accounts/'. $deletedAccount->id)}}';">
                                <th scope="row"><img class="img-fluid rounded-circle my-auto avatar"
                                                     src="data:image/jpeg;base64, {{base64_encode($deletedAccount->avatar)}}"/>
                                </th>
                                <td>{{$deletedAccount->firstName .' '. $deletedAccount->middleName .' '. $deletedAccount->lastName}}</td>
                                <td>{{$deletedAccount->accountRole}}</td>
                                <td>{{$deletedAccount->email}}</td>
                                <td>
                                    @if($deletedAccount->email_verified_at != null)
                                        <button disabled class="btn btn-success">{{$deletedAccount->email_verified_at}}</button>
                                    @else
                                        <button disabled class="btn btn-danger">---</button>
                                    @endif
                                </td>
                                <td>{{$deletedAccount->created_at}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection