<!--Navbar-->
<nav class="navbar navbar-expand-lg navbar-light fixed-top scrolling-navbar">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">
            <img src="/images/remLogo35b4-1line-35h.png">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-7" aria-controls="navbarSupportedContent-7"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        @if(stripos($theme,'showNavItems')!==false)
        <div class="collapse navbar-collapse" id="navbarSupportedContent-7">
            <ul class="navbar-nav ml-auto nav-flex-icons">
                <li class="nav-item marginRight25">
                    <a class="nav-link" style="color:#fff;">PRICING</a>
                </li>
                <li class="nav-item marginRight25">
                    <a class="nav-link" style="color:#fff;">SEARCH FLYERS</a>
                </li>
                <li class="nav-item marginRight25">
                    <a class="nav-link" style="color:#fff;">FAQ</a>
                </li>
                <li class="nav-item marginRight25">
                    <a class="nav-link" style="color:#fff;">FREE TRIAL</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" style="color:#fff;">LOG IN</a>
                </li>
            </ul>
        </div>
        @endif
    </div>
</nav>