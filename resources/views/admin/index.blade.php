@extends('layouts/admin/app')

@section('content')

<form method="POST" action="/charts/totaleventscreated">
    @csrf
    <input type="date" name="fromDate">
    <button type="submit">Test</button>
</form>

@endsection


