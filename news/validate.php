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
  <title>信箱認證</title>
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
          <p><?php echo '電子郵件地址 : '.$_GET['email_address']; ?></p>
          <p></p>
          <form method="POST" id="validate_form">
            <div class="form-group">
              <?php
              if (isset($_COOKIE['datetime_of_resend']))
              {
                  echo '<p>可於'.'<span id="remain_time"></span>'.'後,重新寄送認證信</p>';
              }
              else
              {
                  echo '<button type="button" class="btn btn-primary" id="resend_email">重新寄送認證信</button>&nbsp';
                  echo '<a href="./change_email_address.php?'.explode('?' ,$_SERVER['REQUEST_URI'])[1].'" class="btn btn-primary">更改電子郵件地址</a><br>';
              }
              ?>
              <label style="margin:0 auto;font-weight:bold;font-size:20px;margin-top:15px;" for="validation_code">認證碼</label>
              <input type="text" placeholder="請在此輸入收到的認證碼" onkeypress="return (event.charCode === 8 || event.charCode === 0 || event.charCode === 13) ? null : event.charCode >= 48 && event.charCode <= 57" style="margin-top:15px;" class="form-control col-xs-12 col-sm-6 offset-xs-6 offset-sm-3" id="validation_code" value="<?php echo (isset($_GET['validation_code'])) ? $_GET['validation_code'] : ''; ?>" minlength="6" maxlength="6" required>
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
//取得允許重新寄送的日期時間
const datetime_of_resend = '<?= (isset($_COOKIE['datetime_of_resend'])) ? $_COOKIE['datetime_of_resend'] : ' '; ?>';
let resend_timestamp = null;
if (datetime_of_resend !== ' ') {
  resend_timestamp = new Date(datetime_of_resend);
}

//計算並且呈現剩餘時間
const remain_time = function() {
  const current_timestamp = new Date();
  const diff = resend_timestamp - current_timestamp;
  const minutes = Math.floor(diff / 1000 / 60);
  const seconds = Math.floor((diff - minutes * 1000 * 60) / 1000);
  if (diff >= 0) {
    $('#remain_time').html((minutes < 10 ? '0' +　minutes : minutes) + '分' + (seconds < 10 ? '0' + seconds : seconds) + '秒');
  } else {
    window.location.reload();
  }
};

//若resend_timestamp不為null,設置update_remain_time每秒刷新一次剩餘時間
if (resend_timestamp !== null) {
  const update_remain_time = setInterval(remain_time, 1000);
} else {
  clearInterval(update_remain_time);
}

$(document).ready(function() {
  $('#resend_email').click(function() {
    $.ajax({
      type:'POST',
      url:'ajax/resend_email.php',
      data:{
        'nickname':'<?= $_GET['nickname']; ?>',
        'email_address':'<?= $_GET['email_address']; ?>'
      },
      dataType:'html'
    }).done(function(data) {
      if (data === 'yes') {
        alert('重新寄送認證信成功,請至您的信箱查收認證碼');
        window.location.reload();
      } else {
        alert('重新寄送認證信失敗,請確認網路穩定性,若仍無法成功寄出,請聯絡工程人員');
        $('#resend_email').prop('disabled', false);
        $('#resend_email').html('重新寄送認證信');
      }
    }).fail(function(jqXHR,textStatus,errorthrown) {
      alert('有錯誤產生,請查看console log');
      console.log(jqXHR.responseText);
      $('#resend_email').prop('disabled', false);
      $('#resend_email').html('重新寄送認證信');
    });
    $('#resend_email').prop('disabled', true);
    $('#resend_email').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> 重新寄送認證信');
    return false;
  });

  $('#validate_form').submit(function() {
    const validation_code_validity_period = '<?= (isset($_COOKIE['validation_code_validity_period'])) ? true : false;?>';
    if (validation_code_validity_period) {
      if ($('#validation_code').val().length !== 6) {
        alert('認證碼的正確格式為6位元!!');
        document.getElementById("validation_code").focus();
      } else {
        $.ajax({
          type:'POST',
          url:'ajax/validate_email_address.php',
          data:{
            'email_address':'<?= $_GET['email_address']; ?>',
            'validation_code':$('#validation_code').val()
          },
          dataType:'html'
        }).done(function(data) {
          if (data === 'yes') {
            alert('信箱認證成功,跳轉至首頁');
            window.location.href='./index.php';
          } else {
            if (data === 'no_1') {
              alert('認證碼錯誤');
            } else {
              alert('變更認證狀態失敗,請確認網路是否穩定,若仍是出現該錯誤,請聯絡系統工程師')
            }
          }
        }).fail(function(jqXHR,textStatus,errorthrown) {
          alert('有錯誤產生,請查看console log');
          console.log(jqXHR.responseText);
        });
        return false;
      }
    } else {
      alert('認證碼已失效,請重新寄送認證信');
    }
  });
});
</script>
</html>
