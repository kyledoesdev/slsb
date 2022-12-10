<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container-fluid">
        <a href="{{ route('home') }}" class="navbar-brand mx-2" title="" data-bs-toggle="tooltip" data-bs-placement="right">
            <img src="https://static-cdn.jtvnw.net/jtv_user_pictures/d58f3f38-0663-4780-916e-db6e0a164f31-profile_image-70x70.png" height="35" width="35"/>
        </a>
        <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
            <ul class="navbar-nav me-auto">
                <li class="nav-item active">
                    <a href="{{ route('home') }}" class="nav-link text-white m-2">
                        <i class="fa fa-house fa-2xl"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link text-white m-2">
                        <i class="fa fa-search fa-2xl"></i>
                    </a>
                </li>
                @auth
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link text-white m-2" data-bs-placement="right">
                        <i class="fa fa-rocket fa-2xl"></i>
                    </a>
                </li>
                @endauth
            </ul>
        </div>
        <div class="mx-auto order-0">
            <a class="navbar-brand mx-auto" href="#">spacelampsix</a>
        </div>
        <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
            <ul class="navbar-nav ms-auto">
                @auth
                    <li class="nav-item dropdown mt-1">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <img class="rounded-pill" src="{{ auth()->user()->profile->avatar }}" height="30" width="30"/>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('profile.show', ['id' => auth()->user()->username])}}">Profile</a>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Save & Quit
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endauth
                @guest
                    <li class="nav-item mx-1">
                        <a href="{{ route('login') }}" class="btn btn-primary btn-sm" data-bs-placement="right">
                            Login
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('register') }}" class="btn btn-primary btn-sm" data-bs-placement="right">
                            Register
                        </a>
                    </li>
                @endguest
            </ul>
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target=".dual-collapse2">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</nav>