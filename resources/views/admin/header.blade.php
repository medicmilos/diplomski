<div class="admin-header">
    <div class="container header">
        <div class="col-lg-12">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">

                <button id="showLeftPush" class="btn btn-primary">&#9776;</button>
                <a target="_blank" class="btn btn-primary" href="{{ url('/') }}">Aktivacija</a>

                <div class="navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            @if (Auth::check())
                                <a class="nav-link" href="{{ url('/logout') }}">Odjavi se</a>
                            @else
                                <a class="nav-link" href="{{ url('/login') }}">Prijava/Registracija</a>
                            @endif
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</div>