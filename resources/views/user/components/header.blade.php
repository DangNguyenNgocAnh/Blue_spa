<header id="header" class="header fixed-top d-flex align-items-center justify-content-between">
    <div class="d-flex align-items-center justify-content-between">
        <div class="logo d-flex align-items-center">
            <a href="#">
                <img src="{{ Vite::asset('resources/assets/img/logo.png') }}" alt="">
            </a>
            <div style="padding-top: 13px;">
                <span class="d-none d-lg-block">Blue Spa</span>
                <p style="font-weight: lighter;">Beauty Center</p>
            </div>
        </div>
    </div>
    <ul class="d-flex align-items-center  justify-content-between"
        style="padding-left: 0px;flex-grow: 1; padding-top: 12px">
        <li class="dropdown-item" style="text-align: center;"><a href="">Điều trị
                da</a>
        </li>
        <li class="dropdown-item" style="text-align: center;"><a href="">Chăm sóc da</a>
        </li>
        <li class="dropdown-item" style="text-align: center;"><a href=""> Thẩm mỹ</a></li>
        <li class="dropdown-item" style="text-align: center;"> <a href="">Phun xăm</a> </li>
        <li class="dropdown-item" style="text-align: center;"><a href="">Đặt lịch hẹn</a>
        </li>
        <li class="dropdown-item" style="text-align: center;"><a href="">About us</a> </li>
    </ul>
    <nav class="header-nav">
        <div>
            <ul class="d-flex align-items-center" style="padding-right: 30px;">
                <div class="dropdown">
                    <a class="btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Languages
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="min-width: 112px !important;">
                        <li><a class="dropdown-item " href="">VietNamese</a></li>
                        <li><a class="dropdown-item" href="">English</a></li>
                        <li><a class="dropdown-item" href="#">Japanese</a></li>
                    </ul>
                </div>
                @if(!Auth::check())
                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="{{route('login')}}">
                    <i class=" ri-login-box-fill" style="font-size: 30px;"></i>
                </a>
                @else
                <li class="nav-item dropdown">
                    <a class="nav-link nav-profile d-flex align-items-center" href="#" data-bs-toggle="dropdown">
                        <span class="">Hello, {{Auth::user()->fullname}}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6><a style="color: black;" href="">{{Auth::user()->fullname}}</a></h6>
                            <span>Code : {{Auth::user()->code}}</span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="">
                                <i class="bi bi-person"></i>
                                <span>My Profile</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <button id="show-setting" class="dropdown-item d-flex align-items-center"
                                data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <i class="bi bi-gear"></i>
                                <span>Change password</span>
                            </button>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="">
                                <i class="bi bi-house"></i>
                                <span>My packages</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{route('logout')}}">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign out</span>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif

            </ul>
        </div>
    </nav>
</header>
