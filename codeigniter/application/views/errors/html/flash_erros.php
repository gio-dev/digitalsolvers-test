<?php if($this->session->flashdata('error')):
    $errors = $this->session->flashdata('error');
    if(is_array($errors)):
        foreach ($errors as $erro): ?>
            <script>
                $(document).ready(function () {
                    notifyIziError("<?php echo $erro ?>")
                });
            </script>
        <?php endforeach; ?>
    <?php else: ?>
        <script>
            $(document).ready(function () {
                notifyIziError("<?php echo $errors ?>")
            });
        </script>
    <?php endif; ?>
    <?php $this->session->unset_userdata('error');
elseif($this->session->flashdata('info')):
    $infos = $this->session->flashdata('info');
    if(is_array($infos)):
        foreach ($infos as $info): ?>
            <script>
                $(document).ready(function () {
                    notifyIziInfo("<?php echo $info ?>")
                });
            </script>
        <?php endforeach; ?>
    <?php else: ?>
        <script>
            $(document).ready(function () {
                notifyIziInfo("<?php echo $infos ?>")
            });
        </script>
    <?php endif; ?>
    <?php $this->session->unset_userdata('info');
elseif($this->session->flashdata('success')):
    $successs = $this->session->flashdata('success');
    if(is_array($successs)):
        foreach ($successs as $success): ?>
            <script>
                $(document).ready(function () {
                    notifyIziSuccess("<?php echo $success ?>")
                });
            </script>
        <?php endforeach; ?>
    <?php else: ?>
        <script>
            $(document).ready(function () {
                notifyIziSuccess("<?php echo $successs ?>")
            });
        </script>
    <?php endif; ?>
    <?php $this->session->unset_userdata('success');
endif ?>