<!-- Navigation-->
<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
    <div class="container-fluid px-4 px-lg-5">
        <a class="navbar-brand" href="{{ route('mainHome') }}">E-Commerce</a>
        <ul class="navbar-nav">
            <li>
                <form class="d-flex">
                    <input type="search" placeholder="Search" class="form-control me-2" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </li>
        </ul>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="" class="nav-link">
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    @guest
                        My Account
                    @else
                        {{ auth()->user()->firstName ?? 'My Account' }}
                    @endguest
                </a>
                @guest
                    <ul class="dropdown-menu bg-success">
                        <li><a class="dropdown-item" href="{{ route('login') }}">Login</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="{{ route('register') }}">Register</a></li>
                    </ul>
                @else
                    <ul class="dropdown-menu bg-success">
                        <li><a class="dropdown-item" href="{{ route('profile') }}">Profile</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
                    </ul>
                @endguest
            </li>
        </ul>
    </div>
    </div>
</nav>
