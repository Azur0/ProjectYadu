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
    <input type="range" ticks="[5, 10, 15, 20, 25, 30,35]" min="5" max="35" step="5" value="20" class="slider" id="rangeValue">
    <div class="labels">
        <label class="rangeTextLeft">5 KM</label>
        <label class="rangeTextCenter">10 KM</label>
        <label class="rangeTextCenter">15 KM</label>
        <label class="rangeTextCenter">20 KM</label>
        <label class="rangeTextCenter">25 KM</label>
        <label class="rangeTextCenter">30 KM</label>
        <label class="rangeTextRight"> > </label>
    </div>
</div>



<script type="text/javascript">
    var slider = document.getElementById("rangeValue");
    var val = document.getElementById("rangeValueDisplay");
    val.innerHTML = slider.value;
    slider.oninput = function() {
        if(35 == slider.value){
            val.innerHTML = "∞";
        }else{
            val.innerHTML = this.value;
        }
    }
</script>

@endsection()



@section('footer') 