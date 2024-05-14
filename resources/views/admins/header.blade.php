<?php $admin = Auth::guard('admin')->user() ?>
<div class="wrapper">
    <div class="sidebar" data-active-color="purple" data-background-color="black" data-image="/images/login.jpg">
        <div class="logo">
            <a href="/admin" class="simple-text">{{$info['name']}}</a>
        </div>
        <div class="logo logo-mini">
            <a href="admin" class="simple-text">{{$info['short_name']}}</a>
        </div>
        <div class="sidebar-wrapper">
            <div class="user">
                <div class="photo">
                    <img src="/images/{{($admin->image)? 'profile/'.$admin->image : 'avatar.png'}}" />
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="#profile" class="collapsed">
                        
                        {{ $admin->first_name. ' '. $admin->last_name }}
                        <b class="caret"></b>
                    </a>
                    <div class="collapse" id="profile">
                        <ul class="nav">
                            <li><a href="/admin/profile">My Profile</a></li>
                            <li><a href="/admin/profile">Edit Profile</a></li>
                            <li><a href="/admin/logout">Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <ul class="nav">
                <li class="">
                    <a href="/admin">
                        <i class="material-icons">dashboard</i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li>
                    <a data-toggle="collapse" href="#user">
                        <i class="material-icons">subject</i>
                        <p>Users
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse" id="user">
                        <ul class="nav">
                            <li><a href="/admin/user/create">Create New user</a></li>
                            <li><a href="/admin/view_active_users">View Active users</a></li>
                            <li><a href="/admin/user">View All users</a></li>
                        </ul>
                    </div>
                </li>
            
                <li>
                    <a data-toggle="collapse" href="#service">
                        <i class="material-icons">trending_up</i>
                        <p>Services
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse" id="service">
                        <ul class="nav">
                            <li><a href="/admin/user">Add New Service</a></li>
                            <li><a href="/admin/service/all/view">View All Services</a></li>
                            <li><a href="/admin/service/active/view">View Active Services</a></li>
                            <li><a href="/admin/service/unpaid">View Unpaid Services</a></li>
                            <li><a href="/admin/service/free/view">View Free Services</a></li>
                            <li><a href="/admin/view/live/services">View Live Services</a></li>
                            <li><a href="/admin/service/cancelled/view">View Cancelled Services</a></li>
                        </ul>
                    </div>
                </li>
            
                <li>
                    <a data-toggle="collapse" href="#Invests">
                        <i class="material-icons">list</i>
                        <p>Invests
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse" id="Invests">
                        <ul class="nav">
                            <li><a href="/admin/invest/create">Add New Invests</a></li>
                            <li><a href="/admin/invest">View Invests</a></li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a data-toggle="collapse" href="#payment">
                        <i class="material-icons">subject</i>
                        <p>Bills
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse" id="payment">
                        <ul class="nav">
                            <li><a href="/admin/bill/due/view">Add Bill</a></li>
                            <li><a href="/admin/bill/due/view">View Due Bills</a></li>
                            <li><a href="/admin/bill/paid/view">View Received Bills</a></li>
                        </ul>
                    </div>
                </li>
                
                <li>
                    <a data-toggle="collapse" href="#PaymentMethod">
                        <i class="material-icons">subject</i>
                        <p>Payment Method
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse" id="PaymentMethod">
                        <ul class="nav">
                            <li><a href="/admin/paymethod/create">Add Payment Method</a></li>
                            <li><a href="/admin/paymethod">View Payment Method</a></li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a data-toggle="collapse" href="#packages">
                        <i class="material-icons">subject</i>
                        <p>Packages
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse" id="packages">
                        <ul class="nav">
                            <li><a href="/admin/package/create">Create Package</a></li>
                            <li><a href="/admin/package">View Packages</a></li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a data-toggle="collapse" href="#devices">
                        <i class="material-icons">devices</i>
                        <p>Devices
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse" id="devices">
                        <ul class="nav">
                            <li><a href="/admin/device/create">Add New Device</a></li>
                            <li><a href="/admin/device">View Devices</a></li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a data-toggle="collapse" href="#area">
                        <i class="material-icons">map</i>
                        <p>Locations
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse" id="area">
                        <ul class="nav">
                            <li><a href="/admin/location/create">Add New Location</a></li>
                            <li><a href="/admin/location">View All Locations</a></li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a data-toggle="collapse" href="#cmdAdmin">
                        <i class="material-icons">build</i>
                        <p>Settings
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse" id="cmdAdmin">
                        <ul class="nav">
                            <li><a href="/admin/admin/create">Add New User</a></li>
                            <li><a href="/admin/admin">Show Admins</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    
    <div class="main-panel">
        <nav class="navbar navbar-transparent navbar-absolute">
            <div class="container-fluid">
                <div class="navbar-minimize">
                    <button id="minimizeSidebar" class="btn btn-round btn-white btn-fill btn-just-icon">
                        <i class="material-icons visible-on-sidebar-regular">more_vert</i>
                        <i class="material-icons visible-on-sidebar-mini">view_list</i>
                    </button>
                </div>
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/admin"> {{$info['panel_name']}} Admin Panel</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="/admin/logout" class="" title="Logout" onclick="return confirm('Are you agree to logout?');">
                                <i class="material-icons">settings_power</i>
                                <p class="hidden-lg hidden-md">Profile</p>
                            </a>
                        </li>
                        <li class="separator hidden-lg hidden-md"></li>
                    </ul>

                    {!! Form::open(['route' => 'register', 'method' => 'POST', 'class' => 'navbar-form navbar-right', 'role' => 'search']) !!}
                        <div class="form-group form-search is-empty">
                            <input type="text" class="form-control" placeholder="Search" name="work_orders_search">
                            <span class="material-input"></span>
                        </div>
                        <button type="submit" class="btn btn-white btn-round btn-just-icon">
                            <i class="material-icons">search</i>
                            <div class="ripple-container"></div>
                        </button>
                    {!! Form::close() !!}
                </div>
            </div>
        </nav>

@include('partials.messages')            