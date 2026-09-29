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
                <li>
                  <a href="">
                    <i class="material-icons">payment</i> 
                    Billings
                  </a>
                </li>
                <li>
                  <a href="">
                    <i class="material-icons">card_travel</i> 
                    Packages
                  </a>
                </li>
                <li>
                  <a href="">
                    <i class="material-icons">message</i> 
                    Complain
                  </a>
                </li>
                <li>
                  <a href="">
                    <i class="material-icons">supervisor_account</i> 
                    Contact Us
                  </a>
                </li>
                <li>
                  <a href="/profile">
                    <i class="material-icons">user</i>
                    My Profile
                  </a>
                </li>
                <li>
                  <a href="/change_my_password"><i class="material-icons"> supervisor_account</i>
                    Change Password
                  </a>
                </li>
                <li>
                  <a href="/profile">
                    <i class="material-icons">logout</i>
                    Logout
                  </a>
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