<?php ?>
<article class="page-head m-3">
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="page-heading d-flex flex-row justify-content-between">

                <h2><?php echo $titulo ?></h2>
                <?php if($botao == 'add'): ?>
                    <a href="<?php echo base_url().'cadastro' ?>" title="Adicionar novo" class="btn btn-primary btn" >
                        <i class="fas fa-plus-circle d-inline-block"></i>  <span class="d-none d-md-inline-block">Adicionar novo</span>
                    </a>
                <?php elseif ($botao == 'back'): ?>
                    <a href="<?php echo base_url() ?>" title="Adicionar novo" class="btn btn-default btn" >
                        <i class="fas fa-arrow-alt-circle-left d-inline-block"></i>  <span class="d-none d-md-inline-block">Voltar</span>
                    </a>
                <?php endif; ?>


            </div>
        </div>
    </div>
</div>
</article>