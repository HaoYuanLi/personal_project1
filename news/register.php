<!DOCTYPE html5>
<?php
require_once('./setting.php');
require_once('function/common_function.php');
if (isset($_SESSION['login_user']) && $_SESSION['login_user']['stat'] === TRUE)
{
    header('Location:./index.php');
}
$current_date = date('Y-m-d');
?>
<html lang="zh-TW" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>註冊</title>
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
      <form method="POST" id="register_form">
        <div class="form-row">
          <div class="form-group col-xs-12 col-sm-6">
            <p>性別</p>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="M">
              <label class="form-check-label" for="inlineRadio1">男性</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="F">
              <label class="form-check-label" for="inlineRadio2">女性</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="T">
              <label class="form-check-label" for="inlineRadio3">第三性</label>
            </div>
          </div>
          <div class="form-group col-xs-12 col-sm-6">
            <label for="birthday">生日</label>
            <input type="date" class="form-control" name="birthday" id="birthday" max="<?php echo $current_date; ?>">
          </div>
          <div class="form-group col-xs-12 col-sm-6">
            <label for="contact_number">聯絡電話</label>
            <input type="tel" class="form-control" name="contact_number" id="contact_number" placeholder="範例 : 室話 0211112222 手機 0959111222" maxlength="10">
          </div>
          <div class="form-group col-xs-12 col-sm-6">
            <label for="email_address"><span style="color:red;">*</span>電子郵件地址</label>
            <input type="email" class="form-control" name="email_address" id="email_address" placeholder="請在此輸入您擁有的信箱,稍後會用該信箱來認證" required autofocus>
          </div>
          <div class="form-group col-xs-12 col-sm-6">
            <label for="username"><span style="color:red;">*</span>帳號</label>
            <input onchange="value=value.replace(/[^\w\.\/]/ig,'')" type="text" class="form-control" name="username" id="username" placeholder="請在此輸入帳號,需包含8位元以上的英文.數字.符號,禁止使用中文" required>
          </div>
          <div class="form-group col-xs-12 col-sm-6">
            <label for="password"><span style="color:red;">*</span>密碼</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="請在此輸入密碼,需包含8位元以上的英文.數字.符號,禁止使用中文" required>
          </div>
          <div class="form-group col-xs-12 col-sm-6">
            <label for="confirm_password"><span style="color:red;">*</span>確認密碼</label>
            <input type="password" class="form-control" id="confirm_password" placeholder="請在此輸入確認密碼" required>
          </div>
          <div class="form-group col-xs-12 col-sm-6">
            <label for="name"><span style="color:red;">*</span>暱稱</label>
            <input type="text" class="form-control" name="nickname" id="nickname" placeholder="請在此輸入暱稱,無任何限制,但不可再做修改" required>
          </div>
        </div>
        <div style="text-align:center;">
          <button style="margin-top:30px;" type="submit" class="btn btn-info" id="submit" style="margin:auto 0;">確認註冊</button>
      </div>
      </form>
    </div>
  </div>
