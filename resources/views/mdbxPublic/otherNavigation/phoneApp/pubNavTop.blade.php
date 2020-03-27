<!--Navbar-->
<nav class="navbar navbar-expand-lg navbar-light fixed-top scrolling-navbar"
style="z-index:700 !important;background:#fff !important;">
    <div class="mx-auto">
        <a class="navbar-brand" href="/"
        style="text-shadow:2px 2px 2px #fff;font-size:150%;font-family:Lora;">
            <img src="/images/remicon2.gif" 
            style="margin-right:5px;max-height:30px;">
            RealtyEmails
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-7" aria-controls="navbarSupportedContent-7"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        @if(stripos($theme,'showNavItems')!==false)
        <div class="collapse navbar-collapse" id="navbarSupportedContent-7">
            <ul class="navbar-nav ml-auto nav-flex-icons">
                <li class="nav-item marginRight25">
                    <a class="nav-link">Pricing</a>
                </li>
                <li class="nav-item marginRight25">
                    <a class="nav-link">Search Flyers</a>
                </li>
                <li class="nav-item marginRight25">
                    <a class="nav-link">FAQ</a>
                </li>
                <li class="nav-item marginRight25">
                    <a class="nav-link">Free Trial</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link">Sign In</a>
                </li>
            </ul>
        </div>
        @endif
    </div>
</nav>

<!-- Original Navbar
<nav class="navbar navbar-expand-lg navbar-dark fixed-top scrolling-navbar">
    <div class="container">
        <a class="navbar-brand" href="/"style="font-size:150%;">
            <strong><span style="color:#C19928">R</span>EALTY</strong>EMAILS<strong>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-7" aria-controls="navbarSupportedContent-7"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent-7">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/rosemary">Rosemary</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/elehu">Elehu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/fresh">Fresh</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
-->