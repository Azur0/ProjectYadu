@extends('layouts/admin/app')

@section('content')

<h1>Edit pagina</h1>
<form action="/admin" method="post">
@csrf
<input type="hidden" name="file" value="{{$page}}">
<input type="hidden" name="lang" value="{{$lang}}">

<?php
function isObjectArray($key, $item){
    printTitle($key);
    foreach($item as $key => $singleItem){
        if (is_array($singleItem)){
            isObjectArray($key, $singleItem);
        }
        else {
            printInputFields($key, $singleItem);
        }
    }
}

function printTitle($key){
    echo "<p><strong>$key</strong></p>";
}

function printInputFields($key, $item){
    echo "<p> - $key - <input type='text' name='$key' id='EditInput' value='$item'></p>";
}

?>

@foreach ($x as $key => $item)
    @if (!is_array($item))
        <p>{{$key}} - <input type="text" name="{{$key}}" id="EditInput" value="{{$item}}"></p>
    @else
        <?php isObjectArray($key, $item) ?>
    @endif
    
@endforeach

<input type="submit" value="submit">
</form>

@endsection