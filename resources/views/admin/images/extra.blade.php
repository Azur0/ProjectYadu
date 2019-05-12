@extends('layouts/admin/app')

@section('content')
    <div>
        <div class="types">
                <div class="box">
                    @foreach ($images as $image)
                        <input type="radio" name="image">
                        <label for="{{$image}}" class="category">
                            <img src="{{ asset("images/".$image) }}" class="img-responsive" width="200px">
                            <span>{{explode('.', $image)[0]}}</span>
                        </label>
                    @endforeach
                </div>
            </div>
        </div>
        <form action="{{ action('Management\ImagesController@check') }}" method="POST" enctype="multipart/form-data">
            {{-- <input type="input" name="name"> --}}
            <input type="file" name="file">
            <button type="submit" name="submit">placeholder upload</button>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
        </form>
    </div>
@endsection