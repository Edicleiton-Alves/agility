<div class="col-md-12">
    <h5 class="text-center">Planos Cadastrados</h5>
    <div class="rounded-3 p-1 border shadow-boxes">
        <div class="d-flex justify-content-end">
            <div class="my-2">
                <input type="text" name="search" class="form-control shadow-sm search" data-search="data-plan" placeholder="Pesquisar">
            </div>
            <div class="my-2 mx-2">
                <button id="addPlan" modal-target="#modalAddPlan" class="modalAddPlan btn btn-success rounded-3 shadow-sm"><i class="text-success bi bi-plus-lg text-white"></i></button>
            </div>
        </div>
        <div class="overflow-auto d-none d-lg-block">
            <table class="table table-striped mw-mc mb-0 text-center align-middle">
                <thead class="position-sticky top-0 z-2 shadow-sm">
                    <tr>
                        <th class="col">Nome</th>
                        <th scope="col">Valor(R$)</th>
                        <th scope="col">Seção</th>
                        <th scope="col">Data Criação</th>
                        <th scope="col">Opções</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $conDb = new Classes\ConDB;
                    $getPlan = new Classes\Metodos($conDb);

                    $getPlan = $getPlan
                        ->table('tb_planos')
                        ->get();

                    foreach ($getPlan as $plan) {

                        $getPlanSva = new Classes\Metodos($conDb);

                        $getPlanSva = $getPlanSva
                            ->table('tb_sva_plan')
                            ->select('id_sva, tipo_plano')
                            ->where('id_plano', '=', $plan->id)
                            ->get();

                        $section = '';

                        foreach ($getPlanSva as $planSva) {
                            if ($planSva->tipo_plano == 'Seção') {
                                $getSva = new Classes\Metodos($conDb);

                                $getSva = $getSva
                                    ->table('tb_sva')
                                    ->select('titulo')
                                    ->where('id', '=', $planSva->id_sva)
                                    ->get();

                                $section = $getSva[0]->titulo;
                            }
                        }

                    ?>
                        <tr class="fst-italic data-plan">
                            <th class="fw-semibold"><?= $plan->nome_plan ?></th>
                            <td><?= 'R$ ' . number_format($plan->valor, 2, ',', '.') ?></td>
                            <th><?= $section ?></th>
                            <td><?= (new DateTime($plan->data_cadastro))->format('d/m/Y \à\s H:i') ?></td>
                            <td>
                                <button data-id="<?php echo (new Classes\Encrypt)->encrypt($plan->id); ?>" modal-target="#modalAddPlan" class="modalEditPlan p-3 position-relative rounded-circle btn btn-primary">
                                    <i class="position-absolute top-50 start-50 translate-middle bi bi-pencil"></i>
                                </button>
                                <button data-id="<?php echo (new Classes\Encrypt)->encrypt($plan->id); ?>" modal-target="#modalExcluirPlan" class="excluirPlan p-3 position-relative rounded-circle btn btn-danger">
                                    <i class="position-absolute top-50 start-50 translate-middle bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
require_once 'Modais/Modal_Planos.php';
?>
<script type="text/javascript">
    $('.search').on('keyup', function() {
        let input = $(this).val().toLowerCase();
        let data_search = $(this).attr('data-search');
        search(input, data_search);
    });

    $('.modalAddPlan').click(function() {
        let modal = $(this).attr('modal-target');
        $(modal + ' .modal-title').text('Cadastrar Plano');
        $(modal + ' form').attr('method', 'post');
        $(modal + ' .salvar').val('Salvar');
        $(modal + ' form')[0].reset();
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
                $('#nav-' + reload).html('<div class="d-flex vh-60"><div class="m-auto spinner-border text-warning" role="status" style="width: 6rem; height: 6rem;"></div></div>').off().load('/load/' + reload);

            } else {
                $(this).removeClass('disabled').html(btnSubmitText);
                toast(dados.status, dados.msg);
            }
        }, 50);
    });

    $('.fechMod').click(function() {
        let formId = $('.modal.show form').attr('id');
        let form = document.getElementById(formId);
        let reload = $(form).attr('reload');
        let modal = '#' + $('.modal.show').attr('id');
        $(modal).modal('hide');
        $('#nav-' + reload).html('<div class="d-flex vh-60"><div class="m-auto spinner-border text-warning" role="status" style="width: 6rem; height: 6rem;"></div></div>').off().load('/load/' + reload);
    });

    $('.excluirPlan').click(function() {
        let modal = $(this).attr('modal-target');
        let id = $(this).attr('data-id');
        $(modal + ' #idExcluir').val(id);
        $(modal).modal('show');
    });

    $('.modalEditPlan').click(function() {
        let modal = $(this).attr('modal-target');
        let id = $(this).attr('data-id');
        let action = $(modal + ' form').attr('action');
        $(modal + ' .modal-title').text('Editar Plano');
        $(modal + ' form').attr('method', 'put');
        $(modal + ' .salvar').val('Alterar');
        $(modal + ' form')[0].reset();
        $(modal + ' #id_plano').val(id);
        let data = envForm.get(action, id);
        if (data.status == 'success') {

            $(modal + ' #nome_plan').val(data.nome_plan ?? '');
            $(modal + ' #valor').val(data.valor ?? '');
            $(modal + ' .secao_htsd').html(data.secao_html);
            $(modal + ' .benefi_htsd').html(data.benef_html);
            $(modal + ' .itens_htsd').html(data.itens_html);

            $(modal).modal('show');
        } else {
            toast('erro', 'Erro ao consultar os dados');
        }
    });
</script>