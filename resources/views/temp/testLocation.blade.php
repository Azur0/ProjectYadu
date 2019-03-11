@extends('layouts/app')

@section('banner')

@section('nav')

@section('content')
<h1>{{ $userLocation['lon']. "   ".$userLocation['lat']."\n" .$eventLocation[0]['lon']. "   " .$eventLocation[0]['lat'] }} </h1>
@endsection()

@section('footer')