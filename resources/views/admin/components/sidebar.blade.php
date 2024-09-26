<section>
    <!-- Left Sidebar -->
    <aside id="leftsidebar" class="sidebar">
        <!-- User Info -->
        <div class="user-info bg-red">
            <div class="image">
                <img src="{{asset('public/images/user.png')}}" width="48" height="48" alt="User" />
            </div>
            <div class="info-container">
                <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{session()->get('admin_name')}}</div>
                <!-- <div class="email">{{session()->get('email')}}</div> -->
                <div class="btn-group user-helper-dropdown">
                    <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                    <ul class="dropdown-menu pull-right">
                        <li><a href="{{url('admin/change-password')}}"><i class="material-icons">person</i>Change Password</a></li>
                        <li><a href="javascript:void(0);" class="logout"><i class="material-icons">input</i>Log Out</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- #User Info -->
        <!-- Menu -->
        <div class="menu">
            <ul class="list">
                <li class="header">MAIN NAVIGATION</li>
                <li class="{{(Request::path() == 'admin/dashboard')? 'active':''}}">
                    <a href="{{url('admin/dashboard')}}">
                        <i class="material-icons">home</i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="{{(Request::path() == 'admin/manage_category' ||  Request::path() == 'admin/manage_food' || Request::path() == 'admin/menu_type')? 'active':''}}">
                    <a href="#" class="menu-toggle">
                        <i class="material-icons">restaurant_menu</i>
                        <span>Food Management</span>
                    </a>
                    <ul class="ml-menu">
                        <li class="{{(Request::path() == 'admin/manage_category')? 'active':''}}">
                            <a href="{{url('admin/manage_category')}}">
                                <span>Manage Category</span>
                            </a>
                        </li>
                        <li class="{{(Request::path() == 'admin/manage_food')? 'active':''}}">
                            <a href="{{url('admin/manage_food')}}">
                                <span>Manage Food</span>
                            </a>
                        <li>
                        <li class="{{(Request::path() == 'admin/menu_type')? 'active':''}}">
                            <a href="{{url('admin/menu_type')}}">
                                <span>Menu Type</span>
                            </a>
                        <li>
                          
                    </ul>
                </li>
                <li class="{{(Request::path() == 'admin/order_list/create' ||  Request::path() == 'admin/order_list' || Request::path() == 'admin/pending_order' || Request::path() == 'admin/on_going_order')? 'active':''}}">
                    <a href="#" class="menu-toggle">
                        <i class="material-icons">sort</i>
                        <span>Manage Order</span>
                    </a>
                    <ul class="ml-menu">
                        <li class="{{(Request::path() == 'admin/order_list/create')? 'active':''}}">
                            <a href="{{url('admin/order_list/create')}}">
                                <span>Pos Invoice</span>
                            </a>
                        </li>
                        <li class="{{(Request::path() == 'admin/order_list')? 'active':''}}">
                            <a href="{{url('admin/order_list')}}">
                                <span>Order List</span>
                            </a>
                        </li>
                        <li class="{{(Request::path() == 'admin/on_going_order')? 'active':''}}">
                            <a href="{{url('admin/on_going_order')}}">
                                <span>On Going Orders</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="menu-toggle">
                        <i class="material-icons">loyalty</i>
                        <span>Reservation</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="{{url('admin/reservation')}}">
                                <span>Reservation</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="menu-toggle">
                        <i class="material-icons">account_circle</i>
                        <span>Customers</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="{{url('admin/customer_list')}}">
                                <span>Customer List</span>
                            </a>
                        <li>
                        <li>
                            <a href="{{url('admin/customer_types')}}">
                                <span>Customer Types</span>
                            </a>
                        <li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="menu-toggle">
                        <i class="material-icons">account_circle</i>
                        <span>Waiters</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="{{url('admin/waiters')}}">
                                <span>Waiters List</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="menu-toggle">
                        <i class="material-icons">message</i>
                        <span>Contact Query</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="{{url('admin/contact-query')}}">
                                <span>Message List</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="{{(Request::path() == 'admin/kitchen-settings' || Request::path() == 'admin/table_list' ||  Request::path() == 'admin/payment_method' || Request::path() == 'admin/country' || Request::path() == 'admin/state' || Request::path() == 'admin/city' || Request::path() == 'admin/pages' || Request::path() == 'admin/general_settings' || Request::path() == 'admin/social_links' || Request::path() == 'admin/banners')? 'active':''}}">
                    <a href="#" class="menu-toggle">
                        <i class="material-icons">settings</i>
                        <span>Manage Setting</span>
                    </a>
                    <ul class="ml-menu">
                        <li class="{{(Request::path() == 'admin/kitchen-settings')? 'active':''}}">
                            <a href="{{url('admin/kitchen-settings')}}">
                                <span>Kitchen Settings</span>
                            </a>
                        </li>
                        <li class="{{(Request::path() == 'admin/table_list')? 'active':''}}">
                            <a href="{{url('admin/table_list')}}">
                                <span>Table List</span>
                            </a>
                        </li>
                        <li class="{{(Request::path() == 'admin/payment_method')? 'active':''}}">
                            <a href="{{url('admin/payment_method')}}">
                                <span>Payment Method List</span>
                            </a>
                        <li>
                        <li class="{{(Request::path() == 'admin/country')? 'active':''}}">
                            <a href="{{url('admin/country')}}">
                                <span>Country</span>
                            </a>
                        <li>
                        <li class="{{(Request::path() == 'admin/state')? 'active':''}}">
                            <a href="{{url('admin/state')}}">
                                <span>State</span>
                            </a>
                        <li>
                        <li class="{{(Request::path() == 'admin/city')? 'active':''}}">
                            <a href="{{url('admin/city')}}">
                                <span>City</span>
                            </a>
                        <li>
                        <li class="{{(Request::path() == 'admin/pages')? 'active':''}}">
                            <a href="{{url('admin/pages')}}">
                                <span>Pages</span>
                            </a>
                        <li>
                        <li class="{{(Request::path() == 'admin/general_settings')? 'active':''}}">
                            <a href="{{url('admin/general_settings')}}">
                                <span>General Settings</span>
                            </a>
                        <li>
                        <li class="{{(Request::path() == 'admin/social_links')? 'active':''}}">
                            <a href="{{url('admin/social_links')}}">
                                <span>Social Links</span>
                            </a>
                        <li>
                        <li class="{{(Request::path() == 'admin/banners')? 'active':''}}">
                            <a href="{{url('admin/banners')}}">
                                <span>Banners</span>
                            </a>
                        <li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- #Menu -->
        <!-- Footer -->
        <div class="legal">
            <div class="copyright">
                Copyright 2024 Zubayer
            </div>
        </div>
        <!-- #Footer -->
    </aside>
    <!-- #END# Left Sidebar -->
</section>