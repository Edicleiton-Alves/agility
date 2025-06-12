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