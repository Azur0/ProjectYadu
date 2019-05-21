@extends('layouts/admin/app')

@section('content')
{{-- Upload icon --}}
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <div>
        @if(count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if($message = Session::get('success'))
            <div class="alert alert-succes alert-block">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <strong>{{ $message }}</strong>
            </div>
        @endif 
        <div class="card">
                <div class="card-header">
                <h1>{{__('image.header_extra')}}</h1>
                </div>
                <div class="form card-body">
                        <form action="{{ route('imagescontroller.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
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
                        <div class="responsive">
                                <label for="file1" class="input-label first formitem">
                                    <i class="fa fa-upload"></i>
                                    {{__('image.add_tag_default')}}
                                </label>
                                <input id="file1" class="btn btn-info" type="file" name="default" accept="image/png, image/jpeg, image/jpg">
                                <button type="submit" class="btn btn-primary submit-edit" name="submittype">{{__('image.button_upload_single')}}</button>
                            </div>
                    </form>
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