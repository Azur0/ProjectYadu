@extends('layouts/admin/app')

@section('content')
    <div>
        <form action="{{ action('Management\ImagesController@check') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="types">
                <h1>Placeholder</h1>
                    <div class="box">
                        @foreach ($images as $image)
                        <div class="card">
                        <input type="radio" id="{{$image}}" name="image" value="{{$image}}" onclick=setSelected(this)>
                            <label for="{{$image}}" class="category">
                                <img src="{{ asset("images/".$image) }}" class="img-responsive" width="100px">
                                <span>{{explode('.', $image)[0]}}</span>
                            </label>
                        </div>
                        @endforeach
                    </div>
                </div>
                <input type="file" name="file" accept="image/png, image/jpeg, image/jpg">
                <button type="submit" name="submit">placeholder upload</button>
            </form>
            @if($errors->any())
            <h4>{{$errors->first()}}</h4>
            @endif
        </div>
    <script>
        function setSelected(item){
            let tmp = document.querySelector("selected");
            item.setAttribute("name", "selected");
            if(tmp !== null){
                tmp.setAttribute("name", "image");
            }
        }
    </script>
@endsection