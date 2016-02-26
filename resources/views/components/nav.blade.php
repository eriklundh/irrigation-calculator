<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ URL::route('home') }}">hydrosolutions Irrigation Toolbox</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li id="home"><a href="{{ URL::route('home') }}">Home</a></li>
                <li id="about"><a href="{{ URL::route('about') }}">About</a></li>
                <li id="templates"><a href="{{ URL::route('templates') }}">Templates</a></li>
                @if(Auth::check())
                    <?php
                    $user_role_name = \App\User::getUserRoleName();
                    if($user_role_name=='SUPER_ADMIN'){
                        echo "<li id='roles'><a href=\"".URL::route('admin-roles-list')."\">Roles</a></li>";
                    }
                    if($user_role_name=='ADMIN'){
                        echo "<li id='users' ><a href=\"".URL::route('admin-users-list')."\">Users</a></li>";
                    }
                    if($user_role_name=='USER'){
                        echo "<li id='uploads'><a href=\"".URL::route('user-uploads-list')."\">Model Specifications</a></li>";
                    }
                    ?>
                @endif
                <li id="contact"><a href="{{ URL::route('contact') }}">Contact</a></li>
            </ul>
            @if(Auth::check())
                <ul class="nav navbar-nav navbar-right">
                    <li><a>Hello, {{ Auth::user()->username }}</a></li>
                    <li><a href="{{ URL::route('account-sign-out') }}">Sign-out</a></li>
                </ul>
            @else
                @yield('login')
            @endif
        </div><!--/.navbar-collapse -->
    </div>
</nav>
