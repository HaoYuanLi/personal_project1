<!DOCTYPE html5>
<?php
require_once('../setting.php');
require_once('../function/common_function.php');
$common_function_object = new Common_function();
$all_user_array = $common_function_object->get_all_user();
 ?>
<html lang="zh-TW" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>使用者管理</title>
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
      <div class="col">
        <a href="user_add.php" class="btn btn-primary">新增使用者</a><hr>
        <table class="table table-hover">
          <thead>
            <tr style="color: white;  background-color: black;">
              <th scope="col" width="5%">id</th>
              <th scope="col" width="20%">名稱</th>
              <th scope="col" width="20%">帳號</th>
              <th scope="col" width="35%">電子郵件地址</th>
              <th scope="col" width="20%">管理動作</th>
            </tr>
          </thead>
          <?php if ($all_user_array !== FALSE) : ?>
          <?php foreach ($all_user_array as $all_user_array_val) : ?>
          <tbody>
            <tr>
              <td scope="row"><?php echo $all_user_array_val['id']; ?></td>
              <td><?php echo $all_user_array_val['nickname']; ?></td>
              <td><?php echo $all_user_array_val['username']; ?></td>
              <td><?php echo $all_user_array_val['email_address']; ?></td>
              <td>
                <a href="user_edit.php?id=<?php echo $all_user_array_val['id']; ?>" class="btn btn-success">更改</a>
                <a href="javascript:void(0)" class="btn btn-danger del_user" data-id=<?php echo $all_user_array_val['id']; ?>>刪除</a>
              </td>
            </tr>
          </tbody>
          <?php endforeach; ?>
          <?php else: ?>
          <tbody>
            <tr>
              <th scope="row" colspan="4">查無資料</th>
            </tr>
          </tbody>
          <?php endif; ?>
        </table>
      </div>
    </div>
  </div>
</div>
</body>
<?php require_once('./footer.php'); ?>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script>
$(document).ready(function() {
  $('a.del_user').click(function() {
    const chosen = confirm('確認要刪除嗎?');
    const target = $(this).parent().parent();
    if (chosen) {
      $.ajax({
        type:'POST',
        url:'../ajax/delete_user.php',
        data:{ 'user_id':$(this).attr('data-id') },
        dataType:'html'
      }).done(function(data) {
        if (data === 'yes') {
          alert('刪除成功');
          target.fadeOut();
        } else {
          alert('刪除失敗,請確認網路是否穩定,若仍無法刪除,請找工程人員檢查');
        }
      }).fail(function(jqXHR,textStatus,errorthrown) {
        alert('有錯誤產生,請查看console log');
        console.log(jqXHR.responseText);
      });
    }
  });
});
</script>
</html>
