<!DOCTYPE html>
<!-- Designined by CodingLab | www.youtube.com/codinglabyt -->
<html lang="en" dir="ltr">
<style>
    .footer-dark {
        padding: 50px 0;
        color: #f0f9ff;
        background-color: #282d32;
    }

    .footer-dark h3 {
        margin-top: 0;
        margin-bottom: 12px;
        font-weight: bold;
        font-size: 16px;
    }

    .footer-dark ul {
        padding: 0;
        list-style: none;
        line-height: 1.6;
        font-size: 14px;
        margin-bottom: 0;
    }

    .footer-dark ul a {
        color: inherit;
        text-decoration: none;
        opacity: 0.6;
    }

    .footer-dark ul a:hover {
        opacity: 0.8;
    }

    @media (max-width:767px) {
        .footer-dark .item:not(.social) {
            text-align: center;
            padding-bottom: 20px;
        }
    }

    .footer-dark .item.text {
        margin-bottom: 36px;
    }

    @media (max-width:767px) {
        .footer-dark .item.text {
            margin-bottom: 0;
        }
    }

    .footer-dark .item.text p {
        opacity: 0.6;
        margin-bottom: 0;
    }

    .footer-dark .item.social {
        text-align: center;
    }

    @media (max-width:991px) {
        .footer-dark .item.social {
            text-align: center;
            margin-top: 20px;
        }
    }

    .footer-dark .item.social>a {
        font-size: 20px;
        width: 36px;
        height: 36px;
        line-height: 36px;
        display: inline-block;
        text-align: center;
        border-radius: 50%;
        box-shadow: 0 0 0 1px rgba(255, 255, 255, 0.4);
        margin: 0 8px;
        color: #fff;
        opacity: 0.75;
    }

    .footer-dark .item.social>a:hover {
        opacity: 0.9;
    }

    .footer-dark .copyright {
        text-align: center;
        padding-top: 24px;
        opacity: 0.3;
        font-size: 13px;
        margin-bottom: 0;
    }
</style>

