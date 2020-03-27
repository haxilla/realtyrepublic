<!DOCTYPE html>
<!-- class="full-height" //for introLanding -->
<html lang="en">

<head>
    @include('mdbxPublic.otherHeaders.rift.pubHeader')
</head>

<body>

    <!--Main Navigation-->
    <header>

        <!--Navbar-->
        @include('mdbxPublic.otherNavigation.rift.pubNavTop')
        <!--  uncomment for landing page as well as html class="full-height" -->
        <!-- @ include('mdbxPublic.includes.sections.intro') -->

    </header>
    <!--Main Navigation-->

    <!--Main content-->
    <main>
        <div class="background-darktweed2">
            <div class="container" style="padding-top:85px;">
                @include('mdbxPublic.otherIncludes.rift.splitCarousel')
            </div>
        </div>
        <div class="container-fluid">
            @include('mdbxPublic.otherIncludes.rift.mainAd')
        </div>
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
                                    <a href="/mango">Mango</a>
                                </div>                                
                                <div>
                                    <a href="/rift">Rift</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        <!--First container-->
        <div class="container">

            <!--Section: Features v.1-->
            <section id="features" class="section feature-box mb-5">

                <!--Section heading-->
                <h1 class="mb-3 my-5 pt-5 dark-grey-text wow fadeIn" data-wow-delay="0.2s"><strong class="font-bold">Lorem ipsum</strong> dolor sit amet</h1>

                <!--Section description-->
                <p class="section-description wow fadeIn" data-wow-delay="0.2s">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laborum quas, eos officia maiores ipsam ipsum dolores reiciendis
                    ad voluptas, animi obcaecati adipisci sapiente mollitia.</p>

                <!--First row-->
                <div class="row features wow fadeIn" data-wow-delay="0.2s">

                    <div class="col-lg-4 text-center">
                        <div class="icon-area">
                            <div class="circle-icon">
                                <i class="fa fa-gears blue-text"></i>
                            </div>
                            <br>
                            <h5 class="dark-grey-text font-bold mt-2">Customization</h5>
                            <div class="mt-1">
                                <p class="mx-3 grey-text">Lorem Ipsum is simply dummy text of the printing and typesetting let. Lorem ipsum dolor sit
                                    amet, consectetur adipisicing elit.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 text-center">
                        <div class="icon-area">
                            <div class="circle-icon">
                                <i class="fa fa-book blue-text"></i>
                            </div>
                            <br>
                            <h5 class="dark-grey-text font-bold mt-2">Easy tutorials</h5>
                            <div class="mt-1">
                                <p class="mx-3 grey-text">Lorem Ipsum is simply dummy text of the printing and typesetting let. Lorem ipsum dolor sit
                                    amet, consectetur adipisicing elit.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 text-center mb-4">
                        <div class="icon-area">
                            <div class="circle-icon">
                                <i class="fa fa-users blue-text"></i>
                            </div>
                            <br>
                            <h5 class="dark-grey-text font-bold mt-2">Free support</h5>
                            <div class="mt-1">
                                <p class="mx-3 grey-text">Lorem Ipsum is simply dummy text of the printing and typesetting let. Lorem ipsum dolor sit
                                    amet, consectetur adipisicing elit.</p>
                            </div>
                        </div>
                    </div>

                </div>
                <!--/First row-->

            </section>
            <!--/Section: Features v.1-->

        </div>
        <!--First container-->

        <!--Second container-->
        <div class="container-fluid" style="background-color: #f9f9f9">
            <div class="container py-4">

                <!--Section: Download-->
                <section>

                    <!-- First row -->
                    <div class="row my-4 pt-5 wow fadeIn" data-wow-delay="0.4s">

                        <!-- First column -->
                        <div class="col-lg-7 col-md-12 mb-r text-center">
                            <img src="https://mdbootstrap.com/img/Photos/Others/screen.jpg" alt="" class="img-fluid z-depth-2 rounded">
                        </div>
                        <!-- /First column -->

                        <!-- Second column -->
                        <div class="col-lg-5 col-md-12 mb-r text-left">

                            <!--Section heading-->
                            <h2 class="mb-3 my-5 dark-grey-text wow fadeIn" data-wow-delay="0.2s"><strong class="font-bold">Download</strong> the application</h2>

                            <p class="grey-text mb-4">Lorem Ipsum is simply dummy text of the printing and typesetting let. Lorem ipsum dolor sit amet,
                                consectetur adipisicing elit.</p>
                            <a class="btn btn-white btn-rounded blue-text font-bold ml-0 wow fadeIn" data-wow-delay="0.2s"><i class="fa fa-android pr-2" aria-hidden="true"></i> Play store</a>
                            <a class="btn btn-white btn-rounded blue-text font-bold wow fadeIn" data-wow-delay="0.2s"><i class="fa fa-apple pr-2" aria-hidden="true"></i> App store</a>
                        </div>
                        <!-- /.Second column -->

                    </div>
                    <!-- /.First row -->

                </section>
                <!--/Section: Download-->

            </div>
        </div>
        <!--Second container-->

        <!--Third container-->
        <div class="streak streak-md streak-photo" style="background-image:url('https://mdbootstrap.com/img/Photos/Others/architecture.jpg')">
            <div class="flex-center white-text blue-gradient-mask">
                <div class="container py-3">

                    <!--Section: Features v.4-->
                    <section class="section feature-box wow fadeIn" data-wow-delay="0.2s">

                        <!--Section heading-->
                        <h1 class="py-5 my-5 white-text text-center wow fadeIn" data-wow-delay="0.2s"><strong class="font-bold">Lorem ipsum</strong> dolor sit amet</h1>

                        <!--Grid row-->
                        <div class="row features-small mb-5">

                            <!--Grid column-->
                            <div class="col-md-12 col-lg-4">

                                <!--Grid row-->
                                <div class="row mb-5">
                                    <div class="col-3">
                                        <a type="button" class="btn-floating white btn-lg my-0"><i class="fa fa-tablet blue-text" aria-hidden="true"></i></a>
                                    </div>
                                    <div class="col-9">
                                        <h5 class="feature-title white-text">Fully responsive</h5>
                                        <p class="white-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reprehenderit maiores.</p>
                                    </div>
                                </div>
                                <!--Grid row-->

                                <!--Grid row-->
                                <div class="row mb-5">
                                    <div class="col-3">
                                        <a type="button" class="btn-floating white btn-lg my-0"><i class="fa fa-level-up blue-text" aria-hidden="true"></i></a>
                                    </div>
                                    <div class="col-9">
                                        <h5 class="feature-title white-text">Frequent updates</h5>
                                        <p class="white-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reprehenderit maiores.</p>
                                    </div>
                                </div>
                                <!--Grid row-->

                                <!--Grid row-->
                                <div class="row mb-5">
                                    <div class="col-3">
                                        <a type="button" class="btn-floating white btn-lg my-0"><i class="fa fa-phone blue-text" aria-hidden="true"></i></a>
                                    </div>
                                    <div class="col-9">
                                        <h5 class="feature-title white-text">Technical support</h5>
                                        <p class="white-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reprehenderit maiores nam.</p>
                                    </div>
                                </div>
                                <!--Grid row-->

                            </div>
                            <!--Grid column-->

                            <!--Grid column-->
                            <div class="col-md-12 col-lg-4 px-5 mb-2 center-on-small-only flex-center">
                                <img src="https://mdbootstrap.com/img/Mockups/Transparent/Small/admin-new1.png" alt="" class="z-depth-0 img-fluid">
                            </div>
                            <!--Grid column-->

                            <!--Grid column-->
                            <div class="col-md-12 col-lg-4">

                                <!--Grid row-->
                                <div class="row mb-5">
                                    <div class="col-3">
                                        <a type="button" class="btn-floating white btn-lg my-0"><i class="fa fa-object-group blue-text" aria-hidden="true"></i></a>
                                    </div>
                                    <div class="col-9">
                                        <h5 class="feature-title white-text">Editable layout</h5>
                                        <p class="white-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reprehenderit maiores nam.</p>
                                    </div>
                                </div>
                                <!--Grid row-->

                                <!--Grid row-->
                                <div class="row mb-5">
                                    <div class="col-3">
                                        <a type="button" class="btn-floating white btn-lg my-0"><i class="fa fa-rocket blue-text" aria-hidden="true"></i></a>
                                    </div>
                                    <div class="col-9">
                                        <h5 class="feature-title white-text">Fast and powerful</h5>
                                        <p class="white-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reprehenderit maiores nam.</p>
                                    </div>
                                </div>
                                <!--Grid row-->

                                <!--Grid row-->
                                <div class="row mb-5">
                                    <div class="col-3">
                                        <a type="button" class="btn-floating white btn-lg my-0"><i class="fa fa-cloud-upload blue-text" aria-hidden="true"></i></a>
                                    </div>
                                    <div class="col-9">
                                        <h5 class="feature-title white-text">Cloud storage</h5>
                                        <p class="white-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reprehenderit maiores nam.</p>
                                    </div>
                                </div>
                                <!--Grid row-->

                            </div>
                            <!--Grid column-->

                        </div>
                        <!--Grid row-->

                    </section>
                    <!--/Section: Features v.4-->
                </div>
            </div>
        </div>
        <!--/Third container-->

        <!--/Fourth container-->
        <div class="container">

            <!--Section: Pricing v.3-->
            <section class="section mt-4 mb-5">

                <!--Section heading-->
                <h1 class="mb-3 my-5 pt-5 text-center dark-grey-text wow fadeIn" data-wow-delay="0.2s"><strong class="font-bold">Lorem ipsum</strong> dolor sit amet</h1>

                <!--Section description-->
                <p class="section-description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugit, error amet numquam iure provident voluptate
                    esse quasi, veritatis totam voluptas nostrum quisquam eum porro a pariatur accusamus veniam.</p>

                <!--First row-->
                <div class="row">

                    <!--First column-->
                    <div class="col-lg-4 col-md-12 mb-r">
                        <!--Card-->
                        <div class="card">

                            <!--Content-->
                            <div class="text-center">
                                <div class="card-body">
                                    <h5>Basic plan</h5>
                                    <div class="flex-center">
                                        <div class="card-circle">
                                            <i class="fa fa-home blue-text"></i>
                                        </div>
                                    </div>

                                    <!--Price-->
                                    <h2 class="font-bold dark-grey-text"><strong>59$</strong></h2>
                                    <p class="grey-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Culpa pariatur id nobis accusamus
                                        deleniti cumque hic laborum.</p>
                                    <a class="btn btn-blue font-bold btn-rounded">Buy now</a>
                                </div>
                            </div>

                        </div>
                        <!--/.Card-->
                    </div>
                    <!--/First column-->

                    <!--Second column-->
                    <div class="col-lg-4 col-md-12 mb-r">
                        <!--Card-->
                        <div class="card blue-gradient">

                            <!--Content-->
                            <div class="text-center white-text">
                                <div class="card-body">
                                    <h5>Premium plan</h5>
                                    <div class="flex-center">
                                        <div class="card-circle">
                                            <i class="fa fa-group white-text"></i>
                                        </div>
                                    </div>

                                    <!--Price-->
                                    <h2 class="font-bold white-text"><strong>79$</strong></h2>
                                    <p>Esse corporis saepe laudantium velit adipisci cumque iste ratione facere non distinctio
                                        cupiditate sequi atque.</p>
                                    <a class="btn btn-white font-bold btn-rounded">Buy now</a>
                                </div>
                            </div>

                        </div>
                        <!--/.Card-->
                    </div>
                    <!--/Second column-->

                    <!--Third column-->
                    <div class="col-lg-4 col-md-12 mb-r">
                        <!--Card-->
                        <div class="card">

                            <!--Content-->
                            <div class="text-center">
                                <div class="card-body">
                                    <h5>Advanced plan</h5>
                                    <div class="flex-center">
                                        <div class="card-circle">
                                            <i class="fa fa-bar-chart blue-text"></i>
                                        </div>
                                    </div>

                                    <!--Price-->
                                    <h2 class="font-bold dark-grey-text"><strong>99$</strong></h2>
                                    <p class="grey-text">At ab ea a molestiae corrupti numquam quo beatae minima ratione magni accusantium repellat
                                        eveniet quia vitae.</p>
                                    <a class="btn btn-blue font-bold btn-rounded">Buy now</a>
                                </div>
                            </div>

                        </div>
                        <!--/.Card-->
                    </div>
                    <!--/Third column-->

                </div>
                <!--/First row-->

            </section>
            <!--/Section: Pricing v.3-->

            <hr>


            <!--Section: Testimonials v.4-->
            <section class="section text-center pb-4">

                <!--Section heading-->
                <h1 class="mb-5 my-5 pt-5 text-center dark-grey-text wow fadeIn" data-wow-delay="0.2s"><strong class="font-bold">Our clients</strong> about us</h1>

                <div class="row">

                    <!--Carousel Wrapper-->
                    <div id="multi-item-example" class="carousel testimonial-carousel slide carousel-multi-item wow fadeIn" data-ride="carousel">

                        <!--Controls-->
                        <div class="controls-top">
                            <a class="btn-floating btn-blue btn-sm" href="#multi-item-example" data-slide="prev"><i class="fa fa-chevron-left"></i></a>
                            <a class="btn-floating btn-blue btn-sm" href="#multi-item-example" data-slide="next"><i class="fa fa-chevron-right"></i></a>
                        </div>
                        <!--Controls-->

                        <!--Slides-->
                        <div class="carousel-inner" role="listbox">

                            <!--First slide-->
                            <div class="carousel-item active">
                                <!--Grid column-->
                                <div class="col-md-4">

                                    <div class="testimonial">
                                        <!--Avatar-->
                                        <div class="avatar">
                                            <img src="https://mdbootstrap.com/img/Photos/Avatars/img%20(26).jpg" class="rounded-circle img-fluid">
                                        </div>
                                        <!--Content-->
                                        <h4 class="dark-grey-text">Anna Deynah</h4>
                                        <h6 class="blue-text font-bold">Web Designer</h6>
                                        <p><i class="fa fa-quote-left"></i> Lorem ipsum dolor sit amet, consectetur adipisicing
                                            elit.
                                        </p>

                                        <!--Review-->
                                        <div class="grey-text">
                                            <i class="fa fa-star"> </i>
                                            <i class="fa fa-star"> </i>
                                            <i class="fa fa-star"> </i>
                                            <i class="fa fa-star"> </i>
                                            <i class="fa fa-star-half-full"> </i>
                                        </div>
                                    </div>

                                </div>
                                <!--Grid column-->

                                <!--Grid column-->
                                <div class="col-md-4 clearfix d-none d-md-block">
                                    <div class="testimonial">
                                        <!--Avatar-->
                                        <div class="avatar">
                                            <img src="https://mdbootstrap.com/img/Photos/Avatars/img%20(8).jpg" class="rounded-circle img-fluid">
                                        </div>
                                        <!--Content-->
                                        <h4 class="dark-grey-text">John Doe</h4>
                                        <h6 class="blue-text font-bold">Web Developer</h6>
                                        <p><i class="fa fa-quote-left"></i> Ut enim ad minima veniam, quis nostrum exercitationem.</p>

                                        <!--Review-->
                                        <div class="grey-text">
                                            <i class="fa fa-star"> </i>
                                            <i class="fa fa-star"> </i>
                                            <i class="fa fa-star"> </i>
                                            <i class="fa fa-star"> </i>
                                            <i class="fa fa-star"> </i>
                                        </div>
                                    </div>
                                </div>
                                <!--Grid column-->

                                <!--Grid column-->
                                <div class="col-md-4 clearfix d-none d-md-block">
                                    <div class="testimonial">
                                        <!--Avatar-->
                                        <div class="avatar">
                                            <img src="https://mdbootstrap.com/img/Photos/Avatars/img%20(31).jpg" class="rounded-circle img-fluid">
                                        </div>
                                        <!--Content-->
                                        <h4 class="dark-grey-text">Abbey Clark</h4>
                                        <h6 class="blue-text font-bold">Photographer</h6>
                                        <p><i class="fa fa-quote-left"></i> Quis autem vel eum iure reprehenderit qui in ea
                                            voluptate.
                                        </p>

                                        <!--Review-->
                                        <div class="grey-text">
                                            <i class="fa fa-star"> </i>
                                            <i class="fa fa-star"> </i>
                                            <i class="fa fa-star"> </i>
                                            <i class="fa fa-star"> </i>
                                            <i class="fa fa-star-o"> </i>
                                        </div>
                                    </div>
                                </div>
                                <!--Grid column-->

                            </div>
                            <!--First slide-->

                            <!--Second slide-->
                            <div class="carousel-item">
                                <!--Grid column-->
                                <div class="col-md-4">

                                    <div class="testimonial">
                                        <!--Avatar-->
                                        <div class="avatar">
                                            <img src="https://mdbootstrap.com/img/Photos/Avatars/img%20(4).jpg" class="rounded-circle img-fluid">
                                        </div>
                                        <!--Content-->
                                        <h4 class="dark-grey-text">Blake Dabney</h4>
                                        <h6 class="blue-text font-bold">Web Designer</h6>
                                        <p><i class="fa fa-quote-left"></i> Ut enim ad minima veniam, quis nostrum exercitationem.</p>

                                        <!--Review-->
                                        <div class="grey-text">
                                            <i class="fa fa-star"> </i>
                                            <i class="fa fa-star"> </i>
                                            <i class="fa fa-star"> </i>
                                            <i class="fa fa-star"> </i>
                                            <i class="fa fa-star-half-full"> </i>
                                        </div>
                                    </div>

                                </div>
                                <!--Grid column-->

                                <!--Grid column-->
                                <div class="col-md-4 clearfix d-none d-md-block">
                                    <div class="testimonial">
                                        <!--Avatar-->
                                        <div class="avatar">
                                            <img src="https://mdbootstrap.com/img/Photos/Avatars/img%20(5).jpg" class="rounded-circle img-fluid">
                                        </div>
                                        <!--Content-->
                                        <h4 class="dark-grey-text">Andrea Clay</h4>
                                        <h6 class="blue-text font-bold">Front-end developer</h6>
                                        <p><i class="fa fa-quote-left"></i> Lorem ipsum dolor sit amet, consectetur adipisicing
                                            elit.
                                        </p>

                                        <!--Review-->
                                        <div class="grey-text">
                                            <i class="fa fa-star"> </i>
                                            <i class="fa fa-star"> </i>
                                            <i class="fa fa-star"> </i>
                                            <i class="fa fa-star"> </i>
                                            <i class="fa fa-star"> </i>
                                        </div>
                                    </div>
                                </div>
                                <!--Grid column-->

                                <!--Grid column-->
                                <div class="col-md-4 clearfix d-none d-md-block">
                                    <div class="testimonial">
                                        <!--Avatar-->
                                        <div class="avatar">
                                            <img src="https://mdbootstrap.com/img/Photos/Avatars/img%20(28).jpg" class="rounded-circle img-fluid">
                                        </div>
                                        <!--Content-->
                                        <h4 class="dark-grey-text">Cami Gosse</h4>
                                        <h6 class="blue-text font-bold">Phtographer</h6>
                                        <p><i class="fa fa-quote-left"></i> At vero eos et accusamus et iusto odio dignissimos.</p>

                                        <!--Review-->
                                        <div class="grey-text">
                                            <i class="fa fa-star"> </i>
                                            <i class="fa fa-star"> </i>
                                            <i class="fa fa-star"> </i>
                                            <i class="fa fa-star"> </i>
                                            <i class="fa fa-star-o"> </i>
                                        </div>
                                    </div>
                                </div>
                                <!--Grid column-->

                            </div>
                            <!--Second slide-->

                        </div>
                        <!--Slides-->

                    </div>
                    <!--Carousel Wrapper-->

                </div>

            </section>
            <!--Section: Testimonials v.4-->

        </div>
        <!--/Fourth container-->

    </main>
    <!--Main content-->


    <!--Footer-->
    <footer class="page-footer center-on-small-only blue-grey lighten-5 pt-0">

        <div style="background-color: #5991fb;">
            <div class="container">
                <!--Grid row-->
                <div class="row py-4 d-flex align-items-center">

                    <!--Grid column-->
                    <div class="col-12 col-md-5 text-left mb-md-0">
                        <h6 class="mb-0 white-text text-center text-md-left"><strong>Get connected with us on social networks!</strong></h6>
                    </div>
                    <!--Grid column-->

                    <!--Grid column-->
                    <div class="col-12 col-md-7 text-center text-md-right">
                        <!--Facebook-->
                        <a class="icons-sm fb-ic ml-0"><i class="fa fa-facebook white-text mr-lg-4"> </i></a>
                        <!--Twitter-->
                        <a class="icons-sm tw-ic"><i class="fa fa-twitter white-text mr-lg-4"> </i></a>
                        <!--Google +-->
                        <a class="icons-sm gplus-ic"><i class="fa fa-google-plus white-text mr-lg-4"> </i></a>
                        <!--Linkedin-->
                        <a class="icons-sm li-ic"><i class="fa fa-linkedin white-text mr-lg-4"> </i></a>
                        <!--Instagram-->
                        <a class="icons-sm ins-ic"><i class="fa fa-instagram white-text mr-lg-4"> </i></a>
                    </div>
                    <!--Grid column-->

                </div>
                <!--Grid row-->
            </div>
        </div>

        <!--Footer Links-->
        <div class="container mt-5 mb-4 text-center text-md-left">
            <div class="row mt-3">

                <!--First column-->
                <div class="col-md-3 col-lg-4 col-xl-3 mb-r dark-grey-text">
                    <h6 class="title font-bold"><strong>Company name</strong></h6>
                    <hr class="blue mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
                    <p>Here you can use rows and columns here to organize your footer content. Lorem ipsum dolor sit amet, consectetur
                        adipisicing elit.</p>
                </div>
                <!--/.First column-->

                <!--Second column-->
                <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-r dark-grey-text">
                    <h6 class="title font-bold"><strong>Products</strong></h6>
                    <hr class="blue mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
                    <p><a href="#!" class="dark-grey-text">MDBootstrap</a></p>
                    <p><a href="#!" class="dark-grey-text">MDWordPress</a></p>
                    <p><a href="#!" class="dark-grey-text">BrandFlow</a></p>
                    <p><a href="#!" class="dark-grey-text">Bootstrap Angular</a></p>
                </div>
                <!--/.Second column-->

                <!--Third column-->
                <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-r dark-grey-text">
                    <h6 class="title font-bold"><strong>Useful links</strong></h6>
                    <hr class="blue mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
                    <p><a href="#!" class="dark-grey-text">Your Account</a></p>
                    <p><a href="#!" class="dark-grey-text">Become an Affiliate</a></p>
                    <p><a href="#!" class="dark-grey-text">Shipping Rates</a></p>
                    <p><a href="#!" class="dark-grey-text">Help</a></p>
                </div>
                <!--/.Third column-->

                <!--Fourth column-->
                <div class="col-md-4 col-lg-3 col-xl-3 dark-grey-text">
                    <h6 class="title font-bold"><strong>Contact</strong></h6>
                    <hr class="blue mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
                    <p><i class="fa fa-home mr-3"></i> New York, NY 10012, US</p>
                    <p><i class="fa fa-envelope mr-3"></i> info@example.com</p>
                    <p><i class="fa fa-phone mr-3"></i> + 01 234 567 88</p>
                    <p><i class="fa fa-print mr-3"></i> + 01 234 567 89</p>
                </div>
                <!--/.Fourth column-->

            </div>
        </div>
        <!--/.Footer Links-->

        <!-- Copyright-->
        <div class="footer-copyright">
            <div class="container-fluid">
                © 2017 Copyright: <a href="https://www.MDBootstrap.com"><strong> MDBootstrap.com</strong></a>
            </div>
        </div>
        <!--/.Copyright -->

    </footer>
    <!--/.Footer-->


    <!-- SCRIPTS -->

    <!-- JQuery -->
    <script type="text/javascript" src="/landingJS/jquery-3.2.1.min.js"></script>

    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="/landingJS/popper.min.js"></script>

    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="/landingJS/bootstrap.min.js"></script>

    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="/landingJS/mdb.min.js"></script>

    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="/customJS/modernizr-custom.js"></script>
    <script type="text/javascript" src="/customJS/IEfix.js"></script>

    <script>
        //Animation init
        new WOW().init();

        //Modal
        $('#myModal').on('shown.bs.modal', function () {
            $('#myInput').focus()
        })

        // Material Select Initialization
        $(document).ready(function () {
            $('.mdb-select').material_select();
        });
    </script>

</body>

</html>