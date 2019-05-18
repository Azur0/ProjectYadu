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
                                    {{-- <form class="form_submit_ays" method="POST" id="deleteAccount" action="{{ action('Management\ImagesController@removeextra') }}">
                                            @method('DELETE')
                                            @csrf
                                            <div>
                                                <div >
                                                    <button type="button" class="button-remove button-hover" data-toggle="modal" data-target="#confirmDelete">Placeholder showdelete</button>
                                                </div>
                                                <div class="modal fade" id="confirmDelete" tabindex="-1" role="dialog">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">placeholder title</h5>
                                                                <button type="button" class="close" data-dismiss="modal"aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                placeholder information
                                                            </div>
                                                            <div class="modal-footer">
                                                                <input type="submit" form="deleteAccount" class="btn btn-danger" value="placeholder confirm delete">
                                                                <button type="button" class="btn btn-primary" data-dismiss="modal">Placeholder dismiss</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form> --}}
                                    <img src="{{ asset("images/".$image) }}" class="img-responsive" width="100px">
                                <span>{{explode('.', $image)[0]}}</span>
                            </label>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <input type="file" name="file" accept="image/png, image/jpeg, image/jpg">
            <button type="submit" name="submit">placeholder upload</button>
        </form>
        @if($errors->any())
            <h4>{{$errors->first()}}</h4>
        @endif
    <script>
        function warning(){
            alert("alert");
        }
        
        function setSelected(item){
            let tmp = document.querySelector(".selected");
            console.log("temp:".tmp, "item:".item);
            item.setAttribute("name", "selected");
            if(tmp !== null){
                tmp.setAttribute("name", "image");
            }
        }
    </script>
@endsection