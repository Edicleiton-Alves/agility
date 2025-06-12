<div class="section d-flex align-items-center">
    <div class="swiper" id="bannerSwipper">
        <div class="swiper-wrapper bannerSwipper">
            <div class="swiper-slide pt-130">
                <div class="imgSlideBanner1"></div>
            </div>
        </div>
        <div class="swiper-pagination"></div>
    </div>
</div>
<div id="planosAGL">
    <?php
    $conDB = new Classes\ConDB;
    $getSva = new Classes\Metodos($conDB);

    $getSva = $getSva
        ->table('tb_sva')
        ->get();

    foreach ($getSva as $sva) {
        if ($sva->tipo_sva != 'Seção') {
            continue;
        }

        $getPlanSva = new Classes\Metodos($conDB);
        $getPlanSva = $getPlanSva
            ->table('tb_sva_plan')
            ->where('id_sva', '=', $sva->id)
            ->get();

        if (!empty($getPlanSva)) {
    ?>
            <div class="section planos-swiper">
                <div class="container position-relative swiper-content pt-5">
                    <h2 class="text-center mb-4"><?= $sva->titulo ?></h2>
                    <div class="swiper planosSwiper">
                        <div class="swiper-wrapper">
                            <?php
                            foreach ($getPlanSva as $svaCad) {
                                $getPlSva = new Classes\Metodos($conDB);
                                $getPlan = new Classes\Metodos($conDB);

                                $getPlSva = $getPlSva
                                    ->table('tb_sva_plan')
                                    ->where('id_plano', '=', $svaCad->id_plano)
                                    ->get();

                                $getPlan = $getPlan
                                    ->table('tb_planos')
                                    ->where('id', '=', $svaCad->id_plano)
                                    ->get();
                            ?>
                                <div class="swiper-slide m-md-auto p-4">
                                    <div class="card plano-card text-center h-100 p-0">
                                        <div class="plano-topo py-3 px-2">
                                            <h2 class="fw-bold mb-0"><?= $getPlan[0]->nome_plan ?></h2>
                                        </div>
                                        <div class="card-body py-3 px-3 d-flex flex-column justify-content-between">
                                            <ul class="list-unstyled text-start mb-3">
                                                <?php
                                                foreach ($getPlSva as $plSva) {
                                                    if ($plSva->tipo_plano == 'Item') {
                                                        $getSvaDa = new Classes\Metodos($conDB);
                                                        $getSvaDa = $getSvaDa
                                                            ->table('tb_sva')
                                                            ->where('id', '=', $plSva->id_sva)
                                                            ->get();
                                                ?>
                                                        <li><i class="bi bi-check-circle-fill text-success me-2"></i><?= $getSvaDa[0]->titulo ?></li>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </ul>

                                            <div class="mb-3">
                                                <?php
                                                foreach ($getPlSva as $plSva) {
                                                    if ($plSva->tipo_plano == 'Benefício') {
                                                        $getSvaDa = new Classes\Metodos($conDB);
                                                        $getSvaDa = $getSvaDa
                                                            ->table('tb_sva')
                                                            ->where('id', '=', $plSva->id_sva)
                                                            ->get();
                                                ?>
                                                        <img src="img/sva/<?= $getSvaDa[0]->img_beneficio ?>" alt="<?= $getSvaDa[0]->titulo ?>" class="icon me-2 mb-2">
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </div>

                                            <div class="mb-2">
                                                <p class="fs-3 fw-bold mb-1">R$<?= number_format($getPlan[0]->valor, 2, ',', '.') ?><span class="fs-6 text-muted">/mês</span></p>
                                            </div>

                                            <a href="https://api.whatsapp.com/send?phone=<?= CONFIGURACAO['whatsapp'] ?>&text=Olá, gostaria de falar com a Agility Telecom, quero contratar o Plano <?= $getPlan[0]->nome_plan ?> de R$ <?= number_format($getPlan[0]->valor, 2, ',', '.') ?>"
                                                target="_blank"
                                                rel="noopener"
                                                class="btn btn-assine w-100 mt-2">
                                                Assine já
                                            </a>
                                        </div>
                                    </div>
                                </div>
                        <?php
                            }
                        } ?>
                        </div>
                    </div>
                    <!-- <div class="swiper-pagination"></div> -->
                    <div class="pulse swiper-button-next"></div>
                    <div class="pulse swiper-button-prev"></div>
                </div>
            </div>
        <?php
    } ?>
</div>

<div class="container py-5 my-md-4" id="beneficios">
    <div class="row align-items-center gy-5">
        <div class="col-md-7 order-1 order-md-2">
            <h2 class="mb-4 Ddutv">
                Na <span class="corV">Agility</span>, você tem muitas vantagens
            </h2>
            <div class="row row-cols-1 row-cols-md-2 g-4">
                <div class="col d-flex">
                    <div class="me-3">
                        <img src="/img/foguete.svg" alt="Ultravelocidade para você">
                    </div>
                    <div>
                        <h6 class="fw-bold mb-1 agltDdutv">Ultravelocidade para você</h6>
                        <p class="mb-0 agltP">Para aproveitar bem os jogos, filmes e muito mais.</p>
                    </div>
                </div>
                <div class="col d-flex">
                    <div class="me-3">
                        <img src="/img/desconto.svg" alt="Planos que cabem no seu bolso">
                    </div>
                    <div>
                        <h6 class="fw-bold mb-1 agltDdutv">Planos que cabem no seu bolso</h6>
                        <p class="mb-0 agltP">Qualidade combinada com o preço justo que cabe no seu bolso.</p>
                    </div>
                </div>
                <div class="col d-flex">
                    <div class="me-3">
                        <img src="/img/cabo.svg" alt="Tecnologia Fibra Óptica">
                    </div>
                    <div>
                        <h6 class="fw-bold mb-1 agltDdutv">Tecnologia Fibra Óptica</h6>
                        <p class="mb-0 agltP">Internet mais rápida e estável para você ter uma conexão incrível.</p>
                    </div>
                </div>
                <div class="col d-flex">
                    <div class="me-3">
                        <img src="/img/capacete.svg" alt="Suporte técnico presencial">
                    </div>
                    <div>
                        <h6 class="fw-bold mb-1 agltDdutv">Suporte técnico presencial</h6>
                        <p class="mb-0 agltP">Uma equipe preparada para te dar todo o suporte necessário.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5 text-center order-2 order-md-1">
            <img src="img/advantages-desktop.svg" alt="Atendente Agility" class="img-fluid">
        </div>
    </div>
</div>