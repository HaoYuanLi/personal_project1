<!DOCTYPE html5>
<?php
require_once('../setting.php');
require_once('../function/common_function.php');
?>
<html lang="zh-TW" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>新增文章</title>
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
        <form id="add_form">
          <div class="form-group">
            <label for="title">標題</label>
            <input type="text" class="form-control" id="title" maxlength="50" placeholder="請勿留白,限制最多50字元" autofocus required>
          </div>
          <div class="form-group">
            <label for="category">分類</label>
            <select id="category" class="form-control">
              <option value="娛樂">娛樂</option>
              <option value="政治">政治</option>
              <option value="運動">運動</option>
              <option value="動漫">動漫</option>
            </select>
          </div>
          <div class="form-group">
            <label for="content">內文</label>
            <textarea class="form-control" id="content" placeholder="請勿輸入',因使用nl2br隔行,用了會產生bug" rows="5" required></textarea>
          </div>
          <label for="image">圖片上傳(可同時上傳多個圖檔,但同一個圖檔無法連續上傳)</label><br>
          <input type="file" id="image" accept="image/*"><br><br>
          <div class="form-group" id="raio_group">
            <label class="form-check-label" for="inlineRadio1" style="padding-right:20px;">發佈</label>
            <input class="form-check-input" type="radio" name="publish" id="inlineRadio1" value="1">
            <label class="form-check-label" for="inlineRadio2" style="padding-right:25px;">不發佈</label>
            <input class="form-check-input" type="radio" name="publish" id="inlineRadio2" value="0">
          </div>
          <div style="text-align:center;">
            <button type="submit" class="btn btn-primary">確認新增</button>
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

  $('#add_form').submit(function() {
    if ($("input[name='publish']:checked").val() === undefined) {
      alert('請勾選是否發佈');
      $('#raio_group').css('color', 'red');
    } else {
      $.ajax({
        type:'POST',
        url:'../ajax/add_article.php',
        data:{
          'title':$('#title').val(),
          'category':$('#category').val(),
          'content':$('#content').val(),
          'publish':$("input[name='publish']:checked").val()
        },
        dataType:'html'
      }).done(function(data) {
        if (data === 'yes') {
          alert('新增成功');
          window.location.href='./article_list.php';
        } else {
          alert('新增失敗,請確認網路是否穩定,若仍無法新增,請找工程人員檢查');
        }
      }).fail(function(jqXHR,textStatus,errorthrown) {
        alert('有錯誤產生,請查看console log');
        console.log(jqXHR.responseText);
      });
    }
    return false;
  });
});
</script>
</html>
