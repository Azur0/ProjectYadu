@extends('layouts/admin/app')

@section('content')

<h1>Edit Links</h1>
<form action="/admin" method="post">
    @csrf
    <div class="inputFields">
    @foreach ($socialmedia as $social)
    <h3>{{$social->name}} <input type="text" name="{{$social->name}}" id="{{$social->name}}" value="{{$social->link}}"></h3>
    @endforeach
    </div>
    <input type="submit" value="submit" class="btn btn-primary submit-edit">
</form>

@endsection