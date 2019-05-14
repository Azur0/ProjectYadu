@extends('layouts/admin/app')

@section('content')
    <div>
        <form action="{{ action('Management\ImagesController@check') }}" method="POST" enctype="multipart/form-data">
            <div class="types">
                <h1>Placeholder</h1>
                    <div class="box">
                        @foreach ($images as $image)
                        <input type="radio" id="{{$image}}" name="image" value="{{$image}}" onclick=setSelected(this)>
                            <label for="{{$image}}" class="category">
                                    <a onclick="warning()"><span class="center badge badge-pill badge-warning removebadge">x</span></a>
                                    <img src="{{ asset("images/".$image) }}" class="img-responsive" width="100px">
                                <span>{{explode('.', $image)[0]}}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
            </div>
            <input type="file" name="file">
            <button type="submit" name="submit">placeholder upload</button>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
        </form>
        @if (empty($errors !== null))
            <div class="error">{{$error}}</div>
        @endif
    <script>
        function warning(){
            alert("alert");
        }
        
        function setSelected(item){
            $prev = document.querySelector(".selected");
            if($prev !== null) {
                $prev.setAttribute("name","");
            }
            item.setAttribute("name","selected");
        }
    </script>
@endsection