<header class="main-header">
        <a class="logo-holder" href="{{ route('posts.index') }}"><img src="{{asset('images/logo.png')}}" alt=""></a>
        <!-- search button-->
        <div class="show-sibedar vissidebar"></div>
        <!-- search button end -->
        <!-- sidebar-button -->
        <div class="sidebar-button-wrap vis-m"></div>
        <!-- sidebar-button end-->
        <!-- search button-->
        <div class="show-search show-fixed-search vissearch"><i class="fa fa-search"></i></div>
        <!-- search button end -->
        <!-- mobile nav -->
        <div class="nav-button-wrap">
            <div class="nav-button vis-main-menu"><span></span><span></span><span></span></div>
        </div>
        <!-- mobile nav end-->
        <!--  navigation -->
        <div class="nav-holder">
            <nav>
                <ul>
                    <li>
                        <a href="{{route('posts.index')}}">Blog </a>
                        <!--second level -->
                        <!--second level end-->
                    </li>
                    @auth
                    <li>
                        <a href="{{route('posts.create')}}">Create</a>
                    </li>
                    @endauth
                    @guest
                    <li>
                        <a href="{{route('register')}}">Register</a>
                    </li>
                    <li>
                        <a href="{{route('login')}}">Login</a>
                    </li>
                    @endguest
                    @auth
                    <li>
                        <a onclick="document.querySelector('#logout').submit()" style="cursor: pointer">Logout</a>
                    </li>
                    @endauth
                </ul>
            </nav>
        </div>
    <form action="{{route('logout')}}" method="post" id="logout">
        @csrf
    </form>
        <!-- navigation  end -->
    </header>
