@extends('layouts/app')

@section('banner')
<div class="container-fluid masthead" style="background-image: url(../images/contact-header-bg.jpg);">
    <div class="overlay">
        <div class="banner-container">
            <div class="banner-text">
                <div class="banner-title">
                    Contact
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm">
            <div class="card center-block text-center" style="width: 18rem;">
                <div class="card-body">
                    <i class="fa fa-envelope" style="font-size: 48px; color: #E79535"></i>
                    <h5 class="card-title">E-mail</h5>
                    <h6 class="card-subtitle mb-2 text-muted"><a href="mailto:info@YADU.nu">info@YADU.nu</a></h6>
                </div>
            </div>
        </div>
        <div class="col-sm">
            <div class="card center-block text-center" style="width: 18rem;">
                <div class="card-body">
                    <i class="fa fa-home" style="font-size: 48px; color: #E79535"></i>
                    <h5 class="card-title">Website</h5>
                    <h6 class="card-subtitle mb-2 text-muted"><a href="http://www.yadu.nu">yadu.nu</a></h6>
                </div>
            </div>
        </div>
        <div class="col-sm">
            <div class="card center-block text-center" style="width: 18rem;">
                <div class="card-body">
                    <i class="fa fa-building" style="font-size: 48px; color: #E79535"></i>
                    <h5 class="card-title">KvK</h5>
                    <h6 class="card-subtitle mb-2 text-muted">62039482</h6>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm">
            <div class="card center-block text-center" style="width: 18rem;">
                <div class="card-body">
                    <i class="fa fa-linkedin" style="font-size: 48px; color: #E79535"></i>
                    <h5 class="card-title">LinkedIn</h5>
                    <h6 class="card-subtitle mb-2 text-muted"><a href="https://nl.linkedin.com/in/carmentoelen">Carmen Toelen</a></h6>
                </div>
            </div>
        </div>
        <div class="col-sm">
            <div class="card center-block text-center" style="width: 18rem;">
                <div class="card-body">
                    <i class="fa fa-twitter" style="font-size: 48px; color: #E79535"></i>
                    <h5 class="card-title">Twitter</h5>
                    <h6 class="card-subtitle mb-2 text-muted"><a href="https://twitter.com/_Yadu_">@_Yadu_</a></h6>
                </div>
            </div>
        </div>
        <div class="col-sm">
            <div class="card center-block text-center" style="width: 18rem;">
                <div class="card-body">
                    <i class="fa fa-facebook" style="font-size: 48px; color: #E79535"></i>
                    <h5 class="card-title">Facebook</h5>
                    <h6 class="card-subtitle mb-2 text-muted"><a href="https://www.facebook.com/yadu.nu/?ref=bookmarks">@yadu.nu</a></h6>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm">
            <div class="card center-block text-center" style="width: 18rem;">
                <div class="card-body">
                    <i class="fa fa-instagram" style="font-size: 48px; color: #E79535"></i>
                    <h5 class="card-title">Instagram</h5>
                    <h6 class="card-subtitle mb-2 text-muted"><a href="https://www.instagram.com/yadu.nu/">yadu.nu</a></h6>
                </div>
            </div>
        </div>
    </div>
@endsection
