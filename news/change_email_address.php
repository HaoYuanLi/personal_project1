<!DOCTYPE html5>
<?php
require_once('./setting.php');
require_once('function/common_function.php');
$common_function_object = new Common_function();
$validation_code = $common_function_object->inspect_user_validation($_GET['nickname'], $_GET['email_address']);
?>
<html lang="zh-TW" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>更改電子郵件地址</title>
  <meta name="description" content="News新聞網,最即時要聞!">
  <meta name="author" content="黎濠源">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <link rel="shortcut icon" href="files/bulb-curvy-flat.ico">
</head>
<?php require_once('./menu.php'); ?>
<body>
<div class="main">
  <div class="container">
    <div class="row">
      <div class="col">
        <div style="text-align:center;">
          <p><?php echo $_GET['nickname'].' 先生/小姐,您好'; ?></p>
          <p><?php echo '舊電子郵件地址 : '.$_GET['email_address']; ?></p>
          <a href="<?php echo './validate.php?'.explode('?' ,$_SERVER['REQUEST_URI'])[1] ?>" class="btn btn-primary">返回認證頁面</a>
          <form id="change_email_address_form">
            <div class="form-group">
              <label style="margin:0 auto;font-weight:bold;font-size:20px;margin-top:15px;" for="email_address">新電子郵件地址</label>
              <input type="email" class="form-control col-xs-12 col-sm-6 offset-xs-6 offset-sm-3" name="email_address" id="email_address" style="margin-top:15px;" placeholder="請輸入您擁有的信箱,稍後會用該信箱來認證" autofocus required>
            </div>
            <button type="submit" style="margin-top:15px;" class="btn btn-info">送出</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
<?php require_once('./footer.php'); ?>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script>
$(document).ready(function() {
  $('#email_address').keyup(function() {
    if ($(this).attr('class').indexOf('is-invalid') >= 0) {
      $(this).removeClass('is-invalid');
    }
  });

  $('#change_email_address_form').submit(function() {
    if ($('#email_address').val().trim() === '') {
      alert('新電子郵件地址欄位不可留白');
      $('#email_address').addClass('is-invalid');
    } else {
      if ($('#email_address').val().indexOf('@') === -1 || $('#email_address').val().indexOf('.com') === -1 || $('#email_address').val().indexOf('@.com') > -1) {
        alert('請輸入格式正確的電子郵件地址');
        $('#email_address').addClass('is-invalid');
      } else {
        $.ajax({
          type:'POST',
          url:'ajax/verify_email_address.php',
          data:{ 'email_address':$('#email_address').val().trim() },
          dataType:'html'
        }).done(function(data) {
          if (data === 'yes') {
            alert('此電子郵件地址已有人註冊過,請更換');
            $('#email_address').addClass('is-invalid');
          } else {
            $.ajax({
              type:'POST',
              url:'ajax/edit_email_address.php',
              data:{
                'nickname':'<?= $_GET['nickname']; ?>',
                'email_address':$('#email_address').val().trim()
              },
              dataType:'html'
            }).done(function(data) {
              if (data === 'yes') {
                alert('更改成功,跳轉至驗證頁面');
                window.location.href = './validate.php' + location.search.split('&')[0] + '&email_address=' + $('#email_address').val().trim();
              } else {
                alert('更改失敗,請確認網路穩定性,若仍無法成功註冊,請聯絡工程人員');
              }
            }).fail(function(jqXHR,textStatus,errorthrown) {
              alert('有錯誤產生,請查看console log');
              console.log(jqXHR.responseText);
            });
          }
        });
        return false;
      }
    }
  });
});
</script>
</html>
