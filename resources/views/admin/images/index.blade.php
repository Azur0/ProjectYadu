@extends('layouts/admin/app')

@section('content')
<div>
    <form action="{{ action('Management\ImagesController@check') }}" method="POST" enctype="multipart/form-data">
        {{-- <input type="input" name="name"> --}}
        <input type="file" name="file">
        <button type="submit" name="submit">placeholder upload</button>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
    </form>
</div>
@endsection