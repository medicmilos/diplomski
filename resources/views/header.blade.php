<div class="header-wrap">
    <div class="container header">
        <div class="col-lg-12">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="<?php  echo url('/'); ?>"><img
                        src="{{asset("images/logo_visoka_ict_skola.png")}}"> ICT galerija</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">

                        <li class="nav-item">
                            @if(Auth::user())
                                @foreach(Auth::user()->roles as $role)
                                    @php ($userRole = $role->name)
                                @endforeach
                                @if(isset($userRole))
                                    @if($userRole === "Super Admin" || $userRole === "Administrator")
                                        <a href="{{url("/admin")}}"
                                           class="nav-link" target="_blank">
                                            <button class="btn btn-primary panel-button">Admin
                                                panel
                                            </button>
                                        </a>
                                    @endif
                                @endif
                            @endif
                        </li>
                        <li class="nav-item {{ ((\Request::route()->getName() == 'participate')) ? 'active' : '' }}">
                            <a class="nav-link" href="<?php  echo url('/'); ?>/gallery/participate">Prijavi rad</a>
                        </li>
                        <li class="nav-item {{ ((\Request::route()->getName() == 'galleryindex')) ? 'active' : '' }}">
                            <a class="nav-link" href="<?php  echo url('/'); ?>/gallery/index">Galerija</a>
                        </li>
                        <li class="nav-item {{ ((\Request::route()->getName() == 'winners')) ? 'active' : '' }}">
                            <a class="nav-link" href="<?php  echo url('/'); ?>/gallery/winners">Pobednici</a>
                        </li>
                        <li class="nav-item {{ ((\Request::route()->getName() == 'awards')) ? 'active' : '' }}">
                            <a class="nav-link" href="<?php  echo url('/'); ?>/gallery/awards">Kako učestvovati?</a>
                        </li>
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
<div  class="unser-header" style="height:18px">

</div>