</div>
</body>
<?php require_once('./footer.php'); ?>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script>
const current_date = new Date();
$(document).ready(function() {
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

  $('#email_address').keyup(function() {
    if ($(this).attr('class').indexOf('is-invalid') >= 0) {
      $(this).removeClass('is-invalid');
    }
  });

  $('#username').keyup(function() {
    if ($(this).val().length < 8) {
      $(this).removeClass('is-valid').addClass('is-invalid');
    } else {
      $(this).removeClass('is-invalid').addClass('is-valid');
    }
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

  $('#nickname').keyup(function() {
    if ($(this).attr('class').indexOf('is-invalid') >= 0) {
      $(this).removeClass('is-invalid');
    }
  });

  $('#register_form').submit(function() {
    if ($('#birthday').val() !== '' && Date.parse($('#birthday').val()) > current_date) {
      alert('生日不可大於今天');
      $('#birthday').addClass('is-invalid');
    } else {
      if ($('#contact_number').val() !== '' && $('#contact_number').val().length < 10) {
        alert('聯絡電話長度至少要大於等於10字元');
      } else {
        if ($('#email_address').val().trim() === '') {
          alert('電子郵件地址欄位不可留白');
          $('#email_address').addClass('is-invalid');
        } else {
          if ($('#email_address').val().indexOf('@') === -1 || $('#email_address').val().indexOf('.com') === -1 || $('#email_address').val().indexOf('@.com') > -1) {
            alert('請輸入格式正確的電子郵件地址');
            $('#email_address').addClass('is-invalid');
          } else {
            //檢查電子郵件地址是否存在
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
                if ($('#username').val().length < 8) {
                  alert('帳號長度不可少於8字元');
                  $('#username').removeClass('is-valid').addClass('is-invalid');
                } else {
                  //檢查帳號是否存在
                  $.ajax({
                    type:'POST',
                    url:'ajax/verify_username.php',
                    data:{ 'username': $('#username').val() },
                    dataType:'html'
                  }).done(function(data) {
                    if (data === 'yes') {
                      alert('此帳號已有人註冊過,請更換');
                      $('#username').removeClass('is-valid').addClass('is-invalid');
                    } else {
                      if ($('#password').val().length < 8) {
                        alert('密碼長度不可少於8字元');
                        $('#password').removeClass('is-valid').addClass('is-invalid');
                      } else {
                        if ($('#confirm_password').val().length < 8) {
                          alert('確認密碼長度不可少於8字元');
                          $('#confirm_password').removeClass('is-valid').addClass('is-invalid');
                        } else {
                          if ($('#password').val() !== $('#confirm_password').val()) {
                            alert('密碼和確認密碼兩個欄位值不相同');
                          } else {
                            if ($('#nickname').val().trim() === '') {
                              alert('暱稱欄位不可留白');
                              $('#nickname').addClass('is-invalid');
                            } else {
                              //檢查暱稱是否存在
                              $.ajax({
                                type:'POST',
                                url:'ajax/verify_nickname.php',
                                data:{ 'nickname': $('#nickname').val() },
                                dataType:'html'
                              }).done(function(data) {
                                if (data === 'yes') {
                                  alert('此暱稱已有人註冊過,請更換');
                                  $('#nickname').addClass('is-invalid');
                                } else {
                                  //整理資料,準備送出表單
                                  let gender = null;
                                  if (typeof $('input[name=inlineRadioOptions]:checked', '#register_form').val() !== 'undefined') {
                                    gender = $('input[name=inlineRadioOptions]:checked', '#register_form').val().trim();
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
                                    url:'ajax/register_user.php',
                                    data:{
                                      'gender':gender,
                                      'birthday':birthday,
                                      'contact_number':contact_number,
                                      'email_address':$('#email_address').val().trim(),
                                      'username':$('#username').val().trim(),
                                      'password':$('#password').val().trim(),
                                      'nickname':$('#nickname').val().trim()
                                    },
                                    dataType:'json'
                                  }).done(function(data) {
                                    if (data !== 'no') {
                                      alert('申請註冊成功,認證信已寄出,跳轉至認證頁面');
                                      window.location.href = './validate.php?nickname=' + data['nickname'] + '&email_address=' + data['email_address'];
                                    } else {
                                      alert('申請註冊失敗,請確認網路穩定性,若仍無法成功註冊,請聯絡工程人員');
                                      $('#submit').prop('disabled', false);
                                      $('#submit').html('確認註冊');
                                    }
                                  }).fail(function(jqXHR,textStatus,errorthrown) {
                                    alert('有錯誤產生,請查看console log');
                                    console.log(jqXHR.responseText);
                                    $('#submit').prop('disabled', false);
                                    $('#submit').html('確認註冊');
                                  });
                                  $('#submit').prop('disabled', true);
                                  $('#submit').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> 確認註冊');
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
                  }).fail(function(jqXHR,textStatus,errorthrown) {
                    alert('有錯誤產生,請查看console log');
                    console.log(jqXHR.responseText);
                  });
                }
              }
            }).fail(function(jqXHR,textStatus,errorthrown) {
              alert('有錯誤產生,請查看console log');
              console.log(jqXHR.responseText);
            });
          }
        }
      }
    }
    return false;
  });
});
</script>
</html>
