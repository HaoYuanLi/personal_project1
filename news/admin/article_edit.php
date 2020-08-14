<!DOCTYPE html5>
<?php
require_once('../setting.php');
require_once('../function/common_function.php');
$common_function_object = new Common_function();
$article_array = $common_function_object->get_designated_article($_GET['article_id']);
?>
<html lang="zh-TW" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>編輯文章</title>
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
      <div class="col col-xs-12">
      <?php if ($article_array !== FALSE): ?>
      <form id="edit_form">
        <div class="form-group">
          <label for="title">標題</label>
          <input type="text" class="form-control" id="title" placeholder="請勿輸入',因使用nl2br隔行,用了會產生bug" value="<?php echo $article_array['title']; ?>"  autofocus required>
        </div>
        <div class="form-group">
          <label for="category">分類</label>
          <select id="category" class="form-control">
            <option value="娛樂" <?php echo($article_array['category'] === '娛樂') ? 'selected' : ''; ?>>娛樂</option>
            <option value="政治" <?php echo($article_array['category'] === '政治') ? 'selected' : ''; ?>>政治</option>
            <option value="運動" <?php echo($article_array['category'] === '運動') ? 'selected' : ''; ?>>運動</option>
            <option value="動漫" <?php echo($article_array['category'] === '動漫') ? 'selected' : ''; ?>>動漫</option>
          </select>
        </div>
        <div class="form-group">
          <label for="content">內文</label>
          <textarea class="form-control" id="content" placeholder="請勿留白" rows="15" required><?php echo str_replace("<br />", chr(13), $article_array['content']); ?></textarea>
        </div>
        <label for="image">圖片上傳(可同時上傳多個圖檔,但同一個圖檔無法連續上傳)</label><br>
        <input type="file" id="image" accept="image/*"><br><br>
        <div class="form-group" id="raio_group">
          <label class="form-check-label" for="inlineRadio1" style="padding-right:20px;">發佈</label>
          <input class="form-check-input" type="radio" name="publish" id="inlineRadio1" value="1" <?php echo ($article_array['publish'] === 1) ? 'checked' : ''; ?>>
          <label class="form-check-label" for="inlineRadio2" style="padding-right:25px;">不發佈</label>
          <input class="form-check-input" type="radio" name="publish" id="inlineRadio2" value="0" <?php echo ($article_array['publish'] === 0) ? 'checked' : ''; ?>>
        </div>
        <div align="center"><button type="submit" class="btn btn-primary">編輯完成</button></div>
      </form>
      <?php else: ?>
      <div class="alert alert-danger" role="alert">查無資料,請確認資料庫連結語法是否正確或網路是否穩定</div>
      <?php endif; ?>
      </div>
    </div>
  </div>
</div>
</body>
<?php require_once('./footer.php'); ?>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script>
let form_changed = false;
function insertAtCursor(myField, myValue) {
  if (document.selection) {
    //IE support
    myField.focus();
    sel = document.selection.createRange();
    sel.text = myValue;
    sel.select();
  } else if (myField.selectionStart || myField.selectionStart === '0') {
    //MOZILLA/NETSCAPE support
    const startPos = myField.selectionStart;
    const endPos = myField.selectionEnd;
    const beforeValue = myField.value.substring(0, startPos);
    const afterValue = myField.value.substring(endPos, myField.value.length);
    myField.value = beforeValue + myValue + afterValue;
    myField.selectionStart = startPos + myValue.length;
    myField.selectionEnd = startPos + myValue.length;
    myField.focus();
  } else {
    myField.value += myValue;
    myField.focus();
  }
}
$(document).ready(function() {
  $('#edit_form input').change(function() {
    form_changed = true;
  });

  $('#edit_form textarea').change(function() {
    form_changed = true;
  });

  $('#image').change(function() {
    const file = $(this)[0].files[0]; //檔案位置
    const save_path = 'upload_files/images/'; //上傳位置
    let form_data = new FormData();
    form_data.append('file', file);
    form_data.append('save_path', save_path);
    $.ajax({
      type:'POST',
      url:'../ajax/upload_file.php',
      data:form_data,
      cache:false, //因為只有上傳檔案,所以不要暫存
      processData:false, //因為只有上傳檔案,所以不處理表單資訊
      contentType:false, //傳送過去的內容,由form_data產生,所以設定為false
      dataType:'html'
    }).done(function(data) {
      if (data === 'yes') {
        const text = document.getElementById('content');
        const site='<img style="display:block; margin:0 auto; hight:50%; width:50%;" src="' + save_path + file['name'] + '" class="img-thumbnail">';
        insertAtCursor(text, site);
      } else {
        alert('圖片上傳失敗,請檢查何處出bug');
      }
    }).fail(function(jqXHR,textStatus,errorthrown) {
      alert('有錯誤產生,請查看console log');
      console.log(jqXHR.responseText);
    });
  });

  $('#edit_form').submit(function() {
    if ($("input[name='publish']:checked").val() === undefined) {
      alert('請勾選是否發佈');
      $('#raio_group').css('color', 'red');
    } else {
      if (form_changed === false) {
        alert('表單內容沒有更動,無法送出修改內容')
      } else {
        $.ajax({
          type:'POST',
          url:'../ajax/edit_article.php',
          data:{
            'id':'<?= $_GET['article_id']; ?>',
            'title':$('#title').val(),
            'category':$('#category').val(),
            'content':$('#content').val(),
            'publish':$("input[name='publish']:checked").val()
          },
          dataType:'html'
        }).done(function(data) {
          if (data === 'yes') {
            alert('編輯成功');
            window.location.href='article_list.php';
          } else {
            alert('編輯失敗,請確認網路是否穩定,若仍無法新增,請找工程人員檢查');
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
