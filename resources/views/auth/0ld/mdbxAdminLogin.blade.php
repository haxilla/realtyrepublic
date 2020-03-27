<!DOCTYPE html>
<html lang="en" class="full-height">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Material Design Bootstrap</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="/corecss/mdb/bootstrap.min.css">
    <!-- Material Design Bootstrap -->
    <link rel="stylesheet" href="/corecss/mdb/mdb.min.css">

    <style>
        .intro-2 {
            background: url("images/admin/adminBeach.jpg")no-repeat center center;
            background-size: cover;
        }

        .top-nav-collapse {
            background-color: #9da4b1 !important;
        }

        .navbar:not(.top-nav-collapse) {
            background: transparent !important;
        }

        @media (max-width: 768px) {
            .navbar:not(.top-nav-collapse) {
                background: #9da4b1 !important;
            }
        }

        .rgba-gradient .full-bg-img {
            background: -webkit-linear-gradient(45deg, rgba(83, 125, 210, 0.4), rgba(178, 30, 123, 0.4) 100%);
            background: -webkit-gradient(linear, 45deg, from(rgba(29, 236, 197, 0.4)), to(rgba(96, 0, 136, 0.4)));
            background: linear-gradient(to 45deg, rgba(29, 236, 197, 0.4), rgba(96, 0, 136, 0.4) 100%);
        }

        .card {
            background-color: rgba(229, 228, 255, 0.2);
        }

        body {
            background-color: #fff;
        }

        h6 {
            line-height: 1.7;
        }

        @media (max-width: 740px) {
            .full-height,
            .full-height body,
            .full-height header,
            .full-height header .view {
                height: 1040px;
            }
        }

        footer.page-footer {
            background-color: #9da4b1;
        }
    </style>
</head>

<body>

    <!-- Main Navigation -->
    <header>

        <!--Navbar-->
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top scrolling-navbar">
            <div class="container">
                <div>
                    <h5 style="font-weight:bold;color:#fff;">
                        RealtyEmails Admin
                    </h5>
                </div>
            </div>
        </nav>

        <!-- Intro Section -->
        <section class="view intro-2 rgba-gradient">
            <div class="full-bg-img">
                <div class="container flex-center">
                    <div class="d-flex align-items-center content-height">
                        <div class="row flex-center pt-5 mt-3">
                            <div class="col-md-6 text-center text-md-left mb-5">
                                <div class="white-text">
                                    <h1 class="h1-responsive font-weight-bold wow fadeInLeft" data-wow-delay="0.3s">Welcome!</h1>
                                    <hr class="hr-light wow fadeInLeft" data-wow-delay="0.3s">
                                    <h6 class="wow fadeInLeft" data-wow-delay="0.3s">RealtyEmails.com has been serving Real Estate Agents Since 2006!</h6>
                                </div>
                            </div>

                            <div class="col-md-6 col-xl-5 offset-xl-1">
                                <!-- Form -->
                                <form role="form" method="POST" action="{{ route('admin.login.submit') }}">
                                {{ csrf_field() }}
                                <div class="card wow fadeInRight" data-wow-delay="0.3s">
                                    <div class="card-body">
                                        <!-- Header -->
                                        <div class="text-center">
                                            <h3 class="white-text"><i class="fa fa-user white-text"></i>Sign In:</h3>
                                            <hr class="hr-light">
                                        </div>

                                        <!-- Body -->
                                        <div class="md-form">
                                            <i class="fa fa-envelope prefix white-text"></i>
                                            <input name="email" type="text" id="adminEmail" class="form-control">
                                            <label for="form2" class="white-text">Username</label>
                                        </div>

                                        <div class="md-form">
                                            <i class="fa fa-lock prefix white-text"></i>
                                            <input name="password" type="password" id="adminPassword" class="form-control">
                                            <label for="form4" class="white-text">Password</label>
                                        </div>

                                        <div class="text-center mt-4">
                                            <button class="btn btn-light-blue btn-rounded">Log in</button>
                                            <hr class="hr-light mb-3 mt-4">

                                            <div class="inline-ul text-center d-flex justify-content-center">
                                                <a class="p-2 m-2 fa-lg tw-ic"><i class="fa fa-twitter white-text"></i></a>
                                                <a class="p-2 m-2 fa-lg li-ic"><i class="fa fa-linkedin white-text"> </i></a>
                                                <a class="p-2 m-2 fa-lg ins-ic"><i class="fa fa-instagram white-text"> </i></a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                </form>
                                <!-- /.Form -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </header>
    <!-- Main Navigation -->
</body>

</html>
