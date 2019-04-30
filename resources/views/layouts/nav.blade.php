<nav class="navbar navbar-expand-lg navbar-dark navbg">
    <div class="d-flex flex-grow-1">
        <div class="navbar-header">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#myNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <a class="navbar-brand d-none d-lg-inline-block" href="/">
            <img src={{ asset('images/logoCircle.png')}} width="57" alt="logo">
        </a>
        <a href="/" class="navbar-brand d-none d-lg-inline-block logo-text nav-item">{{__('navigation.nav_motto')}}</a>
        <!-- Mobile logo -->
        <a class="navbar-brand-two mx-auto d-lg-none d-inline-block logo" href="/">
            <img src={{ asset('images/logoCircle.png')}} width="60" alt="logo">
        </a>
    </div>
    <div class="collapse navbar-collapse flex-grow-1 text-left" id="myNavbar">
        <ul class="navbar-nav ml-auto flex-nowrap">
            <li>
                <a href="/" class="nav-link m-2 nav-item {{ request()->is('/') ? 'active' : '' }}">{{__('navigation.nav_home')}}</a>
            </li>
            <li>
                <a href="/events"
                   class="nav-link m-2 nav-item {{ request()->is('events') ? 'active' : (request()->is('events/*') ? 'active' : '') }}">{{__('navigation.nav_events')}}</a>
            </li>
            <li>
                <a href="/about" class="nav-link m-2 nav-item {{ request()->is('about') ? 'active' : '' }}">{{__('navigation.nav_about')}}</a>
            </li>
            <li>
                <a href="/contact" class="nav-link m-2 nav-item {{ request()->is('contact') ? 'active' : '' }}">{{__('navigation.nav_contact')}}</a>
            </li>
            @if(Auth::user())
	            <li>
	                <a href="/home" class="nav-link m-2 nav-item {{ request()->is('home') ? 'active' : '' }}">{{__('navigation.nav_dashboard')}}</a>
	            </li>
                @if(Auth::user()->accountRole == 'Admin')
                <li>
                    <a href="/admin" class="nav-link m-2 nav-item">{{__('navigation.nav_admin')}}</a>
                </li>
                @endif
	            <li>
	                <a href="/logout" class="nav-link m-2 nav-item">{{__('navigation.nav_logout')}}</a>
	            </li>
            @else
	            <li>
	                <a href="/login" class="nav-link m-2 nav-item {{ request()->is('login') ? 'active' : '' }}">{{__('navigation.nav_login')}}</a>
	            </li>
            @endif
        </ul>
    </div>
</nav>
