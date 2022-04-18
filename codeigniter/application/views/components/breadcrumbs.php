<?php //if(isset($breadcrumbs)):?>
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <ol class="breadcrumb">
                        <?php
                        $qtd = count($breadcrumbs);
                        $count = 1;
                        foreach ($breadcrumbs as $breadcrumb => $link): ?>
                            <li class="breadcrumb-item<?php $count == $qtd ? ' actove' : '' ?>"
                                <?php $count == $qtd ? ' aria-current="page"' : '' ?>>
                                <?php if($count < $qtd): ?>
                                    <a href="<?php echo $link ?>">
                                <?php endif; ?>
                                        <?php echo $breadcrumb ?>
                                <?php if($count < $qtd): ?>
                                    </a>
                                <?php endif; ?>
                            </li>
                        <?php
                            $count++;
                        endforeach; ?>

                    </ol>
                </div>
            </div>
        </div>
    </nav>

<?php //endif; ?>

