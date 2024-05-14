    <nav class="navbar navbar-primary navbar-transparent navbar-absolute">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                {{-- <a class="navbar-brand" href="/">Chalanbeel Technology</a> --}}
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="/">Home</a></li>
                    <li><a href="/register/create">Sign Up</a></li>
                    <li><a href="/login">Login</a></li>
                    <li><a href="/#">Help</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="wrapper wrapper-full-page">

@include('partials.messages')