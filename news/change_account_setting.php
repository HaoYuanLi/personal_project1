<!DOCTYPE html5>
<?php
require_once('./setting.php');
require_once('function/common_function.php');
if (!isset($_SESSION['login_user']) OR @$_SESSION['login_user']['stat'] === FALSE)
{
    header('Location:./login.php?msg=請先登入!!');
}
$common_function_object = new Common_function();
$login_user_information = $common_function_object->get_login_user_information();
$current_date = date('Y-m-d');
?>
<html lang="zh-TW" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>變更帳戶設定</title>
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
      <form method="POST" id="change_form">
        <div class="form-row">
            <div class="form-group col-xs-12 col-sm-6">
              <label for="username">您的帳號</label>
              <input onkeyup="value=value.replace(/[^\w\.\/]/ig,'')" type="text" class="form-control" name="username" id="username" value="<?php echo $login_user_information['username']; ?>"  readonly>
            </div>
            <div class="form-group col-xs-12 col-sm-6">
              <p>性別</p>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="M" <?php echo ($login_user_information['gender'] === 'M') ? 'checked' : ''; ?>>
                <label class="form-check-label" for="inlineRadio1">男性</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="F" <?php echo ($login_user_information['gender'] === 'F') ? 'checked' : ''; ?>>
                <label class="form-check-label" for="inlineRadio2">女性</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="T" <?php echo ($login_user_information['gender'] === 'T') ? 'checked' : ''; ?>>
                <label class="form-check-label" for="inlineRadio3">第三性</label>
              </div>
            </div>
            <div class="form-group col-xs-12 col-sm-6">
              <label for="password">新密碼</label>
              <input type="password" class="form-control" name="password" id="password" placeholder="請在此輸入新密碼,需包含8位元以上的英文.數字.符號,禁止使用中文" autofocus>
            </div>
            <div class="form-group col-xs-12 col-sm-6">
              <label for="birthday">生日</label>
              <input type="date" class="form-control" name="birthday" id="birthday" max="<?php echo $current_date; ?>" value="<?php echo (!is_null($login_user_information['birthday'])) ? $login_user_information['birthday'] : ''; ?>">
            </div>
            <div class="form-group col-xs-12 col-sm-6">
              <label for="confirm_password">確認新密碼</label>
              <input type="password" class="form-control" id="confirm_password" placeholder="請再次輸入新密碼">
            </div>
            <div class="form-group col-xs-12 col-sm-6">
              <label for="contact_number">聯絡電話</label>
              <input type="tel" class="form-control" name="contact_number" id="contact_number" placeholder="範例 : 室話 0211112222 手機 0959111222" maxlength="10" value="<?php echo (!is_null($login_user_information['contact_number'])) ? $login_user_information['contact_number'] : ''; ?>">
            </div>
        </div>
        <button style="margin-top:10px" type="submit" id="submit" class="btn btn-primary col col-sm-6 col-xs-12 offset-sm-3">確認修改</button>
      </form>
    </div>
  </div>
</div>
</body>
<?php require_once('./footer.php'); ?>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script>
let form_changed = false;
const current_date = new Date();
$(document).ready(function() {
  $('#change_form input').change(function() {
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

  $('#contact_number').keyup(function() {
    if ($(this).val().length > 0 && $(this).val().length < 10) {
      $(this).removeClass('is-valid').addClass('is-invalid');
    } else {
      if ($(this).val().length === 10) {
        $(this).removeClass('is-invalid').addClass('is-valid');
      } else {
        $(this).removeClass('is-invalid');
      }
    }
  })

  $('#birthday').keyup(function() {
    if ($(this).attr('class').indexOf('is-invalid') >= 0) {
      $(this).removeClass('is-invalid');
    }
  });

  $("#change_form").submit(function() {
    if ($('#birthday').val() !== '' && Date.parse($('#birthday').val()) > current_date) {
      alert('生日不可大於今天');
      $('#birthday').addClass('is-invalid');
    } else {
      if ($('#contact_number').val() !== '' && $('#contact_number').val().length < 10) {
        alert('聯絡電話長度至少要大於等於10字元');
      } else {
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
              if (form_changed === false) {
                alert('表單內容沒有更動,無法送出修改內容')
              } else {
                //整理資料,準備送出表單
                let password = null;
                if ($('#password').val().trim() !== '') {
                  password = $('#password').val().trim();
                }
                let gender = null;
                if (typeof $('input[name=inlineRadioOptions]:checked', '#change_form').val() !== 'undefined') {
                  gender = $('input[name=inlineRadioOptions]:checked', '#change_form').val().trim();
                }
                let birthday = null;
                if ($('#birthday').val() !== '') {
                  birthday = $('#birthday').val().trim();
                }
                let contact_number = null;
                if ($('#contact_number').val() !== '') {
                  contact_number = $('#contact_number').val().trim();
                }
                $.ajax({
                  type:'POST',
                  url:'ajax/edit_account_setting.php',
                  data:{
                    'password':password,
                    'gender':gender,
                    'birthday':birthday,
                    'contact_number':contact_number
                  },
                  dataType:'html'
                }).done(function(data) {
                  if (data === 'yes') {
                    alert('修改成功,跳轉至首面');
                    window.location.href = './index.php';
                  } else {
                    alert('修改失敗,請確認網路穩定性,若仍是無法成功,請聯絡系統管理員');
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
    }
    return false;
  });
});
</script>
</html>