<head>
    <meta charset="UTF-8">
    <title> Drop Down Sidebar Menu | CodingLab </title>
    <link rel="stylesheet" href="style.css">
    <!-- Boxiocns CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @yield('style')
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <style>
        #alertsContainer {
            z-index: 999;
            max-height: 300px;
            overflow: hidden;
            position: fixed;
            top: 80px;
            right: 10px;
            display: flex;
            flex-direction: column-reverse;
            align-items: flex-end;
        }
    </style>
    <div class="sidebar close">
        <div class="logo-details ">
            <div style="min-width: 78px; min-height:78px; max-width: 78px; max-height:78px;"
                class=" d-flex justify-content-center align-items-center">
                <img src="{{ asset('icons/open-book.png') }}" class="" width="50%" alt="">
            </div>
            <span class="logo_name">E-Library </span>
        </div>
        <ul class="nav-links">
            <li>
                <a href="#">
                    <i class='bx bx-grid-alt'></i>
                    <span class="link_name">Dashboard</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="#">Category</a></li>
                </ul>
            </li>
            <li>
                <div class="iocn-link">
                    <a href="#">
                        <i class='bx bx-collection'></i>
                        <span class="link_name">Category</span>
                    </a>
                    <i class='bx bxs-chevron-down arrow'></i>
                </div>
                <ul class="sub-menu">
                    <li><a class="link_name" href="#">Category</a></li>
                    <li><a href="#">HTML & CSS</a></li>
                    <li><a href="#">JavaScript</a></li>
                    <li><a href="#">PHP & MySQL</a></li>
                </ul>
            </li>
            <li>
                <div class="iocn-link">
                    <a href="#">
                        <i class='bx bx-book-alt'></i>
                        <span class="link_name">Posts</span>
                    </a>
                    <i class='bx bxs-chevron-down arrow'></i>
                </div>
                <ul class="sub-menu">
                    <li><a class="link_name" href="#">Posts</a></li>
                    <li><a href="#">Web Design</a></li>
                    <li><a href="#">Login Form</a></li>
                    <li><a href="#">Card Design</a></li>
                </ul>
            </li>
            <li>
                <a href="#">
                    <i class='bx bx-pie-chart-alt-2'></i>
                    <span class="link_name">Analytics</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="#">Analytics</a></li>
                </ul>
            </li>
            <li>
                <a href="#">
                    <i class='bx bx-line-chart'></i>
                    <span class="link_name">Chart</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="#">Chart</a></li>
                </ul>
            </li>
            <li>
                <div class="iocn-link">
                    <a href="#">
                        <i class='bx bx-plug'></i>
                        <span class="link_name">Plugins</span>
                    </a>
                    <i class='bx bxs-chevron-down arrow'></i>
                </div>
                <ul class="sub-menu">
                    <li><a class="link_name" href="#">Plugins</a></li>
                    <li><a href="#">UI Face</a></li>
                    <li><a href="#">Pigments</a></li>
                    <li><a href="#">Box Icons</a></li>
                </ul>
            </li>
            <li>
                <a href="#">
                    <i class='bx bx-compass'></i>
                    <span class="link_name">Explore</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="#">Explore</a></li>
                </ul>
            </li>
            <li>
                <a href="#">
                    <i class='bx bx-history'></i>
                    <span class="link_name">History</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="#">History</a></li>
                </ul>
            </li>
            <li>
                <a href="#">
                    <i class='bx bx-cog'></i>
                    <span class="link_name">Setting</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="#">Setting</a></li>
                </ul>
            </li>
            <li>
                <div class="profile-details">
                    <div class="profile-content">
                        <img src="{{ asset('images/Screenshot 2023-11-24 175541.png') }}" alt="profileImg">
                    </div>
                    <div class="name-job">
                        <div class="profile_name">Prem Shahi</div>
                        <div class="job">Web Desginer</div>
                    </div>
                    <i class='bx bx-log-out'></i>
                </div>
            </li>
        </ul>
    </div>

    {{-- ||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||\ --}}


    <section class="home-section m-0 p-0">
        <div class="home-content m-0 p-0">
            <div class="container-fluid shadow d-flex justify-content-between align-content-center ">
                <div class=" pt-3 pb-2">
                    <i class='bx bx-menu'></i>
                </div>
                {{-- <ul class="navbar-nav ms-auto d-flex justify-content-between align-content-center pt-3">
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link btn btn-light p-4 pt-1 pb-1"
                                    href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown d-flex mt-1 mb-2">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->email }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" hidden action="{{ route('logout') }}" method="POST"
                                    class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>

                    @endguest
                </ul> --}}
            </div>
        </div>

        </div>
        @yield('outobIt')
        <div style="width:100%; height:90%; overflow-x:scroll;">
            <div class="row p-0 m-0" style="overflow-y: hidden !important; min-width:100%;">
                <div class="container niggaaaa m-0 p-0"
                    style="height:90%; overflow-x: auto;
                overflow-y: hidden;">
                    @yield('script_1')

                    @yield('body')


                    <div class=" container-xxl p-0 m-0  d-flex justify-content-between align-content-center"
                        style="min-width: 100%; overflow-y: hidden !important;">
                        <div class="footer-dark " style="min-width: 100%;">
                            <footer style="min-width: 100%;">
                                <div class="container" style="min-width: 100%;">
                                    <div class="row" style="min-width: 100%;">
                                        <div class="col-sm-6 col-md-3 item">
                                            <h3>Services</h3>
                                            <ul>
                                                <li><a href="#">Web design</a></li>
                                                <li><a href="#">Development</a></li>
                                                <li><a href="#">Hosting</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-sm-6 col-md-3 item">
                                            <h3>About</h3>
                                            <ul>
                                                <li><a href="#">Company</a></li>
                                                <li><a href="#">Team</a></li>
                                                <li><a href="#">Careers</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-md-6 item text">
                                            <h3>e-library</h3>
                                            <p>An electronic library, or e-library, is a digital repository of resources
                                                accessible through electronic devices. It provides a diverse collection
                                                of digital content, including e-books, journals, and multimedia
                                                materials, enabling users to access, search, and utilize information
                                                remotely. E-libraries offer 24/7 availability, convenient search
                                                functionality, and foster interactive learning through digital tools.
                                            </p>
                                        </div>
                                        <div class="col item social d-flex justify-content-center">
                                            <a href="#"
                                                class=" container p-0 m-0 d-flex justify-content-center align-content-center m-2"
                                                style="width: 40px;height:40px;">
                                                <div>
                                                    <img src="{{ asset('icons/facebook.png') }}" width="30px"
                                                        height="30px" alt="">
                                                </div>
                                            </a>
                                            <a href="##"
                                                class=" container p-0 m-0 d-flex justify-content-center align-content-center m-2"
                                                style="width: 40px;height:40px;">
                                                <div>
                                                    <img src="{{ asset('icons/instagram.png') }}" width="25px"
                                                        height="25px" alt="">
                                                </div>
                                            </a>
                                            <a href="###"
                                                class=" container p-0 m-0 d-flex justify-content-center align-content-center m-2"
                                                style="width: 40px;height:40px;">
                                                <div>
                                                    <img src="{{ asset('icons/twitter.png') }}" width="20px"
                                                        height="20px" alt="">
                                                </div>
                                            </a>
                                            <a href="#####"
                                                class=" container p-0 m-0 d-flex justify-content-center align-content-center m-2"
                                                style="width: 40px;height:40px;">
                                                <div>
                                                    <img src="{{ asset('icons/linkedin.png') }}" width="20px"
                                                        height="20px" alt="">
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <p class="copyright">e-library @2023</p>
                                </div>
                            </footer>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="{{ asset('js/script.js') }}"></script>


</body>

</html>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js"></script>
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>


@yield('script_2')



<script>
    setInterval(clearAlertsContainer, 10000);

    function clearAlertsContainer() {
        // Find the alerts container element
        var alertsContainer = document.getElementById('alertsContainer');

        // Clear the content of the alerts container
        alertsContainer.innerHTML = '';
    }
</script>
<script>
    var alertsContainer = document.getElementById('alertsContainer');

    function showAlertS(message) {
        alertsContainer.innerHTML += `<div class="alert d-flex justify-content-between alert-success bg-success text-white alert-dismissible" style="opacity:0.65;" role="alert">
                                            <svg class="bi flex-shrink-0 me-2" role="img" style="width:20px; height:20px;" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                                    <div>${message}</div>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>`;

    }

    function showAlertD(message) {
        alertsContainer.innerHTML += `<div class="alert d-flex justify-content-between alert-danger bg-danger text-white  alert-dismissible" style="opacity:0.65;" role="alert">
        <svg class="bi flex-shrink-0 me-1" role="img" style="width:20px; height:20px;" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
<div>
<div>${message}</div>
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>`;
    }
</script>
