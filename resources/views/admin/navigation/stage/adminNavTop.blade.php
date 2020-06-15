<!--Navbar-->
<div class="mediumSearch">
    <div class="vertical-center">
        <div class="navTopItem floatLeft">
            <div class="navTopInputDiv">
                <i class="inputIcon ti-search"></i>
                <input name="searchTerm" type="text"
                class="searchAll searchTerm navTopInputField
                mediumScreen">
            </div>
            <div class="mediumScreen autoResults">
            </div>
        </div>
        <div class="navTopItem floatRight navTopLink
        searchClose">
            <i class="ti-close"></i>
        </div>
    </div>
</div>
<div class="smallAdminNavbar">
    <div class="vertical-center">
        <ul class="noStyle floatLeft">
            <li class="navTopItem">
                <a class="navTopLink responsiveSearch">
                    <i class="submenuIcon ti-search"></i>Search
                </a>
            </li>
        </ul>
        <ul class="noStyle floatRight">
            <li class="navTopItem">
                <a class="navTopLink navTopAlert">
                    <i class="ti-bell"></i>
                </a>
            </li>
            <li class="navTopItem">
                <a class="navTopLink navTopAlert">
                    <i class="ti-comment"></i>
                </a>
            </li>
            <li class="navTopItem adminProfile">
                <a>
                    @if($adminInfo['adminPhoto'])
                        <img src="/images/admin/profilePhotos/{{$adminInfo['adminPhoto']}}">
                    @else
                        <img src="/images/admin/profilePhotos/noProfilePhoto3.jpg">
                    @endif
                    <span class="adminName">
                        {{$adminInfo['adminHandle']}}
                    </span>
                    <i class="dropArrow ti-angle-down"></i>
                </a>
            </li>
        </ul>
    </div>
</div>
<div class="navTop bg-primary">
    <div class="container-fluid navTopContainer">
        <a class="navTopLink show-md-down
        menuIcon leftCenter">
            <i class="ti-menu"></i>
        </a>
        <ul class="navTopMenu noStyle floatLeftLarge">
            <li class="navTopItem noStyle">
                <a class="navTopLogo" href="/admin">
                    <img src="/images/remLogoO.png">
                </a>
            </li
            ><li class="navTopItem navSearchBar show-md-up">
                <div class="show-lg-down responsiveSearch">
                    <a class="navTopLink circle bg-white-rgba1">
                        <i class="ti-search"></i>
                    </a>
                </div>
                <div class="navTopInputDiv show-lg-up">
                    <i class="inputIcon ti-search"></i>
                    <input name="searchTerm" type="text"
                    class="searchAll searchTerm navTopInputField
                    largeScreen">
                </div>
                <div class="autoResults largeScreen">
                </div>
            </li>
        </ul>
        <ul class="navTopMenu noStyle floatRight show-md-up">
            <li class="navTopItem show-md-up">
                <a class="navTopLink navTopAlert">
                    <i class="ti-bell"></i>
                </a>
            </li
            ><li class="navTopItem show-md-up">
                <a class="navTopLink navTopAlert">
                    <i class="ti-comment"></i>
                </a>
            </li
            ><li class="adminProfile navTopItem navTopDrop"
            data-droptitle="adminMenu">
                <a class="navTopLink dropTitle adminNavTop">
                    @if($adminInfo['adminPhoto'])
                        <img class="adminPhotoDisplay"
                        src="/images/admin/profilePhotos/{{$adminInfo['adminPhoto']}}">
                    @else
                        <img class="adminPhotoDisplay"
                        src="/images/admin/profilePhotos/noProfilePhoto3.jpg">
                    @endif
                    <span class="adminName">
                        {{$adminInfo['adminHandle']}}
                    </span>
                    <i class="dropArrow ti-angle-down"></i>
                </a>
                <ul class="noStyle adminMenu dropItems
                responsiveColumn oneColumn">
                    <li>
                        <a href="#" class="overlayLink"
                        data-menuClass="adminProfile">
                            <i class="submenuIcon ti-user">
                            </i><span>Profile</span>
                        </a>
                    </li>
                    <li>
                        <a href="/admin/logout">
                            <i class="submenuIcon ti-back-left">
                            </i><span>Log Out</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
        <a class="navTopLink show-md-down moreIcon rightCenter">
            <i class="ti-more"></i>
        </a>
    </div>
