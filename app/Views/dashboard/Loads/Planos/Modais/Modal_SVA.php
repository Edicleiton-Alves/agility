<style>
  .modal-header {
    background-color: #002855;
    color: #ffffff;
  }

  .modal-footer {
    background-color: #f8f9fa;
    border-top: 1px solid #dee2e6;
  }

  .modal-title {
    color: #ffffff;
  }

  .btn-agility {
    background-color: #f4a100;
    border: none;
    color: white;
  }

  .btn-agility:hover {
    background-color: #d48f00;
  }

  .btn-close {
    filter: invert(1);
  }

  .form-label {
    font-weight: 500;
    color: #002855;
  }

  .form-control,
  .form-select {
    border-color: #002855;
  }

  .form-control:focus,
  .form-select:focus {
    border-color: #f4a100;
    box-shadow: 0 0 0 0.2rem rgba(244, 161, 0, 0.25);
  }
</style>

<div class="modal fade" id="modalAddSva" tabindex="-1" aria-labelledby="modalAddSvaLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="formAddSva" action="/request/Sva" method="post" enctype="multipart/form-data" reload="cadSva">
      <input type="hidden" name="edit" id="edit">
      <div class="modal-content border-0 shadow-lg">
        <div class="modal-header">
          <h5 class="modal-title" id="modalAddSvaLabel">Cadastrar SVA/Painel</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="titulo" class="form-label">Título</label>
            <input type="text" class="form-control" id="titulo" name="titulo" required>
          </div>
          <div class="mb-3">
            <label for="tipo_sva" class="form-label">Tipo</label>
            <select class="form-select" id="tipo_sva" name="tipo_sva" required>
              <option value="">Selecione</option>
              <option value="Item">Item</option>
              <option value="Seção">Seção</option>
              <option value="Benefício">Benefício</option>
            </select>
          </div>
          <div class="mb-3 d-none" id="campoImagem">
            <label for="imagem" class="form-label">Imagem</label>
            <input class="form-control" type="file" id="imagem" name="imagem" accept="image/*">
            <div class="mt-2">
              <img id="previewImagem" src="" alt="Prévia da imagem" class="img-fluid rounded d-none" style="max-height: 200px;">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-agility salvar">Salvar</button>
        </div>
      </div>
    </form>
  </div>
</div>

<div class="modal fade" id="modalExcluirSva" data-bs-backdrop="static" tabindex="-1"
  aria-labelledby="modalExcluirSvaLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg rounded-4 bg-white">
      <div class="modal-header bg-danger bg-gradient text-white rounded-top-4">
        <h5 class="modal-title" id="modalExcluirSvaLabel">
          <i class="bi bi-trash3-fill me-2"></i> Confirmar Exclusão
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>
      <div class="modal-body">
        <form id="formExcluirSva" action="/request/Sva" method="delete" reload="cadSva">
          <input type="hidden" id="idExcluir" name="id_exclude">
          <div class="text-center py-4">
            <div class="mb-3">
              <i class="bi bi-exclamation-triangle-fill text-warning display-3"></i>
            </div>
            <h4 class="fw-bold" id="textoConfirmacaoExcluir">Tem certeza que deseja excluir este item?</h4>
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

<script>
  $('#imagem').on('change', function () {
    const file = this.files[0];

    if (file && file.type.startsWith('image/')) {
      const reader = new FileReader();
      reader.onload = function (e) {
        $('#previewImagem').attr('src', e.target.result).removeClass('d-none');
      };
      reader.readAsDataURL(file);
    } else {
      $('#previewImagem').attr('src', '').addClass('d-none');
    }
  });
</script>