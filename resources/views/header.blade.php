<div class="header">
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
                        <li class="nav-item active">
                            <a class="nav-link" href="<?php  echo url('/'); ?>/gallery/participate">Prijavi rad</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php  echo url('/'); ?>/gallery/index">Galerija</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php  echo url('/'); ?>/gallery/index">Pobednici</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/logout') }}">logout</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</div>
