<!DOCTYPE html5>
<?php
require_once('../setting.php');
require_once('../function/common_function.php');
$common_function_object = new Common_function();
$designated_user_array = $common_function_object->get_designated_user($_GET['id']);
?>
<html lang="zh-TW" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>使用者資料更改</title>
  <meta name="description" content="news新聞網,最即時要聞!">
  <meta name="author" content="黎濠源">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <link rel="shortcut icon" href="../files/bulb-curvy-flat.ico">
</head>
<?php require_once('./menu.php'); ?>
<body>
<div class="main">
  <div class="container">
    <div class="row">
      <div class="col col-sm-6 col-xs-12 offset-sm-3">
        <p class="badge badge-secondary">id <?php echo $designated_user_array['id']; ?></p>
        <form method="POST" id="edit_form">
          <div class="form-group">
            <label for="username">帳號</label>
            <input onkeyup="value=value.replace(/[^\w\.\/]/ig,'')" type="text" class="form-control" name="text" id="username" value="<?php echo $designated_user_array['username']; ?>" required disabled>
          </div>
          <div class="form-group">
            <label for="password">新密碼</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="請在此輸入新密碼,需包含8位元以上的英文.數字.符號,禁止使用中文">
          </div>
          <div class="form-group">
            <label for="confirm_password">確認新密碼</label>
            <input type="password" class="form-control" id="confirm_password" placeholder="請再次輸入新密碼">
          </div>
          <div class="form-group" id="raio_group">
            <span><span style="color:red;">*</span>管理權限</span>
            <label class="form-check-label" for="inlineRadio1" style="margin:0 20px 0 10px;">有</label>
            <input class="form-check-input" type="radio" name="management" id="inlineRadio1" value="1" <?php echo ($designated_user_array['manager'] === 1) ? 'checked' : ''; ?>>
            <label class="form-check-label" for="inlineRadio2" style="margin-right:25px;">無</label>
            <input class="form-check-input" type="radio" name="management" id="inlineRadio2" value="0" <?php echo ($designated_user_array['manager'] === 0) ? 'checked' : ''; ?>>
          </div>
          <button type="submit" class="btn btn-primary col col-sm-6 col-xs-12 offset-sm-3">確認更改</button>
        </form>
      </div>
    </div>
  </div>
</div>
</body>
<?php require_once('./footer.php'); ?>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script>
let form_changed = false;
$(document).ready(function() {
  $('#edit_form input').change(function() {
    form_changed = true;
  });

  $('#password').keyup(function() {
    if ($(this).val().length < 8) {
      $(this).removeClass('is-valid').addClass('is-invalid');
    } else {
      $(this).removeClass('is-invalid').addClass('is-valid');
    }
  });

  $('#confirm_password').keyup(function() {
    if ($(this).val() !== $('#password').val()) {
      $(this).removeClass('is-valid').addClass('is-invalid');
    } else {
      $(this).removeClass('is-invalid').addClass('is-valid');
    }
  });

  $('#edit_form').submit(function() {
    if ($('#password').val() !== '' && $('#password').val().length < 8) {
      alert('密碼長度不可少於8字元');
      $('#password').removeClass('is-valid').addClass('is-invalid');
    } else {
      if ($('#confirm_password').val() !== '' && $('#confirm_password').val().length < 8) {
        alert('確認密碼長度不可少於8字元');
        $('#confirm_password').removeClass('is-valid').addClass('is-invalid');
      } else {
        if (($('#password').val() !== '' || $('#confirm_password').val() !== '') && $('#password').val() !== $('#confirm_password').val()) {
          alert('密碼和確認密碼兩個欄位值不相同');
        } else {
          if ($("input[name='management']:checked").val() === undefined) {
            alert('請勾選有無權限');
            $('#raio_group').css('color', 'red');
          } else {
            if (form_changed === false) {
              alert('表單內容沒有更動,無法送出修改內容')
            } else {
              $.ajax({
                type:'POST',
                url:'../ajax/edit_user.php',
                data:{
                  'id':<?= $_GET['id']; ?>,
                  'password':$('#password').val(),
                  'management':$("input[name='management']:checked").val()
                },
                dataType:'html'
              }).done(function(data) {
                if (data === 'yes') {
                  alert('更改成功');
                  window.location.href='user_list.php';
                } else {
                  alert('更改失敗,請確認網路是否穩定,若仍是無法成功,請聯繫系統管理員');
                }
              }).fail(function(jqXHR,textStatus,errorthrown) {
                alert('有錯誤產生,請查看console log');
                console.log(jqXHR.responseText);
              });
            }
          }
        }
      }
    }
  return false;
  });
});
</script>
</html>
