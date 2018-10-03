<div class="admin-header">
    <div class="container header">
        <div class="col-lg-12">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button> 
                <button id="showLeftPush">&#9776;</button>

                <div class="collapse navbar-collapse" id="navbarNav">
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
