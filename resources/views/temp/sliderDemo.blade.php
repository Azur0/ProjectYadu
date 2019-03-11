@extends('layouts/app')

@section('banner')

@section('nav')

@section('content')
    <h1>Slider demo page</h1>
    <!-- This page is to test the slider -->
    <div class="box-range-value">
        <div id="rangeValueDisplay">
        </div>
    </div>
    <div class="slideContainer">
        <input type="range"
               ticks="[5, 10, 15, 20, 25]"
               min="5"
               max="25"
               step="5"
               value="15"
               class="slider" id="rangeValue">
        <label class="rangeTextLeft">5 KM</label>
        <label class="rangeTextCenter">10 KM</label>
        <label class="rangeTextCenter">15 KM</label>
        <label class="rangeTextCenter">20 KM</label>
        <label class="rangeTextRight">25 KM</label>
    </div>



    <script type="text/javascript">
        var slider=document.getElementById("rangeValue");
        var val=document.getElementById("rangeValueDisplay");
        val.innerHTML=slider.value;
        slider.oninput=function () {
            val.innerHTML=this.value;
        }
    </script>

@endsection()



@section('footer')