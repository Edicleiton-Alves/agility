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

    .border-primary-subtle {
        border-color: #002855 !important;
    }
</style>
<div class="modal fade" id="modalAddPlan" data-bs-backdrop="static" tabindex="-1" aria-labelledby="modalAddPlanLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form id="formPlano" action="/request/Plano" method="post" enctype="multipart/form-data" reload="cadastroPlan">
            <input type="hidden" name="id_plano" id="id_plano">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAddPlanLabel">Cadastrar Plano</h5>
                    <button type="button" class="btn-close fechMod" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <label for="nome_plan" class="form-label">Nome do Plano</label>
                            <input type="text" class="form-control" id="nome_plan" name="nome_plan" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="valor" class="form-label">Valor</label>
                            <input type="text" class="form-control" id="valor" name="valor" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="selecao_secao" class="form-label">Seção</label>
                            <select id="selecao_secao" name="selecao_secao" class="form-select secao_htsd" required>
                                <option value="" selected disabled>Selecione a seção</option>
                                <?php
                                $conDb = new Classes\ConDB;
                                $getPlan = (new Classes\Metodos($conDb))
                                    ->table('tb_sva')
                                    ->where('tipo_sva', '=', 'Seção')
                                    ->get();
                                foreach ($getPlan as $plan) {
                                    $encryptedId = (new Classes\Encrypt)->encrypt($plan->id);
                                    echo "<option value=\"{$encryptedId}\">{$plan->titulo}</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Benefícios</label>
                            <div class="border rounded p-2 border-primary-subtle benefi_htsd" style="max-height: 200px; overflow-y: auto;">
                                <?php
                                $getBenef = (new Classes\Metodos($conDb))
                                    ->table('tb_sva')
                                    ->where('tipo_sva', '=', 'Benefício')
                                    ->get();
                                foreach ($getBenef as $benef) {
                                    $encryptedId = (new Classes\Encrypt)->encrypt($benef->id);
                                    echo "
                                        <div class='form-check'>
                                            <input class='form-check-input' type='checkbox' name='beneficios[]' value='{$encryptedId}' id='benef_{$encryptedId}'>
                                            <label class='form-check-label' for='benef_{$encryptedId}'>{$benef->titulo}</label>
                                        </div>
                                    ";
                                }
                                ?>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Itens</label>
                            <div class="border rounded p-2 border-primary-subtle itens_htsd" style="max-height: 200px; overflow-y: auto;">
                                <?php
                                $getItens = (new Classes\Metodos($conDb))
                                    ->table('tb_sva')
                                    ->where('tipo_sva', '=', 'Item')
                                    ->get();
                                foreach ($getItens as $item) {
                                    $encryptedId = (new Classes\Encrypt)->encrypt($item->id);
                                    echo "
                                        <div class='form-check'>
                                            <input class='form-check-input' type='checkbox' name='itens[]' value='{$encryptedId}' id='item_{$encryptedId}'>
                                            <label class='form-check-label' for='item_{$encryptedId}'>{$item->titulo}</label>
                                        </div>
                                    ";
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary fechMod">Cancelar</button>
                    <button type="button" class="btn btn-agility salvar">Salvar</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="modalExcluirPlan" data-bs-backdrop="static" tabindex="-1"
    aria-labelledby="modalExcluirPlanLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 bg-white">
            <div class="modal-header bg-danger bg-gradient text-white rounded-top-4">
                <h5 class="modal-title" id="modalExcluirPlanLabel">
                    <i class="bi bi-trash3-fill me-2"></i> Confirmar Exclusão
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                <form id="formExcluirPlan" action="/request/Plano" method="delete" reload="cadastroPlan">
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
    var campoValor = document.getElementById('valor');
    campoValor.addEventListener('input', function() {
        var valor = this.value.replace(/\D/g, '');

        if (valor.length === 0) {
            this.value = '';
            return;
        }

        valor = (parseInt(valor) / 100).toFixed(2);

        this.value = new Intl.NumberFormat('pt-BR', {
            style: 'currency',
            currency: 'BRL'
        }).format(valor);
    });

    campoValor.addEventListener('blur', function() {
        if (!this.value.includes('R$')) {
            var valor = this.value.replace(/\D/g, '');
            if (valor.length > 0) {
                valor = (parseInt(valor) / 100).toFixed(2);
                this.value = new Intl.NumberFormat('pt-BR', {
                    style: 'currency',
                    currency: 'BRL'
                }).format(valor);
            }
        }
    });
</script>