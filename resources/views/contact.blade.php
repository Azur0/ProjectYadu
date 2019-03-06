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
        <div class="col-sm text-center">
            <h2>
                <b>Lorem ipsum</b>
            </h2>
        </div>
    </div>
    <div class="row about-text">
        <div class="col-sm text-left">
            Nam sit amet tempor sem, sit amet volutpat libero. Proin nulla ante, congue vitae semper eget, vestibulum ac est. Morbi ac est varius, pretium libero non, vulputate leo. Praesent efficitur arcu neque, ut maximus metus facilisis vel. Nulla ut egestas nunc. Vivamus cursus urna non sem maximus pharetra. Cras eget placerat mauris. Quisque arcu libero, rhoncus in massa viverra, sollicitudin imperdiet nisl. Fusce non libero vel risus consequat convallis a nec nisi. Vivamus interdum nisi non est tempor, nec maximus tortor fermentum. Nullam sed odio euismod dolor rhoncus efficitur. Vestibulum iaculis laoreet sollicitudin. Mauris magna libero, tempus vitae mollis quis, fermentum non mauris. In quis tellus massa. Vestibulum hendrerit est ante, in fermentum mauris scelerisque non.
        </div>
        <div class="col-sm text-left">
            <div class="contact-item">
                <h5>EMAIL</h5>
                <a href="mailto:info@YADU.nu" class="contact-item">
                    <span>info@YADU.nu</span>
                </a>
            </div>
            <div class="contact-item">
                <h5>KvK</h5>
                <span>62039482</span>
            </div>
            <div class="row">
                <div class="col-xs-6 media linkedin">
                    <a href="https://nl.linkedin.com/in/carmentoelen" class="contact-item">
                        <i class="fa fa-linkedin" style="font-size: 36px; color: #E79535"></i>
                    </a>
                </div>
                <div class="col-xs-6 media twitter">
                    <a href="https://twitter.com/_Yadu_" class="contact-item">
                        <i class="fa fa-twitter" style="font-size: 36px; color: #E79535"></i>
                    </a>
                </div>
                <div class="col-xs-6 media facebook">
                    <a href="https://www.facebook.com/yadu.nu/?ref=bookmarks" class="contact-item">
                        <i class="fa fa-facebook" style="font-size: 36px; color: #E79535"></i>
                    </a>
                </div>
                <div class="col-xs-6 media instagram">
                    <a href="https://www.instagram.com/yadu.nu/" class="contact-item">
                        <i class="fa fa-instagram" style="font-size: 36px; color: #E79535"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
