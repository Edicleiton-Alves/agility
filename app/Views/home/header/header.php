<header class="bg-body position-fixed top-0 z-3 shadow w-100">
    <div class="container">
        <div class="row">
            <nav class="navbar navbar-expand-lg p-0">
                <div class="container-fluid h-100">
                    <a class="navbar-brand d-md-block" href="#">
                        <div style="height: 70px;" class="d-flex align-items-center">
                            <?php require 'img/logo.svg'; ?>
                        </div>
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarContent">
                        <ul class="navbar-nav mb-3 mb-md-0 ms-md-auto h-100 dnyquQ">
                            <a class="nav-link rounded-1 h-100 d-flex" aria-current="page" href="#">
                                <li class="px-3 my-auto">Início</li>
                            </a>
                            <a class="nav-link rounded-1 h-100 d-flex" href="#planosAGL">
                                <li class="px-3 my-auto">Produtos e Serviços</li>
                            </a>
                            <a class="nav-link rounded-1 h-100 d-flex" href="#beneficios">
                                <li class="px-3 my-auto">Sobre a Agility Telecom</li>
                            </a>
                            <a class="text-decoration-none h-100 d-flex" href="<?= CONFIGURACAO['area_cliente'] ?>" target="_blank" rel="noopener">
                                <li class="mx-2 my-auto btn btn-success rounded-2">Área do Cliente</li>
                            </a>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</header>