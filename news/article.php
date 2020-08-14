<!DOCTYPE html5>
<?php
require_once('./setting.php');
require_once('function/common_function.php');
require_once('function/time_lag.php');
$common_function_object = new Common_function();
$single_article_array = $common_function_object->get_designated_publish_article($_GET['article_id']);
$article_comment_array = $common_function_object->get_designated_article_comment($_GET['article_id']);
$url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
?>
<html lang="zh-TW" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title><?php echo $single_article_array['title']; ?></title>
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
        <div class="card" style="margin-bottom:20px;">
          <div class="card-body">
            <?php if ($single_article_array !== FALSE) : ?>
            <h2><?php echo $single_article_array['title']; ?></h2>
            <div id="share" name="share">
              <div id="fb-root"></div>
              <script async defer crossorigin="anonymous" src="https://connect.facebook.net/zh_TW/sdk.js#xfbml=1&version=v5.0"></script>
              <div class="fb-share-button" data-href="<?php echo $url; ?>" data-layout="button_count" data-size="small" style="position:relative;">
                <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">分享</a>
              </div>
              <div class="line-it-button" data-lang="zh_Hant" data-type="share-a" data-ver="3" data-url="<?php echo $url; ?>" data-color="default" data-size="small" data-count="true" style="display: none;position:relative;margin-left:95px;margin-top:-20px;"></div>
              <script src="https://d.line-scdn.net/r/web/social-plugin/js/thirdparty/loader.min.js" async="async" defer="defer"></script>
            </div><hr>
            <span class="badge badge-info"><?php echo $single_article_array['category']; ?></span>
            <span class="badge badge-danger"><?php time_lag(($single_article_array['edit_count'] === 0) ? $single_article_array['create_datetime'] : $single_article_array['modify_datetime'], $single_article_array['edit_count']); ?></span>
            <p class="card-text"><?php echo $single_article_array['content']; ?></p>
            <?php else: ?>
            <p style="text-align:center;">查無資料</p>
            <?php endif ?>
          </div>
        </div>
        <div style="margin-bottom:20px;">
          <input style="position:relative;" type="button" class="btn btn-info col col-sm-6 col-xs-12 offset-sm-3" value="複製文章網址" onclick="copy_url()">
          <textarea style="position:relative;" rows="1" class=" col col-sm-6 col-xs-12 offset-sm-3" id="url"><?php echo $url; ?></textarea>
        </div>
        <h3>留言板</h3>
        <?php
        if ($article_comment_array !== FALSE) :
            foreach ($article_comment_array as $article_comment_array_key => $article_comment_array_val) :
        ?>
        <div class="card">
          <div class="card-body">
            <p style="font-weight:bold;"><?php echo $article_comment_array_val['create_user_nickname']; ?></p>
            <?php
            if ($article_comment_array_val['edit_count'] === 0)
            {
                $datetime = 'create_datetime';
            }
            else
            {
                $datetime = 'modify_datetime';
            }
            ?>
            <span class="badge badge-dark"><?php time_lag($article_comment_array_val[$datetime], $article_comment_array_val['edit_count']); ?></span>
            <?php if (isset($_SESSION['login_user']['id']) && $_SESSION['login_user']['id'] === $article_comment_array_val['create_user_id']) : ?>
            <button
              style="position:absolute;top:20;right:80;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"
              onclick="set_modal_value(<?php echo $article_comment_array_val['id']; ?>, '<?php echo $article_comment_array_val['content']; ?>', '<?php echo $article_comment_array_val['create_user_nickname']; ?>')">編輯
            </button>
            <a style="position:absolute;top:20;right:15;" href="javascript:void(0)" class="btn btn-danger del_comment" data-id=<?php echo $article_comment_array_val['id']; ?>>刪除</a>
            <?php endif; ?>
            <p><?php echo $article_comment_array_val['content']; ?></p>
          </div>
        </div>
        <?php endforeach; ?>
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <span>編輯留言</span>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              </div>
              <div class="modal-body">
                <form role="form" id="edit_comment" name="edit_comment" method="post">
                  <input id="comment_id" type="hidden">
                  <div class="form-group">
                    <span>發言人</span>
                    <input id="user_nickname" type="text" readonly="readonly" style="border:none;"></input><br>
                    <span>內文</span>
                    <textarea class="form-control" rows="5" id="comment_content" name="comment_content" placeholder="請勿留白(請勿手動格行,若隔行會導致留言無法編輯)" required></textarea>
                  </div>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="comment_edit" name="comment_edit">送出</button>
              </div>
            </div>
          </div>
        </div>
        <?php else: ?>
        <h4 style="text-align:center;">暫無留言</h4>
        <?php endif; ?>
        <form method="POST" id="comment_form">
          <div>
            <textarea style="position:relative;top:10;margin-bottom:20px;" cols="151" rows="3" class="form-control" id="comment" placeholder='<?php echo (isset($_SESSION['login_user']['nickname'])) ? $_SESSION['login_user']['nickname']." 與他人分享自己的感想吧(請勿手動格行,若隔行會導致留言無法編輯)" : '訪客您好,需要先登入,才能留言'; ?>' required></textarea>
            <?php if (!isset($_SESSION['login_user']) OR @$_SESSION['login_user']['stat'] === FALSE) : ?>
            <button style="position:relative;" type="button" class="btn btn-warning col col-sm-6 col-xs-12 offset-sm-3" onclick="location.href='login.php?return'">登入</button>
            <?php else: ?>
            <button style="position:relative;" type="submit" class="btn btn-info col col-sm-6 col-xs-12 offset-sm-3">發送留言</button>
            <?php endif; ?>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
