<!DOCTYPE html5>
<?php
require_once('../setting.php');
require_once('../function/common_function.php');
$common_function_object = new Common_function();
$all_comment_array = $common_function_object->get_all_comment();
?>
<html lang="zh-TW" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>留言管理</title>
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
        <table class="table table-hover">
          <thead>
            <tr style="color:white; background-color:black;">
              <th scope="col">留言者名稱</th>
              <th scope="col">內容</th>
              <th scope="col">所在頁面標題</th>
              <th scope="col">建立時間</th>
              <th scope="col">修改時間</th>
              <th scope="col">管理動作</th>
            </tr>
          </thead>
          <?php if ($all_comment_array !== FALSE) : ?>
          <?php foreach ($all_comment_array as $all_comment_array_val) :?>
          <tbody>
            <tr>
              <td scope="row"><?php echo $all_comment_array_val['create_user_nickname']; ?></td>
              <td scope="row"><?php echo mb_substr($all_comment_array_val['content'], 0, 15); ?></td>
              <?php if ($all_comment_array_val['article_id'] !== NULL) : ?>
              <td scope="row">
                <a href="../article.php?article_id=<?php echo $all_comment_array_val['article_id'];?>"><?php echo mb_substr($all_comment_array_val['article_title'], 0, 15); ?></a>
              </td>
              <?php elseif ($all_comment_array_val['work_id'] !== NULL) : ?>
              <td scope="row">
                <a href="../work.php?work_id=<?php echo $all_comment_array_val['work_id'];?>"><?php echo mb_substr($all_comment_array_val['work_title'], 0, 15); ?></a>
              </td>
              <?php endif; ?>
              <td scope="row"><?php echo $all_comment_array_val['create_datetime']; ?></td>
              <?php
              if ($all_comment_array_val['modify_datetime'] !== NULL)
              {
                  $modify_datetime = $all_comment_array_val['modify_datetime'];
              }
              else{
                  $modify_datetime = '未編輯過';
              }
              ?>
              <td scope="row"><?php echo $modify_datetime; ?></td>
              <td scope="row"><a href="javascript:void(0)" class="btn btn-danger del_comment" data-id=<?php echo $all_comment_array_val['id']; ?>>刪除</a></td>
            </tr>
          </tbody>
          <?php endforeach; ?>
          <?php else: ?>
          <tbody>
            <tr>
              <th scope="row" colspan="6">查無資料</th>
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
  $('a.del_comment').click(function() {
    const chosen = confirm('確認要刪除嗎?');
    const target = $(this).parent().parent();
    if (chosen) {
      $.ajax({
        type:'POST',
        url:'../ajax/delete_comment.php',
        data:{ 'comment_id':$(this).attr('data-id') },
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
