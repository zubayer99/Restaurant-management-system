<footer id="footer" class="pt-5">
            <div class="footer-content">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 col-md-12">
                            <div class="footer-widget text-center text-lg-left">
                                <a href="" class="logo">
                                    <img src="{{asset('public/site-images/'.$siteInfo->logo)}}" alt="{{$siteInfo->app_title}}">
                                </a>
                                <ul class="footer-social-links">
                                    @php $social_links = social_links(); @endphp
                                    @if($social_links)
                                    @if($social_links->facebook != '')
                                    <li><a href="{{$social_links->facebook}}"><i class="fab fa-facebook"></i></a></li>
                                    @endif
                                    @if($social_links->twitter != '')
                                    <li><a href="{{$social_links->twitter}}"><i class="fab fa-twitter"></i></a></li>
                                    @endif
                                    @if($social_links->instagram != '')
                                    <li><a href="{{$social_links->instagram}}"><i class="fab fa-instagram"></i></a></li>
                                    @endif
                                    @if($social_links->linkedin != '')
                                    <li><a href="{{$social_links->linkedin}}"><i class="fab fa-linkedin"></i></a></li>
                                    @endif
                                    @if($social_links->youtube != '')
                                    <li><a href="{{$social_links->youtube}}"><i class="fab fa-youtube"></i></a></li>
                                    @endif
                                    @endif
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="footer-widget text-center">
                                <h4>Call for Order</h4>
                                <ul>
                                    <li><span>{{$siteInfo->phone}}</span></li>
                                    <li>{{$siteInfo->email}}</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="footer-widget text-center">
                                <h4>Location</h4>
                                <ul>
                                    <li>{{$siteInfo->address}}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom py-4">
                <div class="container">
                    <div class="row">
                        <div class="col-12 d-flex flex-row justify-content-between">
                            <span>{{$siteInfo->copyright_text}}</span>
                            <ul class="">
                                @foreach(pages() as $page)
                                @if($page->show_in_footer == '1')
                                    <li><a href="{{url($page->slug)}}">{{$page->title}}</a></li>
                                @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>        
        </footer>
        <input type="text" id="url" value="{{url('/')}}" hidden>