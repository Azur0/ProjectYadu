@extends('layouts/admin/app')

@section('content')

<div class="card">
    <div class="card-header">
        <h1>{{$tag->tag}}</h1>
    </div>
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
    <div class="card-body">
        <form action="{{ route('imagescontroller.updatetagpicture') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="radio" id="{{$tag->id}}" name="{{$tag->tag}}" value="{{$tag->id}}">
            <div class="tagimage" id="default">
                <a onclick=setSelected(this) id="default">
                    <?php echo '<img src="data:image/jpeg;base64,' . base64_encode($tag->imageDefault) . '" width="150px" height="150px"/>'; ?>
                </a>
            </div>
            <div class="tagimage" id="selected">
                <a onclick=setSelected(this) id="selected">
                    <?php echo '<img src="data:image/jpeg;base64,' . base64_encode($tag->imageSelected) . '" width="150px" height="150px"/>'; ?> 
                </a>
            </div>
            <input type="hidden" name="id" value="{{$tag->id}}">
            <input type="hidden" name="type" id="type" value="">
    </div>
    <div class="card-footer">
        <div class="responsive">
                <label>{{__('image.edit_tag_name')}}</label>
                <input required autofocus class="w3-input w3-border" type="text" name="naam" value="{{$tag->tag}}">
            <label for="file1" class="input-label first formitem">
                    <i class="fa fa-upload"></i>
                    {{__('image.add_tag_default')}}
                </label>
                <input id="file1" class="btn btn-info" type="file" name="image" accept="image/png">
                <button type="submit" class="btn btn-primary" name="submittype">{{__('image.button_upload_single')}}</button>
            </div>
        </form>
    </div>
</div>

<script>
$(document).ready(function() {
    $("#file1").on("change", function() {
        $('.first').html(`<i class="fa fa-upload"></i>{{__('image.add_tag_default')}}: ${$(this)[0].files[0].name}`);
    });

    let selected = document.getElementById("default");
    selected.style.background = "lightgreen";
    selected.childNodes[1].setAttribute("name", "selected");
    document.getElementById("type").value = "default";

})

function setSelected(item){
    if(item.id == "default"){
        document.getElementById("type").value = "default";
    } else {
        document.getElementById("type").value = "selected";
    }
    let tmp = document.getElementsByName("selected");
    tmp.forEach(function(data){
        data.parentNode.style.background = "#EEEEEE";
    });
    $('selected').attr("name", "");
    item.parentNode.style.background = "lightgreen";
    item.setAttribute("name", "selected");
}
</script>

@endsection