@extends('layouts/admin/app')

@section('content')
<div>
    @foreach($images as $image)
        <div style="float:left">
            <div class="col-6"> 
                <img src="{{ asset("images/".$image) }}" class="img-responsive" width="200px">
                <h5 class="my-auto ml-2">{{explode('.', $image)[0]}}</h5>
            </div>
        </div>
    @endforeach
        <form action="{{ action('Management\ImagesController@check') }}" method="POST" enctype="multipart/form-data">
        {{-- <input type="input" name="name"> --}}
        <input type="file" name="file">
        <button type="submit" name="submit">placeholder upload</button>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
    </form>
</div>
@endsection