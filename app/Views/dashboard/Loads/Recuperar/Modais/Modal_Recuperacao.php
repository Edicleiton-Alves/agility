<div class="modal fade" id="modalEsqSen" data-bs-backdrop="static" tabindex="-1"
    aria-labelledby="modalEsqSenLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 bg-white">
            <div class="modal-header bg-danger bg-gradient text-white rounded-top-4">
                <h5 class="modal-title" id="modalEsqSenLabel">
                    <i class="bi bi-envelope-fill me-2"></i> Recuperar Senha
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                <form id="formRecuperarSenha" action="/request/recuperarSenha" method="post">
                    <div class="text-center py-4">
                        <div class="mb-3">
                            <i class="bi bi-lock-fill text-danger display-3"></i>
                        </div>
                        <h4 class="fw-bold">Esqueceu sua senha?</h4>
                        <p class="text-muted">Digite seu e-mail para receber o link de recuperação.</p>

                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="emailRecuperacao" name="email" placeholder="email@exemplo.com" required>
                            <label for="emailRecuperacao">E-mail</label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-center border-0 pb-4">
                <button type="submit" form="formRecuperarSenha" modal-target="#modalConfCod" class="btn btn-primary px-5 py-2">Enviar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalConfCod" data-bs-backdrop="static" tabindex="-1" aria-labelledby="modalConfCodLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 bg-white">
            <div class="modal-header bg-danger bg-gradient text-white rounded-top-4">
                <h5 class="modal-title" id="modalConfCodLabel">
                    <i class="bi bi-key-fill me-2"></i> Confirme o Código
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                <form id="formConfirmarCodigo" action="/request/confirmarCodigo" method="post" reload="">
                    <input type="hidden" name="email" id="emailConfirmacao" value="">

                    <div class="text-center mb-4">
                        <i class="bi bi-shield-lock-fill text-danger display-4 mb-3"></i>
                        <h5 class="fw-bold">Verificação de Segurança</h5>
                        <p class="text-muted small">Digite o código enviado para o seu e-mail</p>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control text-center fw-semibold fs-5" id="codigo" name="codigo" required maxlength="6" autocomplete="off" placeholder="Código">
                        <label for="codigo"><i class="bi bi-lock me-1"></i> Código de Verificação</label>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-center border-0 pb-4">
                <button type="submit" form="formConfirmarCodigo" class="btn btn-primary px-5 py-2">
                    <i class="bi bi-check-circle me-2"></i>Confirmar
                </button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalNovaSenha" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 bg-white">
            <div class="modal-header bg-danger bg-gradient text-white rounded-top-4">
                <h5 class="modal-title">
                    <i class="bi bi-shield-lock-fill me-2"></i> Definir Nova Senha
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                <form id="formNovaSenha" action="/request/novaSenha" method="post" reload="">
                    <input type="hidden" name="id" id="edit" value="">

                    <div class="text-center mb-4">
                        <i class="bi bi-key-fill text-danger display-4 mb-3"></i>
                        <h5 class="fw-bold">Criação de Senha</h5>
                        <p class="text-muted small">Digite e confirme sua nova senha de acesso.</p>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="novaSenha" name="novaSenha" placeholder="Nova Senha" required>
                        <label for="novaSenha"><i class="bi bi-lock-fill me-1"></i> Nova Senha</label>
                    </div>

                    <div class="form-floating mb-4">
                        <input type="password" class="form-control" id="confirmaSenha" name="confirmaSenha" placeholder="Confirmar Senha" required>
                        <label for="confirmaSenha"><i class="bi bi-lock-fill me-1"></i> Confirmar Senha</label>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-center border-0 pb-4">
                <button type="submit" form="formNovaSenha" class="btn btn-success px-5 py-2">
                    <i class="bi bi-check-circle me-2"></i>Salvar
                </button>
            </div>
        </div>
    </div>
</div>