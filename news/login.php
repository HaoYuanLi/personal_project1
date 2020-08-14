<!DOCTYPE html5>
<?php
require_once('function/common_function.php');
if (isset($_SESSION['login_user']) && $_SESSION['login_user']['stat'] === TRUE)
{
    header('Location:index.php');
}
?>
<html lang="zh-TW" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>登入</title>
  <meta name="description" content="News新聞網,最即時要聞!">
  <meta name="author" content="黎濠源">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <link rel="shortcut icon" href="files/bulb-curvy-flat.ico">
  <link rel="stylesheet" href="./css/style.css">
</head>
<body>
<div class="main" style="padding-top:150px;">
  <div class="container">
    <div class="row">
      <div class="col col-sm-6 col-xs-12 offset-sm-3">
        <form method="POST" id="login_form">
          <h1 style="text-align:center;">會員登入</h1>
          <div class="form-group">
            <label for="username">帳號</label>
            <input type="text" class="form-control" id="username" placeholder="請在此輸入帳號" onkeyup="value=value.replace(/[^\w\.\/]/ig,'')" autofocus required>
          </div>
          <div class="form-group">
            <label for="password">密碼</label>
            <input type="password" class="form-control" id="password" placeholder="請在此輸入密碼" required>
          </div>
          <button type="submit" class="btn btn-primary col col-sm-6 col-xs-12 offset-sm-3">登入</button>
        </form>
      </div>
    </div>
  </div>
</div>
</body>
<?php require_once('footer.php'); ?>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script>
$(document).ready(function() {
  $('#login_form').submit(function() {
    $.ajax({
      type:'POST',
      url:'ajax/verify_user.php',
      data:{
        'username':$('#username').val(),
        'password':$('#password').val()
      },
      dataType:'json'
    }).done(function(data) {
      if (data === 'yes') {
        if (location.search !== '') {
          alert('登入成功,返回原頁');
          window.history.go(-1);
        } else {
          alert('登入成功,返回首頁');
          window.location.href = 'index.php';
        }
      } else if (data === 'no') {
        alert('登入失敗,請確認帳號.密碼是否正確');
      } else {
        alert('尚未完成驗證,跳轉至驗證頁面');
        window.location.href = 'validate.php?nickname=' + data['nickname'] + '&email_address=' + data['email_address'];
      }
    }).fail(function(jqXHR,textStatus,errorthrown) {
      alert('有錯誤產生,請查看console log');
      console.log(jqXHR.responseText);
    });
    return false;
  });
});
</script>
</html>
