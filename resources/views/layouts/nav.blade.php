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
        <p class="navbar-brand d-none d-lg-inline-block logo-text nav-item">VIND WAT JE BINDT!</p>
        <!-- Mobile logo -->
        <a class="navbar-brand-two mx-auto d-lg-none d-inline-block logo" href="/">
            <img src={{ asset('images/logoCircle.png')}} width="60" alt="logo">
        </a>
    </div>
    <div class="collapse navbar-collapse flex-grow-1 text-left" id="myNavbar">
        <ul class="navbar-nav ml-auto flex-nowrap">
            <li>
                <a href="/" class="nav-link m-2 nav-item active">HOME</a>
            </li>
            <li>
                <a href="/events" class="nav-link m-2 nav-item">EVENEMENTEN</a>
            </li>
            <li>
                <a href="/about" class="nav-link m-2 nav-item">OVER ONS</a>
            </li>
            <li>
                <a href="/contact" class="nav-link m-2 nav-item">CONTACT</a>
            </li>
            <li>
            @if(Auth::user())
                <a href="javascript:AlertIt();" class="nav-link m-2 nav-item">UITLOGGEN</a>
            @else 
                <a href="/login" class="nav-link m-2 nav-item">INLOGGEN</a>
            @endif
            </li>
        </ul>
    </div>
</nav>
<script type="text/javascript">
    function AlertIt() {
        var answer = confirm ("Weet je zeker dat je wilt uitloggen?")
        if (answer)
            window.location="/logout";
        else
            return false;
    }
</script>
