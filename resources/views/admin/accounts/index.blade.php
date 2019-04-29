@extends('layouts/admin/app')

@section('content')
    <div class="card">
        <div class="card-header">
            <div>
                <div class="search">
                    {{--<label for="filterByTag">{{__('events.index_select_category')}}</label>--}}
                    {{--<input oninput="fetch_events()" list="tags" id="filterByTag" name="filterByTag"/>--}}
                    {{--<datalist id="tags">--}}
                        {{--@foreach ($tags as $tag)--}}
                            {{--<option value="{{__('events.cat'.$tag->id)}}">--}}
                        {{--@endforeach--}}
                    {{--</datalist>--}}
                    {{--<label for="filterByName">{{__('events.index_search_name')}}</label>--}}
                    {{--<input oninput="fetch_events()" list="names" id="filterByName" name="filterByName"--}}
                           {{--autocomplete="off"/>--}}
                </div>
            </div>
            <div class="col-12">

            </div>
        </div>
        <div class="card-body">
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
        </div>
    </div>
@endsection