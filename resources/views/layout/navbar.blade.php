<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{route('index')}}">LibApps</a>

        @auth()
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('history_index')}}">History</a>
                </li>
                @if(auth()->user()->role === 'staff')
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('book_manage')}}">Manage Book</a>
                    </li>
                @endif
            </ul>
        @endauth

        <form class="d-flex mx-auto" action="{{ route('book.search') }}" method="GET">
            <input class="form-control me-2" name="query" type="search" placeholder="Search" aria-label="Search" />
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>

        <div class="d-flex">
            @guest
                <a href="{{ route('login_index') }}" class="btn btn-outline-primary me-2">Login</a>
                <a href="{{ route('register_index') }}" class="btn btn-primary me-2">Register</a>
            @else
                <div class="dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}
                        <img src="{{ auth()->user()->image_url }}" alt="Profile" class="rounded-circle" width="30" height="30" />
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink">
                        <li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                        </li>
                    </ul>
                </div>
            @endguest
        </div>
    </div>
</nav>
