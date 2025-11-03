<div class="wrapper">
    <div class="sidebar" data-active-color="purple" data-background-color="black" data-image="/images/login.jpg">
        <div class="logo">
            <a href="/home" class="simple-text">{{$info['name']}}</a>
        </div>
        <div class="logo logo-mini">
            <a href="/home" class="simple-text">{{$info['short_name']}}</a>
        </div>
        <div class="sidebar-wrapper">
            <div class="user">
                <div class="photo">
                    <img src="/images/{{(Auth::user()->image)? 'profile/'.Auth::user()->image: 'avatar.png'}}" />
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" class="collapsed">
                        {{ Auth::user()->name }}
                        <b class="caret"></b>
                    </a>
                    <div class="collapse" id="collapseExample">
                        <ul class="nav">
                            <li><a href="/profile">My Profile</a></li>
                            <li><a href="/profile">Edit Profile</a></li>
                            <li><a href="/logout">Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <ul class="nav">
                <li class="">
                    <a href="/home">
                        <i class="material-icons">dashboard</i>
                        <p>Dashboard</p>
                    </a>
                </li>
                {{-- <li><a href="/my_offer"><i class="material-icons">wifi</i> My Offers</a></li> --}}
                {{-- <li>
                    <a data-toggle="collapse" href="#pagesExamples">
                        <i class="material-icons">subject</i>
                        <p>Services
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse" id="pagesExamples">
                        <ul class="nav">
                            <li><a href="/create_service">Add New Service</a></li>
                            <li><a href="/view_services">View Services</a></li>
                        </ul>
                    </div>
                </li> --}}
                {{-- <li>
                    <a data-toggle="collapse" href="#componentsExamples">
                        <i class="material-icons">subject</i>
                        <p>Payments
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse" id="componentsExamples">
                        <ul class="nav">
                            <li><a href="/view_payments">View Payments</a></li>
                            <li><a href="/view_due_bills">View Due Payments</a></li>
                        </ul>
                    </div>
                </li> --}}
                {{-- <li>
                    <a data-toggle="collapse" href="#client">
                        <i class="material-icons">card_travel</i>
                        <p>Client Manager
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse" id="client">
                        <ul class="nav">
                            <li><a href="/add_client">Add Client</a></li>
                            <li><a href="/show_clients">Show Clients</a></li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a data-toggle="collapse" href="#tablesExamples">
                        <i class="material-icons">message</i>
                        <p>Address Manager
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse" id="tablesExamples">
                        <ul class="nav">
                            <li><a href="/add_address">Add Address</a></li>
                            <li><a href="/show_address">Show Address</a></li>
                            <li><a href="/show_bol_address">Show BOL Address</a></li>
                        </ul>
                    </div>
                </li> --}}
                <li>
                    <a data-toggle="collapse" href="#formsExamples">
                        <i class="material-icons">supervisor_account</i>
                        <p>Account Settings
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse" id="formsExamples">
                        <ul class="nav">
                            <li>
                                <a href="/change_my_password">Change Password</a>
                            </li>
                            <li>
                                <a href="/profile">My Profile</a>
                            </li>
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
                    <a class="navbar-brand" href="/"> {{$info['panel_name']}} Control Panel</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="/logout" class="" title="Logout" onclick="return confirm('Are you agree to logout?');">
                                <i class="material-icons">settings_power</i>
                                <p class="hidden-lg hidden-md">Profile</p>
                            </a>
                        </li>
                        <li class="separator hidden-lg hidden-md"></li>
                    </ul>
                    
                </div>
            </div>
        </nav>

@include('partials.messages')            