<div class="col-md-12">
    <h5 class="text-center">SVA/Painéis Cadastrados</h5>
    <div class="rounded-3 p-1 border shadow-boxes">
        <div class="d-flex justify-content-end">
            <div class="my-2">
                <input type="text" name="search" class="form-control shadow-sm search" data-search="data-info" placeholder="Pesquisar">
            </div>
            <div class="my-2 mx-2">
                <button id="addSva" modal-target="#modalAddSva" class="modalAddSva btn btn-success rounded-3 shadow-sm"><i class="text-success bi bi-plus-lg text-white"></i></button>
            </div>
        </div>
        <div class="overflow-auto d-none d-lg-block">
            <table class="table table-striped mw-mc mb-0 text-center align-middle">
                <thead class="position-sticky top-0 z-2 shadow-sm">
                    <tr>
                        <th class="col">Titulo</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Data Criação</th>
                        <th scope="col">Opções</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $conDb = new Classes\ConDB;
                    $getSva = new Classes\Metodos($conDb);

                    $getSva = $getSva
                        ->table('tb_sva')
                        ->get();

                    foreach ($getSva as $sva) {
                    ?>
                        <tr class="fst-italic data-info">
                            <th class="fw-semibold"><?= $sva->titulo ?></th>
                            <td><?= $sva->tipo_sva ?></td>
                            <td><?= (new DateTime($sva->data_cadastro))->format('d/m/Y \à\s H:i') ?></td>
                            <td>
                                <button data-id="<?php echo (new Classes\Encrypt)->encrypt($sva->id); ?>" modal-target="#modalAddSva" class="modalEditSva p-3 position-relative rounded-circle btn btn-primary">
                                    <i class="position-absolute top-50 start-50 translate-middle bi bi-pencil"></i>
                                </button>
                                <button data-id="<?php echo (new Classes\Encrypt)->encrypt($sva->id); ?>" modal-target="#modalExcluirSva" class="excluirSva p-3 position-relative rounded-circle btn btn-danger">
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
require_once 'Modais/Modal_SVA.php';
?>
<script type="text/javascript">
    $('.search').on('keyup', function() {
        let input = $(this).val().toLowerCase();
        let data_search = $(this).attr('data-search');
        search(input, data_search);
    });

    $('.modalAddSva').click(function() {
        let modal = $(this).attr('modal-target');
        $(modal + ' .modal-title').text('Cadastrar SVA/Painel');
        $(modal + ' form').attr('action', '/request/Sva');
        $(modal + ' form').attr('method', 'post');
        $(modal + ' .salvar').val('Salvar');
        $(modal + ' form')[0].reset();
        $(modal).modal('show');
    });

    $('#tipo_sva').on('change', function() {
        let valor = $(this).val();
        if (valor === 'Benefício' || valor === 'Plano') {
            $('#campoImagem').removeClass('d-none');
        } else {
            $('#campoImagem').addClass('d-none');
            $('#imagem').val('');
        }
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

    $('.excluirSva').click(function() {
        let modal = $(this).attr('modal-target');
        let id = $(this).attr('data-id');
        $(modal + ' #idExcluir').val(id);
        $(modal).modal('show');
    });

    $('.modalEditSva').click(function() {
        let modal = $(this).attr('modal-target');
        let id = $(this).attr('data-id');
        let action = $(modal + ' form').attr('action');
        $(modal + ' .modal-title').text('Editar SVA/Painel');
        $(modal + ' form').attr('method', 'post');
        $(modal + ' form').attr('action', '/altera/Sva');
        $(modal + ' .salvar').val('Alterar');
        $(modal + ' #campoImagem').addClass('d-none');
        $(modal + ' form')[0].reset();
        $(modal + ' #edit').val(id);
        let data = envForm.get('/request/Sva', id);
        if (data.status == 'success') {

            $(modal + ' #titulo').val(data.titulo ?? '');
            $(modal + ' #tipo_sva').val(data.tipo_sva ?? '');

            if (data.imagem) {
                $(modal + ' #previewImagem')
                    .attr('src', data.imagem)
                    .removeClass('d-none');
                $(modal + ' #campoImagem').removeClass('d-none');
            } else {
                $(modal + ' #previewImagem').addClass('d-none').attr('src', '');
            }

            $(modal).modal('show');
        } else {
            toast('erro', 'Erro ao consultar os dados');
        }
    });
</script>