<!DOCTYPE html5>
<?php require_once('../setting.php'); ?>
<html lang="zh-TW" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>新增使用者</title>
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
        <form method="POST" id="register_form">
          <div class="form-group">
            <label for="email_address"><span style="color:red;">*</span>電子郵件地址</label>
            <input type="email" class="form-control" name="email_address" id="email_address" placeholder="請在此輸入您擁有的信箱,稍後會用該信箱來認證" required autofocus>
          </div>
          <div class="form-group">
            <label for="username"><span style="color:red;">*</span>帳號</label>
            <input onkeyup="value=value.replace(/[^\w\.\/]/ig,'')" type="text" class="form-control" name="text" id="username" placeholder="請在此輸入帳號,需包含8位元以上的英文.數字.符號,禁止使用中文" required>
          </div>
          <div class="form-group">
            <label for="password"><span style="color:red;">*</span>密碼</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="請在此輸入密碼,需包含8位元以上的英文.數字.符號,禁止使用中文" required>
          </div>
          <div class="form-group">
            <label for="confirm_password"><span style="color:red;">*</span>確認密碼</label>
            <input type="password" class="form-control" id="confirm_password" placeholder="請在此輸入確認密碼" required>
          </div>
          <div class="form-group">
            <label for="nickname"><span style="color:red;">*</span>暱稱</label>
            <input type="text" class="form-control" name="nickname" id="nickname" placeholder="請在此輸入暱稱,無任何限制,但不可再做修改" required>
          </div>
          <div class="form-group" id="raio_group">
            <span><span style="color:red;">*</span>管理權限</span>
            <label class="form-check-label" for="inlineRadio1" style="margin:0 20px 0 10px;">有</label>
            <input class="form-check-input" type="radio" name="management" id="inlineRadio1" value="1">
            <label class="form-check-label" for="inlineRadio2" style="margin-right:25px;">無</label>
            <input class="form-check-input" type="radio" name="management" id="inlineRadio2" value="0">
          </div>
          <button type="submit" class="btn btn-primary col col-sm-6 col-xs-12 offset-sm-3">確認註冊</button>
        </form>
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
          url:'../ajax/verify_email_address.php',
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
                url:'../ajax/verify_username.php',
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
                            url:'../ajax/verify_nickname.php',
                            data:{ 'nickname': $('#nickname').val() },
                            dataType:'html'
                          }).done(function(data) {
                            if (data === 'yes') {
                              alert('此暱稱已有人註冊過,請更換');
                              $('#nickname').addClass('is-invalid');
                            } else {
                              if ($("input[name='management']:checked").val() === undefined) {
                                alert('請勾選有無權限');
                                $('#raio_group').css('color', 'red');
                              } else {
                                $.ajax({
                                type:'POST',
                                url:'../ajax/add_user.php',
                                data:{
                                  'email_address':$('#email_address').val(),
                                  'username':$('#username').val(),
                                  'password':$('#password').val(),
                                  'nickname':$('#nickname').val(),
                                  'management':$("input[name='management']:checked").val()
                                },
                                dataType:'html'
                                }).done(function(data) {
                                  if (data === 'yes') {
                                    alert('註冊成功');
                                    window.location.href='user_list.php';
                                  } else {
                                    alert('註冊失敗,請確認網路穩定性,若仍無法成功新增,請聯絡工程人員');
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
  return false;
  });
});
</script>
</html>
