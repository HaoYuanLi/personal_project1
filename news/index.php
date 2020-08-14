<!DOCTYPE html5>
<?php require_once('./setting.php'); ?>
<html lang="zh-TW" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>News新聞網 入口網站</title>
  <meta name="description" content="News新聞網,最即時要聞!">
  <meta name="author" content="黎濠源">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <link rel="shortcut icon" href="files/bulb-curvy-flat.ico">
</head>
<?php require_once('./menu.php'); ?>
<body>
<?php
if (isset($_GET['msg'])) {
    $message = $_GET['msg'];
    echo "<script type='text/javascript'>alert('$message');</script>";
}
?>
<div class="main">
  <div class="container">
    <div class="row">
      <div class="col">
        <div class="alert alert-success" role="alert">歡迎來到News 新聞網</div>
      </div>
    </div>
  </div>
</div>
</body>
<?php require_once('./footer.php'); ?>
</html>
