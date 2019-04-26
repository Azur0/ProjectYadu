@extends('layouts/admin/app')

@section('content')
    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Naam</th>
            <th scope="col">Rol</th>
            <th scope="col">Email</th>
            <th scope="col">Geverifieerd</th>
            <th scope="col">Aangemaakt op</th>
        </tr>
        </thead>
        <tbody>
        @foreach($accounts as $account)
            <tr onclick="window.location='{{url('/admin/accounts/'. $account->id)}}';">
                <th scope="row"><img class="img-fluid rounded-circle my-auto avatar"
                                     src="data:image/jpeg;base64, {{base64_encode($account->avatar)}}"/></th>
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
@endsection