<!--Navbar-->
<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand noBrand" href="/">
            <img src="/images/remLogoO.png">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" 
        data-target="#navbarSupportedContent-7" 
        aria-controls="navbarSupportedContent-7"
        aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent-7">
            <ul class="navbar-nav ml-auto nav-flex-icons">
                    <li class="nav-item" style="margin-right:15px;">
                        @if(strpos($theme,'redSignup')!==false)
                        <div style="background:linear-gradient(#f6d365, #fda085);
                        padding:2px; padding-right:3px;border-radius:2em;margin:7px;">
                            <a class="nav-link"
                            style="color:#fff;padding:5px 10px;
                            border-radius:2em;background:#900;" 
                            onclick="dimensionHelper()">
                                Sign Up
                            </a>
                        </div>
                        @else
                            <a class="nav-link" style="color:#fff;
                            margin:7px;" onclick="dimensionHelper()">
                                Sign Up
                            </a>
                        @endif
                    </li>
                    <li class="nav-item" style="margin-top:7px;">
                        <a class="nav-link" style="color:#fff;">
                            Log In
                        </a>
                    </li>
                </a>
            </ul>
        </div>
    </div>
</nav>