<footer class="pt-5">
    <div class="container mb-5">
        <div class="row gy-4 justify-content-between align-items-center">
            <div class="col-12 col-md-8 order-2 order-md-1">
                <div class="d-flex align-items-center justify-content-start gap-3 flex-wrap">
                    <img src="img/logo.svg" alt="Agility Telecom" class="imgSty">
                    <div class="border-start border-black d-none d-md-block d-lg-none" style="height: 60px;"></div>
                    <div class="ps-3">
                        <p class="mb-1">Agility Serviços de Telecomunicações LTDA</p>
                        <p class="mb-1">CNPJ: <span class="text-muted"><?= CONFIGURACAO['cnpj'] ?></span></p>
                        <p class="mb-0">E-mail: <span class="text-muted"><?= CONFIGURACAO['email'] ?></span></p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4 text-start order-1 order-md-2">
                <p class="mb-2 fpPjcqFoo">Siga a Agility nas Redes Sociais</p>
                <div class="d-flex flex-wrap justify-content-start gap-3 mb-3">
                    <a href="<?= CONFIGURACAO['facebook'] ?>" target="_blank" rel="noreferrer"
                        class="d-flex align-items-center justify-content-center bg-dark rounded-circle"
                        style="width: 50px; height: 50px;">
                        <i class="bi bi-facebook corV fs-5"></i>
                    </a>
                    <a href="<?= CONFIGURACAO['instagram'] ?>" target="_blank" rel="noreferrer"
                        class="d-flex align-items-center justify-content-center bg-dark rounded-circle"
                        style="width: 50px; height: 50px;">
                        <i class="bi bi-instagram corV fs-5"></i>
                    </a>
                    <a href="<?= CONFIGURACAO['linkedin'] ?>" target="_blank" rel="noreferrer"
                        class="d-flex align-items-center justify-content-center bg-dark rounded-circle"
                        style="width: 50px; height: 50px;">
                        <i class="bi bi-linkedin corV fs-5"></i>
                    </a>
                    <a href="<?= CONFIGURACAO['youtube'] ?>" target="_blank" rel="noreferrer"
                        class="d-flex align-items-center justify-content-center bg-dark rounded-circle"
                        style="width: 50px; height: 50px;">
                        <i class="bi bi-youtube corV fs-5"></i>
                    </a>
                </div>
                <p class="mb-2 fpPjcqFoo">Baixe o App Central do Assinante</p>
                <div class="d-flex flex-wrap justify-content-start gap-2">
                    <a href="<?= CONFIGURACAO['google_play'] ?>" target="_blank" rel="noreferrer">
                        <img class="rounded-1" src="/img/google-play.png" alt="Play Store" style="max-width: 130px;">
                    </a>
                    <a href="<?= CONFIGURACAO['app_store'] ?>" target="_blank" rel="noreferrer">
                        <img class="rounded-1" src="/img/app-store.png" alt="App Store" style="max-width: 115px;">
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="fpPjcq">
        <div class="container p-4">
            <div class="row">
                <div class="col-md-6 my-2 order-1">
                    <div class="text-start text-white">
                        <p class="mb-0 fpPjcqmotto">© <?= date('Y') ?> Agility Telecom - Um jeito novo de conectar pessoas</p>
                    </div>
                </div>
                <div class="col-md-2 my-2 order-3 order-md-2">
                    <div class="text-start text-white">
                        <img src="/img/grupoBrisanet.svg" class="groupBrisanet" alt="Grupo Brisanet">
                    </div>
                </div>
                <div class="col-md-4 my-2 order-2 order-md-3">
                    <div class="text-start text-md-end text-white">
                        <p class="mb-0 fpPjcqmotto">Todos os direitos reservados</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<div class="whatsapp">
    <a href="https://api.whatsapp.com/send?phone=<?= CONFIGURACAO['whatsapp'] ?>&text=Olá, gostaria de falar com a Agility Telecom!" target="_blank" rel="noopener">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 60 60.000002" width="60" height="60.000004">
            <g id="g2134" transform="scale(0.24,0.23892807)">
                <path fill="#ffffff" d="M 0,251.12162 17.660525,186.64101 A 124.21075,124.21075 0 0 1 1.045523,124.43064 C 1.074283,55.818693 56.909948,0 125.52366,0 c 33.29594,0.01692 64.54836,12.974289 88.0519,36.495147 23.50431,23.520879 36.43614,54.78504 36.42443,88.035323 -0.0307,68.60663 -55.87471,124.43599 -124.47807,124.43599 h -0.0537 c -20.83089,-0.005 -41.299788,-5.23453 -59.48139,-15.14839 z" id="path330" style="fill:#26b43c;fill-opacity:1;stroke-width:1.69176" />
                <path fill="#ffffff" d="m 51.113497,199.77881 10.439,-38.114 a 73.42,73.42 0 0 1 -9.821,-36.77199 c 0.017,-40.556005 33.021,-73.550005 73.578003,-73.550005 19.681,0.01 38.154,7.669 52.047,21.572 13.893,13.903 21.537,32.383005 21.53,52.037005 -0.018,40.55299 -33.027,73.55299 -73.578,73.55299 h -0.032 c -12.313,-0.005 -24.412,-3.09399 -35.159003,-8.954 z" id="path14" style="fill:#ffffff;fill-rule:nonzero;stroke:none;stroke-width:0;stroke-dasharray:none" />
                <path fill="url(#linearGradient1780)" d="m 125.3315,63.767815 c -33.733003,0 -61.166003,27.423 -61.178003,61.130005 a 60.98,60.98 0 0 0 9.349,32.53499 l 1.455,2.31201 -6.179,22.559 23.146,-6.069 2.235,1.324 c 9.387003,5.571 20.150003,8.518 31.126003,8.524 h 0.023 c 33.707,0 61.14,-27.426 61.153,-61.135 a 60.75,60.75 0 0 0 -17.895,-43.251005 60.75,60.75 0 0 0 -43.235,-17.929 z" id="path16" />
                <path fill="url(#b)" d="m 125.3315,63.767815 c -33.733003,0 -61.166003,27.423 -61.178003,61.130005 a 60.98,60.98 0 0 0 9.349,32.53499 l 1.455,2.313 -6.179,22.558 23.146,-6.069 2.235,1.324 c 9.387003,5.571 20.150003,8.517 31.126003,8.523 h 0.023 c 33.707,0 61.14,-27.42599 61.153,-61.13499 a 60.75,60.75 0 0 0 -17.895,-43.251005 60.75,60.75 0 0 0 -43.235,-17.928 z" id="path18" style="fill:#26b43c;fill-opacity:1" />
                <path fill="#ffffff" fill-rule="evenodd" d="m 106.9195,94.143815 c -1.378,-3.061 -2.828,-3.123 -4.137,-3.176 l -3.524003,-0.043 c -1.226,0 -3.218,0.46 -4.902,2.3 -1.684,1.84 -6.435,6.287 -6.435,15.332005 0,9.045 6.588,17.78499 7.506,19.013 0.918,1.228 12.718003,20.38099 31.405003,27.74999 15.529,6.124 18.689,4.906 22.061,4.6 3.372,-0.306 10.877,-4.447 12.408,-8.74 1.531,-4.293 1.532,-7.971 1.073,-8.74 -0.459,-0.769 -1.685,-1.226 -3.525,-2.146 -1.84,-0.92 -10.877,-5.367 -12.562,-5.981 -1.685,-0.614 -2.91,-0.91899 -4.137,0.921 -1.227,1.84001 -4.746,5.979 -5.819,7.206 -1.073,1.22701 -2.144,1.381 -3.984,0.462 -1.84,-0.91899 -7.76,-2.861 -14.784,-9.12399 -5.465,-4.873 -9.154,-10.891 -10.228,-12.73 -1.074,-1.839 -0.114,-2.835 0.808,-3.751 0.825,-0.824 1.838,-2.147 2.759,-3.22 0.921,-1.073 1.224,-1.84 1.836,-3.065 0.612,-1.225 0.307,-2.301 -0.153,-3.22 -0.46,-0.919 -4.032,-10.011005 -5.666,-13.647005" id="path20" />
            </g>
        </svg>
    </a>
</div>

<div vw class="enabled">
    <div vw-access-button class="active"></div>
    <div vw-plugin-wrapper>
        <div class="vw-plugin-top-wrapper"></div>
    </div>
</div>
<div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="toastfc" class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div id="msgToastFC" class="toast-body"></div>
        </div>
    </div>
</div>