</body>
<?php require_once('./footer.php'); ?>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script>
//複製網址
function copy_url() {
  const val = document.getElementById('url');
  val.select(); //選擇物件
  document.execCommand('copy'); //執行複製命令
  alert('複製成功');
}

//無法使用foreach傳值給modal,所以改成按編輯紐時,觸發此function
function set_modal_value(comment_id, comment_content, user_nickname) {
  $('#comment_id').val(comment_id);
  $('#comment_content').val(comment_content);
  $('#user_nickname').val(user_nickname);
}

$(document).ready(function() {
  $('#comment_form').submit(function() {
    $.ajax({
      type:'POST',
      url:'function/filter.php',
      data:{
        'string':$('#comment').val(),
        'text':'bad_language_list'
      },
      dataType:'html'
    }).done(function(data) {
      if (data === 'yes') {
        $.ajax({
          type:'POST',
          url:'ajax/add_comment.php',
          data:{
            'comment':$('#comment').val(),
            'id':'<?= $_GET['article_id']; ?>',
            'source':'article_id'
          },
          dataType:'html'
        }).done(function(data) {
          if (data === 'yes') {
            window.location.reload();
          } else {
            alert('新增留言失敗,檢查何處出bug');
          }
        }).fail(function(jqXHR,textStatus,errorthrown) {
          alert('有錯誤產生,請查看console log');
          console.log(jqXHR.responseText);
        });
        return false;
      } else {
        alert(data);
      }
    }).fail(function(jqXHR,textStatus,errorthrown) {
      alert('有錯誤產生,請查看console log');
      console.log(jqXHR.responseText);
    });
    return false;
  });

  $('#comment_edit').on('click',function() {
    $.ajax({
      type:'POST',
      url:'function/filter.php',
      data:{
        'string':$('#comment_content').val(),
        'text':'bad_language_list'
      },
      dataType:'html'
    }).done(function(data) {
      if (data === 'yes') {
        $.ajax({
          type:'POST',
          url:'ajax/edit_comment.php',
          data:{
            'comment_id':$('#comment_id').val(),
            'comment_content':$('#comment_content').val()
          },
          dataType:'html'
        }).done(function(data) {
          if (data === 'yes') {
            window.location.reload();
          } else {
            alert('編輯留言失敗,檢查何處出bug');
          }
        }).fail(function(jqXHR,textStatus,errorthrown) {
          alert('有錯誤產生,請查看console log');
          console.log(jqXHR.responseText);
        });
        return false;
      } else {
        alert(data);
      }
    }).fail(function(jqXHR,textStatus,errorthrown) {
      alert('有錯誤產生,請查看console log');
      console.log(jqXHR.responseText);
    });
    return false;
  });



  $('a.del_comment').click(function() {
    const chosen = confirm('確認要刪除嗎?');
    x = $(this).parent().parent();
    if (chosen) {
      $.ajax({
        type:'POST',
        url:'ajax/delete_comment.php',
        data:{
          'comment_id':$(this).attr('data-id')
        },
        dataType:'html'
      }).done(function(data) {
        if (data === 'yes') {
          alert('留言刪除成功');
          x.fadeOut();
        } else {
          alert('留言刪除失敗,檢查何處出bug');
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
