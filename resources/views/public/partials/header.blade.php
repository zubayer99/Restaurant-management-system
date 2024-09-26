        <header id="header">
            <div class="header-top d-flex flex-row justify-content-between">
                <ul>
                    @php $social_links = social_links();  @endphp
                    @if($social_links)
                    @if($social_links->facebook && $social_links->facebook != '')
                    <li><a href="{{$social_links->facebook}}"><i class="fab fa-facebook"></i></a></li>
                    @endif
                    @if($social_links->twitter && $social_links->twitter != '')
                    <li><a href="{{$social_links->twitter}}"><i class="fab fa-twitter"></i></a></li>
                    @endif
                    @if($social_links->instagram && $social_links->instagram != '')
                    <li><a href="{{$social_links->instagram}}"><i class="fab fa-instagram"></i></a></li>
                    @endif
                    @if($social_links->linkedin && $social_links->linkedin != '')
                    <li><a href="{{$social_links->linkedin}}"><i class="fab fa-linkedin"></i></a></li>
                    @endif
                    @if($social_links->youtube && $social_links->youtube != '')
                    <li><a href="{{$social_links->youtube}}"><i class="fab fa-youtube"></i></a></li>
                    @endif
                    @endif
                </ul>
                <ul>
                    @if(session()->has('customer_id'))
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            Hello, {{session()->get('customer_name')}}
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="{{url('user/profile')}}">Profile</a></li>
                            <li><a class="dropdown-item" href="{{url('user/change-password')}}">Change Password</a></li>
                            <li><a class="dropdown-item logout" href="javascript:void(0)">Logout</a></li>
                        </ul>
                    </div>
                    @else
                        <li><a href="{{url('/login')}}">Login</a></li>
                        <li><a href="{{url('/signup')}}">Signup</a></li>
                    @endif
                </ul>
            </div>
            <nav class="navbar navbar-expand-lg">
                <div class="container-fluid">
                    <a class="navbar-brand logo" href="{{url('/')}}">
                        @if($siteInfo->logo != '')
                            <img src="{{asset('public/site-images/'.$siteInfo->logo)}}" alt="{{$siteInfo->app_title}}">
                        @else
                        <h1>{{$siteInfo->app_title}}</h1>
                        @endif
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fa fa-burger"></i>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-0 ms-lg-5">
                            <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{url('/')}}#menu-section">Menu</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{url('/')}}#category-section">Meals</a>
                            </li>
                            @foreach(pages() as $page)
                            @if($page->show_in_header == '1')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{$page->slug}}">{{$page->title}}</a>
                                </li>
                            @endif
                            @endforeach
                            
                            <li class="nav-item">
                                <a class="nav-link" href="{{url('contact')}}">Contact</a>
                            </li>
                            <!-- <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Menus
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                </ul>
                            </li> -->
                        </ul>
                        <ul class="header-nav-right">
                            <li>
                                <a href=""><i class="fa fa-phone"></i>{{$siteInfo->phone}}</a>
                            </li>
                            <li>
                                <a href="{{url('reservation')}}" class="link-button">Book a Table</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>