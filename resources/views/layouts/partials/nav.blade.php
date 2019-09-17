<header>
    <div class="collapse bg-dark" id="navbarHeader">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 py-4">
                    <h4 class="text-white">About</h4>
                    <p class="text-muted">It's is the forms</p>
                </div>
                <div class="col-sm-4 py-4">
                    <ul class="list-unstyled">
                        <li><a href="{{route('preregister')}}" >Pre Registro</a></li>
                        <li><a href="{{route('helpdesk')}}" >Help Desk</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="navbar navbar-dark bg-dark box-shadow">
        <div class="container d-flex justify-content-between">
            <a href="{{route('front')}}" class="navbar-brand">
                <i class="fab fa-apple"></i>
                PROGRAMA DE SOPORTE A PACIENTES
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </div>
</header>
