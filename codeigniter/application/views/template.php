<!DOCTYPE html>
<html lang="PT-BR">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0">
    <title>Digital Solves Test</title>
    <meta name="description" content="Digital Solves Test">
    <meta name="robots" CONTENT="noindex, nofollow">
    <meta name="keywords"  content="" />
    <meta name="author" content="Giovan Dias">
    <meta name="theme-color" content="#66CAD5">
    <meta name="apple-mobile-web-app-status-bar-style" content="#66CAD5">
    <meta name="msapplication-navbutton-color" content="#66CAD5">

    <link rel="canonical" href="<?="https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];?>" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.2/css/all.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css?rand=<?=rand();?>" type="text/css" />
    <link rel="stylesheet" href="//cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css?rand=<?=rand();?>" type="text/css" />

    <link rel="stylesheet" href="<?= asset_url_css('style_geral.min.css'); ?>" media="print" onload="this.media='all'">


    <script>
        window.base_url = "<?=str_replace("index.php/", "", base_url());?>";
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

</head>
<body class="d-flex flex-column min-vh-100">

      <?php echo $contents;?>


  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
  <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
      <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" type="text/javascript"></script>
      <script src="//cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" type="text/javascript"></script>
      <script src="//cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js" type="text/javascript"></script>
      <script src="//cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js" type="text/javascript"></script>
      <script src="<?= asset_url_js('jquery.validate.min.js'); ?>"></script>
      <script src="<?= asset_url_js('scripts.js'); ?>"></script>


      <?php if($this->session->flashdata('error')):
          $errors = $this->session->flashdata('error');
      if(is_array($errors)):
      foreach ($errors as $erro): ?>
          <script>
              $(document).ready(function () {
                  alert("<?php echo $erro ?>")
              });
          </script>
      <?php endforeach; ?>
      <?php else: ?>
          <script>
              $(document).ready(function () {
                  alert("<?php echo $errors ?>")
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
                  alert("<?php echo $info ?>")
              });
          </script>
      <?php endforeach; ?>
      <?php else: ?>
          <script>
              $(document).ready(function () {
                  alert("<?php echo $infos ?>")
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
                  alert("<?php echo $success ?>")
              });
          </script>
      <?php endforeach; ?>
      <?php else: ?>
          <script>
              $(document).ready(function () {
                  alert("<?php echo $successs ?>")
              });
          </script>
      <?php endif; ?>
          <?php $this->session->unset_userdata('success');
      endif ?>

</body>