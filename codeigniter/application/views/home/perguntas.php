<div class="container h-100 d-block my-auto">
    <section class="w-100 p-3 p-lg-4 my-3 my-lg-4 border h-100">
        <?php if($this->session->flashdata('error')):
            $errors = $this->session->flashdata('error'); ?>
            <div class="row">
                <div class="col">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php if(is_array($errors)):
                foreach ($errors as $erro): ?>
                    <p class="mb-0">- <?php echo $erro ?></p>
                <?php endforeach; ?>
            <?php else: ?>
                <span>- <?php echo $errors ?></span>
            <?php endif; ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
                </div>
            </div>
            <?php
        elseif($this->session->flashdata('info')):
            $infos = $this->session->flashdata('info'); ?>
            <div class="row">
                <div class="col">
            <div class="alert alert-info alert-dismissible fade show" role="alert">
            <?php if(is_array($infos)):
            foreach ($infos as $info): ?>
                <p class="mb-0">- <?php echo $info ?></p>
            <?php endforeach; ?>
            <?php else: ?>
                <span>- <?php echo $infos ?></span>
            <?php endif; ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
                </div>
            </div>
        <?php  elseif($this->session->flashdata('success')):
            $successs = $this->session->flashdata('success'); ?>
            <div class="row">
                <div class="col">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php if(is_array($successs)):
            foreach ($successs as $success): ?>
                <p class="mb-0">- <?php echo $success ?></p>
            <?php endforeach; ?>
            <?php else: ?>
                <span>- <?php echo $successs ?></span>
            <?php endif; ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
                </div>
            </div>
        <?php endif ?>
        <div class="row">
            <div class="col-12">
                <?php if(isset($arrPerguntas) && $arrPerguntas instanceof PropelCollection && count($arrPerguntas) > 0): ?>
                    <form class="form form-disabled-on-load" id="form-pergunta" method="post" action="<?php echo base_url('sistema/perguntas')?>">
                        <?php
                        $contPergunta = 1;
                        foreach($arrPerguntas as $objPergunta): /** @var $objPergunta Perguntas */ ?>
                            <div class="form-row">
                                <div class="mb-3 col form-group">
                                    <label for="pergunta-<?php echo $objPergunta->getId() ?>" class="form-label h5">
                                        <?php echo $objPergunta->getPergunta() ?></label>
                                    <div class="form-check form-check-group mt-2 pl-0">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="pergunta-<?php echo $objPergunta->getId() ?>"
                                                   required id="pergunta-<?php echo $objPergunta->getId() ?>-sim" value="1">
                                            <label class="form-check-label" for="pergunta-<?php echo $objPergunta->getId() ?>-sim">Sim</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="pergunta-<?php echo $objPergunta->getId() ?>"
                                                   required id="pergunta-<?php echo $objPergunta->getId() ?>-nao" value="0">
                                            <label class="form-check-label" for="pergunta-<?php echo $objPergunta->getId() ?>-nao">Não</label>
                                        </div>
                                    </div>
                                    <hr class="mt-3 mb-0">
                                </div>
                            </div>
                        <?php
                            $contPergunta++;
                        endforeach; ?>
                        <div class="form-row">
                            <div class="mb-0 col form-group d-flex justify-content-center">
                                <button type="submit" id="form-submitting" class="btn btn-success">Enviar respostas</button>
                            </div>
                        </div>
                    </form>
                <?php else: ?>
                    <h2 class="h2 text-muted">
                        Nenhuma pergunta cadastrada.
                    </h2>
                <?php endif; ?>
            </div>
        </div>

</section>
</div>