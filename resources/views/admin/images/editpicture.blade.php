@extends('layouts/admin/app')

@section('content')

<div class="card">
    <div class="card-header">
        <h1>{{$tag->tag}}</h1>
    </div>
    <div class="card-body">
        <form method="POST" enctype="multipart/form-data">
        <input type="radio" id="{{$tag->id}}" name="{{$tag->tag}}" value="{{$tag->id}}">
        <div class="tagimage" name="default">
        <a onclick=setSelected(this)>
            <?php echo '<img src="data:image/jpeg;base64,' . base64_encode($tag->imageDefault) . '"/>'; ?>
        </a>
        </div>
        <div class="tagimage" name="selected">
        <a onclick=setSelected(this)>
            <?php echo '<img src="data:image/jpeg;base64,' . base64_encode($tag->imageSelected) . '"/>'; ?> 
        </a>
        </div>
    </div>
    <div class="card-footer">
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
</div>

<script>
$(document).ready(function() {
    $("#file1").on("change", function() {
        $('.first').html(`<i class="fa fa-upload"></i>{{__('image.add_tag_default')}}: ${$(this)[0].files[0].name}`);
    });
})

function setSelected(item){
    let tmp = document.getElementById("selected");
    item.parentNode.style.background = "lightgray";
    item.id = "selected"
    if(tmp !== null){
        tmp.id = "";
        tmp.parentNode.style.background = "#EEEEEE";
    }
}
</script>

@endsection