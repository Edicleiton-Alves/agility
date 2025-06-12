<div class="row">
    <div class="col-auto col-md-6 d-flex">
        <h4 class="my-auto"><i class="bi bi-file-earmark-spreadsheet-fill"></i> Planos</h4>
    </div>
    <div class="position-sticky top-0 z-1 bg-body my-3">
        <div class="overflow-x-auto overflow-y-hidden pb-1">
            <div class="nav nav-tabs mw-mc" id="nav-tab" role="tablist">
                <button data-load="tabs" data-content="cadastroPlan" class="nav-link active" id="nav-cadastroPlan-tab" data-bs-toggle="tab" data-bs-target="#nav-cadastroPlan" type="button" role="tab" aria-controls="nav-cadastroPlan" aria-selected="true">Planos</button>

				<button data-load="tabs" data-content="cadSva" class="nav-link" id="nav-cadSva-tab" data-bs-toggle="tab" data-bs-target="#nav-cadSva" type="button" role="tab" aria-controls="nav-cadSva" aria-selected="true">Painéis e SVA</button>
            </div>
        </div>
    </div>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-cadastroPlan" role="tabpanel" aria-labelledby="nav-cadastroPlan-tab" tabindex="0">
            <?php require_once 'Cadastro_Plano.php'; ?>
        </div>
		<div class="tab-pane fade" id="nav-cadSva" role="tabpanel" aria-labelledby="nav-cadSva-tab" tabindex="0">
            <div class="d-flex vh-60">
                <div class="m-auto spinner-border text-warning" role="status" style="width: 6rem; height: 6rem;">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    'use strict';
    $('[data-load="tabs"]').click(function() {
        let page = $(this).attr('data-content');
        $('#nav-' + page).html('<div class="d-flex vh-60"><div class="m-auto spinner-border text-warning" role="status" style="width: 6rem; height: 6rem;"></div></div>').off().load('/load/' + page);
    });
</script>