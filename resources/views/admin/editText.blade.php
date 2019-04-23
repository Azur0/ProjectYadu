@extends('layouts/admin/app')

@section('content')

<h1>Edit pagina</h1>
<form action="/admin" method="post">
@csrf
<input type="hidden" name="file" value="{{$page}}">
<input type="hidden" name="lang" value="{{$lang}}">
@foreach ($x as $key => $item)
<p>{{$key}} - <input type="text" name="{{$key}}" id="EditInput" value="{{$item}}"></p>
@endforeach
<input type="submit" value="submit">
</form>

@endsection