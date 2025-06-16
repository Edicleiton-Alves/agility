<div class="modal fade" id="modalUsuariosSistema" data-bs-backdrop="static" tabindex="-1" aria-labelledby="usuariosSistemaLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="mb-0">Cadastrar Usuário</h5>
				<button type="button" class="btn-close position-absolute top-0 end-0 m-2" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form id="formAdicionarUsuario" action="">
				<div class="modal-body text-center">
					<input type="hidden" id="idUsuario">
					<div class="form-floating mb-3">
						<input type="text" class="form-control" id="usuario" name="usuario" placeholder="usuario">
						<label for="usuario"><i class="bi bi-person-fill"> </i> Nome do Usuário</label>
					</div>
					<div class="form-floating mb-3">
						<input type="text" class="form-control" id="e-mail" name="e-mail" placeholder="e-mail">
						<label for="e-mail"><i class="bi bi-envelope-fill"> </i> Email</label>
					</div>
					<div class="form-floating">
						<input type="text" class="form-control" id="senha" name="senha" placeholder="senha">
						<label for="senha"><i class="bi bi-lock-fill"> </i> Senha</label>
					</div>
					<div class="erroAddUsuario invalid-feedback fw-bold"></div>
				</div>
				<div class="modal-footer">
					<div class="d-flex">
						<div class="ms-auto">
							<input type="submit" class="btn btn-success" value="Salvar">
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>


<div class="modal fade" id="modalExcluirUsuario" data-bs-backdrop="static" tabindex="-1" aria-labelledby="modalDelUsuarioLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content border-0 shadow-lg rounded-4 bg-white">
			<div class="modal-header bg-danger bg-gradient text-white rounded-top-4">
				<h5 class="modal-title" id="modalDelUsuarioLabel">
					<i class="bi bi-trash3-fill me-2"></i> Confirmar Exclusão
				</h5>
				<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
			</div>
			<div class="modal-body">
				<form id="formExcluirUsuario">
					<input type="hidden" id="idExcluirUsuario" name="id_exclude" value="">
					<div class="text-center py-4">
						<div class="mb-3">
							<i class="bi bi-exclamation-triangle-fill text-warning display-3"></i>
						</div>
						<h4 class="fw-bold">Tem certeza que deseja excluir este usuário?</h4>
						<p class="text-muted">Esta ação não poderá ser desfeita.</p>
					</div>
				</form>
			</div>
			<div class="modal-footer justify-content-center border-0 pb-4">
				<button type="button" class="btn btn-secondary px-5 py-2" data-bs-dismiss="modal">Cancelar</button>
				<button type="button" class="salvar btn btn-danger px-5 py-2" id="btnExcluirUsuario">Excluir</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modalAdicionarBanner" tabindex="-1" aria-labelledby="modalAdicionarBannerLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="formAdicionarBanner" method="post" action="/request/adicionarBanner" enctype="multipart/form-data" class="modal-content" reload="configuracoes">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAdicionarBannerLabel">Adicionar Novo Banner</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="bannerDesktopInput" class="form-label">Imagem do Banner Desktop (1140x414)</label>
                    <input type="file" class="form-control" name="banner_desktop" id="bannerDesktopInput" accept="image/*" required onchange="mostrarPreview(this, 'previewDesktopContainer', 'bannerDesktopPreview')">
                </div>
                <div id="previewDesktopContainer" class="mb-3 text-center" style="display:none;">
                    <p class="mb-1"><strong>Pré-visualização Desktop:</strong></p>
                    <img id="bannerDesktopPreview" src="" alt="Preview Desktop" class="img-fluid rounded shadow" style="max-height:200px;">
                </div>
                <div class="mb-3">
                    <label for="bannerMobileInput" class="form-label">Imagem do Banner Mobile(375x495)</label>
                    <input type="file" class="form-control" name="banner_mobile" id="bannerMobileInput" accept="image/*" required onchange="mostrarPreview(this, 'previewMobileContainer', 'bannerMobilePreview')">
                </div>
                <div id="previewMobileContainer" class="mb-3 text-center" style="display:none;">
                    <p class="mb-1"><strong>Pré-visualização Mobile:</strong></p>
                    <img id="bannerMobilePreview" src="" alt="Preview Mobile" class="img-fluid rounded shadow" style="max-height:200px;">
                </div>
                <div class="mb-3">
                    <label for="url_direcionamento" class="form-label">URL de Direcionamento (opcional)</label>
                    <input type="text" class="form-control" name="url_direcionamento">
                </div>
                <div class="mb-3">
                    <label for="clicavel" class="form-label">Clicável?</label>
                    <select name="clicavel" class="form-select" required>
                        <option value="1">Sim</option>
                        <option value="2">Não</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success salvar">Salvar</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="modalExcluirBanner" data-bs-backdrop="static" tabindex="-1"
    aria-labelledby="modalExcluirBannerLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 bg-white">
            <div class="modal-header bg-danger bg-gradient text-white rounded-top-4">
                <h5 class="modal-title" id="modalExcluirBannerLabel">
                    <i class="bi bi-trash3-fill me-2"></i> Confirmar Exclusão
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                <form id="formExcluirBanner" action="/request/banner" reload="configuracoes" method="delete">
                    <input type="hidden" id="idExcluirDeskTop" name="id_desktop" value="a">
					<input type="hidden" id="idExcluirMobile" name="id_mobile" value="a">
                    <div class="text-center py-4">
                        <div class="mb-3">
                            <i class="bi bi-exclamation-triangle-fill text-warning display-3"></i>
                        </div>
                        <h4 class="fw-bold">Tem certeza que deseja excluir estes banners?</h4>
                        <p class="text-muted">Esta ação não poderá ser desfeita.</p>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-center border-0 pb-4">
                <button type="button" class="salvar btn btn-danger px-5 py-2">Excluir</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalEditUrlBanner" data-bs-backdrop="static" tabindex="-1"
    aria-labelledby="modalEditUrlBannerLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 bg-white">
            <div class="modal-header bg-success bg-gradient text-white rounded-top-4">
                <h5 class="modal-title" id="modalEditUrlBannerLabel">
                    <i class="bi bi-link-45deg me-2"></i> Confirmar Edição de URL
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                <form id="formEditUrlBanner" action="/request/banner" reload="configuracoes" method="put">
                    <input type="hidden" id="idEditarDeskTop" name="id_desktop" value="">
                    <input type="hidden" id="idEditarMobile" name="id_mobile" value="">

                    <div class="mb-3">
                        <label for="url_direcionamento_modal" class="form-label">Nova URL de direcionamento</label>
                        <input type="url" class="form-control" id="url_direcionamento_modal" name="url_direcionamento" placeholder="Digite a nova URL">
                    </div>

                    <div class="text-center py-4">
                        <div class="mb-3">
                            <i class="bi bi-question-circle-fill text-success display-3"></i>
                        </div>
                        <h4 class="fw-bold">Tem certeza que deseja editar a URL do banner?</h4>
                        <p class="text-muted">A URL atual será substituída pela nova que você informar.</p>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-center border-0 pb-4">
                <button type="button" class="salvar btn btn-success px-5 py-2">Confirmar</button>
            </div>
        </div>
    </div>
</div>

<script>
function mostrarPreview(input, containerId, imgId) {
    const file = input.files[0];
    const container = document.getElementById(containerId);
    const img = document.getElementById(imgId);

    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            img.src = e.target.result;
            container.style.display = 'block';
        };
        reader.readAsDataURL(file);
    } else {
        img.src = '';
        container.style.display = 'none';
    }
}
</script>