</div>
<div class="submenuContainer bg-secondary responsiveMenu">
    <div class="container-fluid fullHeight">
        <!-- left -->
        <ul class="submenu noStyle floatLeftLarge">
            <li class="submenuNav responsiveBorderTop-white"
            data-droptitle="dashboardMenu">
                <a class="dropTitle">
                    <i class="dropTitleIcon ti-dashboard">
                    </i><span class="dropTitleText">Dashboard</span>
                    <i class="dropArrow ti-angle-down"></i>
                </a>
                <ul class="noStyle dashboardMenu dropItems
                twoColumn responsiveColumn">
                    <li>
                        <a href="#">
                            <i class="submenuIcon ti-home">
                            </i><span>Home</span>
                        </a>
                    </li
                    ><li>
                        <a href="#">
                            <i class="submenuIcon ti-clipboard">
                            </i><span>Schedule</span>
                        </a>
                    </li
                    ><li>
                        <a href="#">
                            <i class="submenuIcon ti-shopping-cart">
                            </i><span>Sales</span>
                        </a>
                    </li
                    ><li>
                        <a href="/dev/index">
                            <i class="submenuIcon ti-desktop">
                            </i><span>Developer</span>
                        </a>
                    </li
                    ><li>
                        <a href="#">
                            <i class="submenuIcon ti-user">
                            </i><span>Agents</span>
                        </a>
                    </li
                    ><li>
                        <a href="/rets">
                            <i class="submenuIcon ti-plug">
                            </i><span>RETS</span>
                        </a>
                    </li
                    ><li>
                        <a href="#">
                            <i class="submenuIcon ti-agenda">
                            </i><span>Offices</span>
                        </a>
                    </li
                    ><li>
                        <a href="/admin/adre">
                            <i class="submenuIcon ti-id-badge">
                            </i><span>ADRE</span>
                        </a>
                    </li
                    ><li>
                        <a href="/admin/bounceAuto">
                            <i class="submenuIcon ti-alert">
                            </i><span>Bounces</span>
                        </a>
                    </li>
                </ul>
            </li
            ><li class="submenuNav" data-droptitle="adminCreateMenu">
                <a class="dropTitle">
                    <i class="dropTitleIcon ti-plus">
                    </i><span class="dropTitleText">Create</span
                    ><i class="dropArrow ti-angle-down"></i>
                </a>
                <ul class="noStyle adminCreateMenu dropItems
                oneColumn responsiveColumn">
                    <li>
                        <a href="#">
                            <i class="submenuIcon ti-image">
                            </i><span>Create Flyer</span>
                        </a>
                    </li
                    ><li class="#">
                        <a href="#">
                            <i class="submenuIcon ti-user">
                            </i><span>Create Account</span>
                        </a>
                    </li>
                </ul>
            </li
            ><li class="submenuNav" data-droptitle="advancedMenu">
                <a class="dropTitle">
                    <i class="dropTitleIcon ti-panel">
                    </i><span class="dropTitleText">Advanced</span
                    ><i class="dropArrow ti-angle-down"></i>
                </a>
                <ul class="noStyle advancedMenu dropItems
                twoColumn responsiveColumn">
                    <li>
                        <a href="#" class="overlayLink"
                        data-menuclass="autosynch">
                            <i class="submenuIcon ti-reload">
                            </i><span>Synch</span>
                        </a>
                    </li
                    ><li>
                      <a href="#" class="overlayLink"
                      data-menuclass="passwordfix">
                        <i class="submenuIcon ti-lock">
                        </i><span>Password Fix</span>
                      </a>
                    </li
                    ><li>
                        <a href="#">
                            <i class="submenuIcon ti-settings">
                            </i><span>Site Modes</span>
                        </a>
                    </li
                    ><li>
                        <a href="#">
                            <i class="submenuIcon ti-alert">
                            </i><span>Logs</span>
                        </a>
                    </li
                    ><li>
                        <a href="#">
                            <i class="submenuIcon ti-rocket">
                            </i><span>Distro Test</span>
                        </a>
                    </li
                    ><li class="#">
                        <a href="#">
                            <i class="submenuIcon ti-crown">
                            </i><span>Add Admin</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
        <!-- right -->
        <ul class="submenu noStyle floatRightLarge">
            <li class="submenuNav" data-droptitle="adminIdeas">
                <a class="dropTitle">
                    <i class="dropTitleIcon ti-thought"></i>
                </a>
                <ul class="noStyle dropItems">
                </ul>
            </li
            ><li class="submenuNav" data-droptitle="adminTicket">
                <a class="dropTitle">
                    <i class="dropTitleIcon ti-ticket"></i>
                </a>
                <ul class="noStyle dropItems">
                </ul>
            </li
            ><li class="submenuNav" data-droptitle="adminBugSplat">
                <a class="dropTitle">
                    <i class="dropTitleIcon ti-unlink"></i>
                </a>
                <ul class="noStyle dropItems">
                </ul>
            </li>
        </ul>
    </div>
</div>
<div class="navbarBuffer">
</div>
