<!--Navbar-->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top scrolling-navbar
@if(strpos($theme,'gray8080') !== false)
    background-gray808080
@else
    background-transBlack6
@endif">
    <div class="container">
        <a class="navbar-brand" href="/"
        style="font-size:150%;">
            <strong><span style="color:#c19928;font-weight:700">R</span>EALTY</strong>EMAILS
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-7" aria-controls="navbarSupportedContent-7"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent-7">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Styles
                    </a>
                    <span class="sr-only">(current)</span></a>
                    <div class="dropdown-menu mega-menu" aria-labelledby="navbarDropdown">
                        <div class="row">
                            <div class="col-md-3">
                                <div style="background:rgba(0,0,0,.5);
                                text-align:center;padding:10px;">
                                    <div>
                                        <img src="/images/remicon.png" 
                                        class="img-fluid" style="max-height:35px;">
                                    </div>
                                    <div>
                                        <a href="/">
                                            <h4 style="color:#c19928">Home</h4>
                                        </a>
                                    </div>
                                    <p style="color:#fff;">You are on Default Style</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div>
                                    <a href="/rosemary">Rosemary</a>
                                </div>
                                <div>
                                    <a href="/elehu">Elehu</a>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div>
                                    <a href="/fresh">Fresh</a>
                                </div>                                
                                <div>
                                    <div>
                                        <a href="/guyute" style="padding:0;">
                                            Guyute
                                        </a>
                                    </div>
                                    <div>
                                        <a href="/guyute?theme=gray808080" 
                                        style="padding:0;">
                                            Gray Nav
                                        </a>
                                    </div>
                                    <div>
                                        <a href="/guyute?theme=noguy" 
                                        style="padding:0;">
                                            No Guy
                                        </a>
                                    </div>
                                    <div>
                                        <a href="/guyute?theme=gray8080noguy" 
                                        style="padding:0;">
                                            Gray No Guy
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div>
                                    <a href="/Mango">Mango</a>
                                </div>                                
                                <div>
                                    <a href="/guyute">Other 2</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
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