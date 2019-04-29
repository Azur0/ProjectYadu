@extends('layouts/admin/app')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="col-12">
            </div>
        </div>
        <div class="card-body">
            <div class="tab-content" id="myTabContent">
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
        </div>
    </div>
@endsection