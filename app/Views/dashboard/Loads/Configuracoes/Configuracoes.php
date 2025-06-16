<div class="col-auto col-md-6 d-flex">
	<h4 class="my-auto"><i class="bi bi-gear-fill"></i> Configurações</h4>
</div>
<div class="col-12">
	<hr class="my-3">
</div>
<div class="col-md-12">
	<h5 class="text-center">Usúarios do Sistema</h5>
	<div class="rounded-3 p-1 border shadow-boxes">
		<div class="d-flex">
			<button id="addUsuario" class="ms-auto my-2 btn btn-light rounded-3 border shadow-sm"><i class="text-success bi bi-person-plus-fill"> </i> Cadastrar Usúario</button>
		</div>
		<div class="overflow-auto" style="max-height: 75vh;">
			<table class="table table-striped mw-mc mb-0 text-center align-middle">
				<thead class="position-sticky top-0 z-2 shadow-sm">
					<tr>
						<th class="position-sticky start-0" scope="col">Usuário</th>
						<th scope="col">Email</th>
						<th scope="col">Opções</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$conDb = new Classes\ConDB;
					$getUsers = new Classes\Metodos($conDb);
					$getUsers = $getUsers->table('tb_sysadmin')->select('id, usuario, email, status')->where('status', '=', 1)->get();

					foreach ($getUsers as $user) {
					?>
						<tr class="fst-italic">
							<th class="position-sticky start-0 fw-semibold"><?= $user->usuario ?></th>
							<td><?= $user->email ?></td>
							<td>
								<?php if ($_SESSION['ADMIN']['id'] == $user->id) { ?>
									<button data-id="<?= $user->id ?>" class="disabled p-3 position-relative rounded-circle btn btn-danger">
										<i class="position-absolute top-50 start-50 translate-middle bi bi-trash"></i>
									</button>
								<?php } else { ?>
									<button data-id="<?= $user->id ?>" class="excluirUsuario p-3 position-relative rounded-circle btn btn-danger">
										<i class="position-absolute top-50 start-50 translate-middle bi bi-trash"></i>
									</button>
								<?php } ?>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<div class="col-md-12 mt-4">
	<h5 class="text-center">Links e Contatos</h5>
	<?php
	$conDb = new Classes\ConDB;
	$getDados = new Classes\Metodos($conDb);
	$getDados = $getDados->table('tb_configuracoes')->get();
	$config = $getDados[0] ?? '';
	?>
	<form id="formConfiguracoes" class="rounded-3 p-3 border shadow-boxes">
		<div class="row g-3">
			<div class="col-md-4">
				<label for="cnpj" class="form-label">CNPJ</label>
				<div class="input-group input-group-sm">
					<span class="input-group-text"><i class="bi bi-file-earmark-text"></i></span>
					<input type="text" class="form-control" id="cnpj" name="cnpj" value="<?= $config->cnpj ?? '' ?>" required maxlength="18" oninput="formatCNPJ(this)" autocomplete="off" inputmode="numeric">
				</div>
			</div>

			<div class="col-md-4">
				<label for="email" class="form-label">E-mail</label>
				<div class="input-group input-group-sm">
					<span class="input-group-text"><i class="bi bi-envelope-at-fill"></i></span>
					<input type="email" class="form-control" id="email" name="email" value="<?= $config->email ?? '' ?>" required>
				</div>
			</div>

			<div class="col-md-4">
				<label for="facebook" class="form-label">Facebook</label>
				<div class="input-group input-group-sm">
					<span class="input-group-text"><i class="bi bi-facebook"></i></span>
					<input type="url" class="form-control" id="facebook" name="facebook" value="<?= $config->facebook ?? '' ?>">
				</div>
			</div>

			<div class="col-md-4">
				<label for="instagram" class="form-label">Instagram</label>
				<div class="input-group input-group-sm">
					<span class="input-group-text"><i class="bi bi-instagram"></i></span>
					<input type="url" class="form-control" id="instagram" name="instagram" value="<?= $config->instagram ?? '' ?>">
				</div>
			</div>

			<div class="col-md-4">
				<label for="linkedin" class="form-label">LinkedIn</label>
				<div class="input-group input-group-sm">
					<span class="input-group-text"><i class="bi bi-linkedin"></i></span>
					<input type="url" class="form-control" id="linkedin" name="linkedin" value="<?= $config->linkedin ?? '' ?>">
				</div>
			</div>

			<div class="col-md-4">
				<label for="youtube" class="form-label">YouTube</label>
				<div class="input-group input-group-sm">
					<span class="input-group-text"><i class="bi bi-youtube"></i></span>
					<input type="url" class="form-control" id="youtube" name="youtube" value="<?= $config->youtube ?? '' ?>">
				</div>
			</div>

			<div class="col-md-4">
				<label for="google_play" class="form-label">Google Play</label>
				<div class="input-group input-group-sm">
					<span class="input-group-text"><i class="bi bi-google-play"></i></span>
					<input type="url" class="form-control" id="google_play" name="google_play" value="<?= $config->google_play ?? '' ?>">
				</div>
			</div>

			<div class="col-md-4">
				<label for="app_store" class="form-label">App Store</label>
				<div class="input-group input-group-sm">
					<span class="input-group-text"><i class="bi bi-apple"></i></span>
					<input type="url" class="form-control" id="app_store" name="app_store" value="<?= $config->app_store ?? '' ?>">
				</div>
			</div>

			<div class="col-md-4">
				<label for="area_cliente" class="form-label">Área do Cliente</label>
				<div class="input-group input-group-sm">
					<span class="input-group-text"><i class="bi bi-person-badge"></i></span>
					<input type="url" class="form-control" id="area_cliente" name="area_cliente" value="<?= $config->area_cliente ?? '' ?>">
				</div>
			</div>

			<div class="col-md-4">
				<label for="whatsapp" class="form-label">WhatsApp</label>
				<div class="input-group input-group-sm">
					<span class="input-group-text"><i class="bi bi-whatsapp"></i></span>
					<input type="number" class="form-control" id="whatsapp" name="whatsapp" value="<?= $config->whatsapp ?? '' ?>">
				</div>
			</div>

			<div class="col-md-4">
				<label for="endereco" class="form-label">Edereço</label>
				<div class="input-group input-group-sm">
					<span class="input-group-text"><i class="bi bi-geo-alt-fill"></i></span>
					<input type="text" class="form-control" id="endereco" name="endereco" value="<?= $config->endereco ?? '' ?>">
				</div>
			</div>
		</div>

		<div class="text-center mt-4">
			<button type="submit" class="btn btn-success px-4">
				<i class="bi bi-check-circle-fill me-2"></i>Salvar Configurações
			</button>
		</div>
	</form>
</div>
<?php
$conDB = new Classes\ConDB;
$Metodos = new Classes\Metodos($conDB);

$banners = $Metodos->table('tb_banners')->get();

$grupoBanners = [];
foreach ($banners as $banner) {
	$nome = $banner->banner;
	$id = $banner->id;
	$url = $banner->url_direcionamento;
	$clicavel = $banner->clicavel;

	$codigoBase = str_replace('_mobile', '', pathinfo($nome, PATHINFO_FILENAME));

	if (!isset($grupoBanners[$codigoBase])) {
		$grupoBanners[$codigoBase] = [
			'desktop' => null,
			'mobile' => null,
			'url' => $url,
			'clicavel' => $clicavel,
			'id_desktop' => null,
			'id_mobile' => null
		];
	}

	if (strpos($nome, '_mobile') !== false) {
		$grupoBanners[$codigoBase]['mobile'] = $nome;
		$grupoBanners[$codigoBase]['id_mobile'] = $id;
	} else {
		$grupoBanners[$codigoBase]['desktop'] = $nome;
		$grupoBanners[$codigoBase]['id_desktop'] = $id;
	}
}
?>

<div class="col-md-12 mt-4">
	<h5 class="text-center">Banners principais</h5>
	<div class="rounded-3 p-3 border shadow-boxes">
		<div class="text-end mb-3">
			<button id="addPlan" modal-target="#modalAdicionarBanner" class="modalAdicionarBanner btn btn-success rounded-3 shadow-sm">
				<i class="text-success bi bi-plus-lg text-white"></i> Adicionar Banner
			</button>
		</div>

		<?php foreach ($grupoBanners as $codigo => $banners): ?>
			<div class="row mb-4 align-items-center p-2 border rounded">
				<div class="col-12 text-center mt-2">
					<div class="d-flex justify-content-center align-items-center mb-3">
						<div class="flex-fill d-flex justify-content-start align-items-center">
							<div class="form-floating w-100">
								<input type="url"
									class="form-control form-control-sm"
									id="url_direcionamento_<?= $codigo ?>"
									placeholder="URL de direcionamento"
									value="<?= !empty($banners['url']) ? htmlspecialchars($banners['url']) : '' ?>">
								<label for="url_direcionamento_<?= $codigo ?>">URL de direcionamento</label>
							</div>

							<?php if (!empty($banners['url'])): ?>
								<a href="<?= htmlspecialchars($banners['url']) ?>" target="_blank"
									class="btn btn-outline-primary ms-2"
									title="Ver Link">
									<i class="bi bi-link-45deg"></i>
								</a>
							<?php endif; ?>

							<button type="button"
								class="btn btn-outline-secondary ms-2 editar-url-btn"
								title="Editar URL">
								<i class="bi bi-pencil-square"></i>
							</button>
							<button type="button"
								class="btn btn-outline-success ms-2 salvar-url-btn d-none"
								data-id-desktop="<?= $banners['id_desktop'] ?>"
								data-id-mobile="<?= $banners['id_mobile'] ?>"
								data-cod-url="<?= $codigo ?>"
								title="Salvar URL" modal-target="#modalEditUrlBanner">
								<i class="bi bi-clipboard-check-fill"></i>
							</button>
						</div>

						<div class="p-2 flex-fill d-flex justify-content-end">
							<button type="button"
								class="excluirBanner p-3 position-relative btn btn-danger"
								data-id-desktop="<?= $banners['id_desktop'] ?>"
								data-id-mobile="<?= $banners['id_mobile'] ?>"
								title="Excluir Banner" modal-target="#modalExcluirBanner">
								<i class="position-absolute top-50 start-50 translate-middle bi bi-trash"></i>
							</button>
						</div>
					</div>
				</div>

				<div class="col-md-6 text-center">
					<?php if ($banners['desktop']): ?>
						<strong>Desktop:</strong><br>
						<img src="img/banner/<?= $banners['desktop'] ?>" alt="Banner Desktop" class="img-fluid rounded border mb-2" style="height: auto;">
					<?php else: ?>
						<em>Sem banner Desktop</em>
					<?php endif; ?>
				</div>

				<div class="col-md-6 text-center">
					<?php if ($banners['mobile']): ?>
						<strong>Mobile:</strong><br>
						<img src="img/banner/<?= $banners['mobile'] ?>" alt="Banner Mobile" class="img-fluid rounded border mb-2" style="max-width: 200px; height: auto;">
					<?php else: ?>
						<em>Sem banner Mobile</em>
					<?php endif; ?>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</div>

<?php
require_once 'Modais/Modal_Usuarios.php';
?>
<script type="text/javascript">
	"use strict";
	$('#addUsuario').click(function() {
		$('#formAdicionarUsuario')[0].reset();
		$('#modalUsuariosSistema').modal('show');
	});

	$('#formAdicionarUsuario').submit(function(e) {
		e.preventDefault();
		let dados = $(this).serialize();
		$.ajax({
			url: '/request/users',
			type: 'post',
			dataType: 'json',
			data: dados,
			success: function(result) {
				if (result.status == 'success') {
					toast(result.status, result.msg);
					$('#modalUsuariosSistema').modal('hide');
					$('#formAdicionarUsuario')[0].reset();
					$('#v-pills-configuracoes').load('/load/configuracoes');
				} else {
					toast(result.status, result.msg);
				}
			},
			error: function(e) {
				toast('error', 'Erro interno');
			}
		});
	});

	$('#formConfiguracoes').submit(function(e) {
		e.preventDefault();
		let dados = $(this).serialize();
		$.ajax({
			url: '/request/conf',
			type: 'post',
			dataType: 'json',
			data: dados,
			success: function(result) {
				if (result.status == 'success') {
					toast(result.status, result.msg);
					$('#v-pills-configuracoes').load('/load/configuracoes');
				} else {
					toast(result.status, result.msg);
				}
			},
			error: function(e) {
				toast('error', 'Erro interno');
			}
		});
	});

	$('.excluirUsuario').click(function() {
		let id = $(this).attr('data-id');
		$('#idExcluirUsuario').val(id);
		$('#modalExcluirUsuario').modal('show');
	});

	$('#btnExcluirUsuario').click(function() {
		let id = $('#idExcluirUsuario').val();
		$.ajax({
			url: '/request/users/' + id,
			type: 'delete',
			dataType: 'json',
			success: function(result) {
				if (result.status == 'success') {
					toast(result.status, result.msg);
					$('#modalExcluirUsuario').modal('hide');
					$('#v-pills-configuracoes').load('/load/configuracoes');

				} else {
					toast(result.status, result.msg);
					$('#modalExcluirUsuario').modal('hide');
				}
			},
			error: function(e) {
				toast('error', 'Erro interno');
			}
		});
	});

	function formatCNPJ(field) {
		let v = field.value.replace(/\D/g, '');

		if (v.length > 14) v = v.slice(0, 14);

		v = v.replace(/^(\d{2})(\d)/, '$1.$2');
		v = v.replace(/^(\d{2})\.(\d{3})(\d)/, '$1.$2.$3');
		v = v.replace(/\.(\d{3})(\d)/, '.$1/$2');
		v = v.replace(/(\d{4})(\d)/, '$1-$2');

		field.value = v;
	}

	$('.modalAdicionarBanner').click(function() {
		let modal = $(this).attr('modal-target');
		$(modal + ' .modal-title').text('Cadastrar Banner');
		$(modal + ' form').attr('method', 'post');
		$(modal + ' .salvar').val('Salvar');
		$(modal + ' form')[0].reset();
		$(modal + ' input[type="file"]').val('');
		$('#previewDesktopContainer').hide();
		$('#bannerDesktopPreview').attr('src', '');
		$('#previewMobileContainer').hide();
		$('#bannerMobilePreview').attr('src', '');
		$(modal).modal('show');
	});

	$('.salvar').click(function() {
		let btnSubmitText = $(this).html();
		$(this).addClass('disabled').html('Salvando... <div class="spinner-border text-light" role="status" style="width: 20px; height: 20px"></div>');
		let formId = $('.modal.show form').attr('id');
		let form = document.getElementById(formId);
		let reload = $(form).attr('reload');
		let modal = '#' + $('.modal.show').attr('id');
		let action = $(modal + ' form').attr('action');
		envForm.setForm(form);
		setTimeout(() => {
			let dados = envForm.request();
			if (dados.status == 'success') {
				$(modal).modal('hide');
				toast(dados.status, dados.msg);
				$('#v-pills-' + reload).html('<div class="d-flex vh-60"><div class="m-auto spinner-border text-warning" role="status" style="width: 6rem; height: 6rem;"></div></div>').off().load('/load/' + reload);

			} else {
				$(this).removeClass('disabled').html(btnSubmitText);
				toast(dados.status, dados.msg);
			}
		}, 50);
	});

	$('.editar-url-btn').click(function() {
		var container = $(this).closest('.d-flex');
		container.find('.salvar-url-btn').removeClass('d-none');
		$(this).addClass('d-none');
	});

	$('.excluirBanner').click(function() {
		let modal = $(this).attr('modal-target');
		let desktop = $(this).attr('data-id-desktop');
		let mobile = $(this).attr('data-id-mobile');
		$(modal + ' #idExcluirDeskTop').val(desktop);
		$(modal + ' #idExcluirMobile').val(mobile);
		$(modal).modal('show');
	});

	$('.salvar-url-btn').click(function() {
		let modal = $(this).attr('modal-target');
		let desktop = $(this).attr('data-id-desktop');
		let mobile = $(this).attr('data-id-mobile');
		let cod = $(this).attr('data-cod-url');
		let urlInputId = '#url_direcionamento_' + cod;
		let urlAtual = $(urlInputId).val();
		$(modal + ' #idEditarDeskTop').val(desktop);
		$(modal + ' #idEditarMobile').val(mobile);
		$(modal + ' #url_direcionamento_modal').val(urlAtual);
		$(modal).modal('show');
	});
</script>