@extends('layouts/admin/app')

@section('content')
    <img class="img-fluid rounded-circle my-auto"
         src="data:image/jpeg;base64, {{base64_encode($account->avatar)}}"/>
    <h1>{{$account->firstName .' '. $account->middleName .' '. $account->lastName}}</h1>
    
@endsection