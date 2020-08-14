<!DOCTYPE html5>
<?php
require_once('./setting.php');
require_once('function/common_function.php');
require_once('function/pages_switch.php');
require_once('function/time_lag.php');
$common_function_object = new Common_function();
$designated_article_list_array = $common_function_object->get_search_article($_GET['keyword']);
?>
<html lang="zh-TW" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>相關文章</title>
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
        <div style="margin-bottom:20px;">
          <form class="form-group" id="article_search">
            <div class="input-group">
              <input class="form-control text-info border-info" id="keyword" type="search" placeholder="Search" aria-label="Search" required>
              <button type="submit" class="btn btn-info">搜尋文章</button>
            </div>
          </form>
          <?php
          if ($designated_article_list_array !== FALSE) :
              foreach ($designated_article_list_array as $designated_article_list_array_key => $designated_article_list_array_val) :
          ?>
          <div class="card">
            <h5 class="card-header text-white bg-info">
              <a href='article.php?article_id=<?php echo $designated_article_list_array_val['id']?>' target=_self ><?php echo "$designated_article_list_array_val[title]";?></a>
            </h5>
            <div class="card-body">
              <span class="badge badge-info"><?php echo $designated_article_list_array_val['category'];?></span>
              <span class="badge badge-danger"><?php time_lag(($designated_article_list_array_val['edit_count'] === 0) ? $designated_article_list_array_val['create_datetime'] : $designated_article_list_array_val['modify_datetime'], $designated_article_list_array_val['edit_count']); ?></span>
              <p class="card-text" id="cont">
              <?php
              $summary = mb_substr($designated_article_list_array_val['content'], 0, 110);
              if (mb_strpos($summary, 'img') !== FALSE)
              {
                  echo ('為避免圖檔顯示失敗,請進文章內觀賞全文');
              }
              else
              {
                  echo $summary.'......';
              }
              ?>
              </p>
            </div>
          </div>
          <?php
          if ($designated_article_list_array_key !== count($designated_article_list_array) - 1)
          {
              echo '<hr>';
          }
          ?>
          <?php endforeach ?>
          <?php else: ?>
          <p style="text-align:center;">查無資料</p>
          <?php endif ?>
        </div>
        <nav aria-label="Page navigation example" >
          <ul class="pagination align-items-center justify-content-center" >
            <?php pages_switch($common_function_object->data_nums, $common_function_object->pages, $_SERVER['PHP_SELF'].'?keyword='.$_GET['keyword'].'&') ?>
          </ul>
        </nav>
      </div>
    </div>
  </div>
</div>
</body>
<?php require_once('./footer.php'); ?>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script>
$(document).ready(function() {
  $('#article_search').submit(function() {
    //檢查是否有敏感字詞,有的話阻擋表單送出,並彈出警告視窗
    $.ajax({
      type:'POST',
      url:'function/filter.php',
      data:{
        'string':$('#keyword').val(),
        'text':'sql_injection_list'
      },
      dataType:'html'
    }).done(function(data) {
      if (data === 'yes') {
        //查詢的文章是否存在
        $.ajax({
          type:'POST',
          url:'ajax/search_article.php',
          data:{ 'keyword':$('#keyword').val() },
          dataType:'html'
        }).done(function(data) {
          const keyword = $('#keyword').val();
          const site = './designated_article_list.php?keyword=' + keyword;
          if (data === 'yes') {
              window.location.href = site;
          } else {
              alert('查無相關文章');
          }
        }).fail(function(jqXHR,textStatus,errorthrown) {
            alert('有錯誤產生,請查看console log');
            console.log(jqXHR.responseText);
        });
      } else {
        alert(data);
      }
      return false;
    }).fail(function(jqXHR,textStatus,errorthrown) {
        alert('有錯誤產生,請查看console log');
        console.log(jqXHR.responseText);
    });
  return false;
  });
});
</script>
</html>
