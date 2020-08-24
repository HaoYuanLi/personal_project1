<!DOCTYPE html5>
<?php
require_once('../setting.php');
require_once('../function/common_function.php');
$common_function_object = new Common_function();
$single_work_array = $common_function_object->get_designated_work($_GET['work_id']);
?>
<html lang="zh-TW" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>編輯影片</title>
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
        <form id="edit_form">
          <div class="form-group">
            <label for="title">標題</label>
            <input type="text" class="form-control" id="title" maxlength="50" placeholder="請勿留白,限制最多50字元" value="<?php echo $single_work_array['title']; ?>" autofocus required>
          </div>
          <div class="form-group">
            <label for="intro">簡介</label>
            <textarea class="form-control" id="intro" placeholder="請勿輸入',因使用nl2br隔行,用了會產生bug" rows="10" required><?php echo str_replace("<br />", chr(13), $single_work_array['intro']); ?></textarea>
          </div>
          <p style="font-weight:bold;">檔案上傳(一次只能上傳一種)</p>
          <div class="form-group">
            <label for="video">影片上傳(檔案若超過41MB會導致上傳失敗)</label><br>
            <input type="file" id="video" accept="video/*" <?php echo ($single_work_array['video_path'] !== NULL && file_exists('../'.$single_work_array['video_path']) OR $single_work_array['youtube_link'] !== NULL) ? 'disabled' : ''; ?>>
            <input type="hidden" id="video_path" value="<?php echo ($single_work_array['video_path'] !== NULL && file_exists('../'.$single_work_array['video_path'])) ? $single_work_array['video_path'] : ''; ?>">
            <a style="margin-bottom:5px;" href="javascript:void(0);" class="btn btn-danger del_video">影片刪除</a>
            <div style="margin-top:5px;" class="show_video">
              <?php if ($single_work_array['video_path'] !== NULL && file_exists('../'.$single_work_array['video_path'])) : ?>
              <video src="<?php echo "../".$single_work_array['video_path']; ?>" class='img-thumbnail' controls></video>
              <?php elseif ($single_work_array['video_path'] !== NULL && !file_exists('../'.$single_work_array['video_path'])) : ?>
              <p style="color:red;">檔案已不存在</p>
              <?php endif; ?>
            </div>
          </div>
          <div class="form-group">
            <?php
            $youtube_link = NULL;
            if ($single_work_array['youtube_link'] !== NULL)
            {
                $youtube_link = str_replace('https://www.youtube.com/embed/', '', $single_work_array['youtube_link']);
            }
            ?>
            <label for="youtube_link">Youtube影片上傳(範例:https://www.youtube.com/watch?v=123,貼上123即可)</label><br>
            <input type="text" id="youtube_link" autocomplete="off" value="<?php echo ($youtube_link !== NULL) ? $youtube_link : ''; ?>" <?php echo ($single_work_array['video_path'] !== NULL && file_exists('../'.$single_work_array['video_path'])) ? 'disabled' : ''; ?>>
            <button style="margin-bottom:5px;margin-left:112px;" type="button" class="btn btn-danger" id="del_youtube_link" <?php echo ($single_work_array['video_path'] !== NULL && file_exists('../'.$single_work_array['video_path'])) ? 'disabled' : ''; ?>>清空字串</button>
          </div>
          <div class="form-group" id="raio_group">
            <label class="form-check-label" for="inlineRadio1" style="padding-right:20px;">發佈</label>
            <input class="form-check-input" type="radio" name="publish" id="inlineRadio1" value="1" <?php echo ($single_work_array['publish'] === 1) ? 'checked' : ''; ?>>
            <label class="form-check-label" for="inlineRadio2" style="padding-right:25px;">不發佈</label>
            <input class="form-check-input" type="radio" name="publish" id="inlineRadio2" value="0" <?php echo ($single_work_array['publish'] === 0) ? 'checked' : ''; ?>>
          </div>
          <div align="center"><button type="submit" class="btn btn-primary">確認編輯</button></div>
        </form>
      </div>
    </div>
  </div>
</div>
</body>
<?php require_once('./footer.php'); ?>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script>
let form_changed = false;
$(document).ready(function() {
  $('#edit_form input').change(function() {
    form_changed = true;
  });

  $('#edit_form textarea').change(function() {
    form_changed = true;
  });

  $('#video').change(function() {
    const file = $(this)[0].files[0]; //檔案位置
    const save_path = 'upload_files/videos/'; //上傳位置
    let form_data = new FormData();
    $('.show_video').html('<i class="fas fa-spinner"></i>');
    form_data.append('file', file);
    form_data.append('save_path', save_path);
    $.ajax({
      type:'POST',
      url:'../ajax/upload_file.php',
      data:form_data,
      cache:false,//因為只有上傳檔案,所以不要暫存
      processData:false,//因為只有上傳檔案,所以不處理表單資訊
      contentType:false,//傳送過去的內容,由form_data產生,所以設定為false
      dataType:'html'
    }).done(function(data) {
      if (data === 'yes') {
        $('#youtube_link').attr('disabled', true);
        $('#del_youtube_link').attr('disabled', true);
        $('#video').attr('disabled', true);
        $('.show_video').html("<video src='../" + save_path + file['name'] + "' class='img-thumbnail' controls></video>");//顯示圖片
        $('#video_path').val(save_path + file['name']);//把相對路徑放到input video_path裡
      } else {
        alert('影片上傳失敗,請檢查何處出bug');
      }
    }).fail(function(jqXHR,textStatus,errorthrown) {
      alert('有錯誤產生,請查看console log');
      console.log(jqXHR.responseText);
    });
  });

  $('a.del_video').click(function() {
    if ($('#video_path').val() !== '') {
      const chosen = confirm('確認要移除影片嗎?(此動作無法復原)');
      if (chosen) {
        $.ajax({
          type:'POST',
          url:'../ajax/delete_file.php',
          data:{ 'file':$('#video_path').val() },
          dataType:'html'
        }).done(function(data) {
          if (data === 'yes') {
            $('#youtube_link').attr('disabled', false);
            $('#del_youtube_link').attr('disabled', false);
            $('#video').attr('disabled', false);
            $('.show_video').html('');
            $('#video').val('');
            $('#video_path').val('');
          } else {
            alert('影片刪除失敗,請檢查何處有bug');
          }
        }).fail(function(jqXHR,textStatus,errorthrown) {
          alert('有錯誤產生,請查看console log');
          console.log(jqXHR.responseText);
        });
        return false;
      }
    } else {
      alert('影片尚未上傳,無法刪除');
    }
  });

  $('#youtube_link').keyup(function() {
    if ($(this).val() !== '') {
      $('#video').attr('disabled', true);
    } else {
      $('#video').attr('disabled', false);
    }
  });

  $('#del_youtube_link').click(function() {
    $('#youtube_link').val('');
    $('#video').attr('disabled', false);
  });

  $('#edit_form').submit(function() {
    if ($('#video').val() === '' && $('#youtube_link').val() === '') {
      alert('請選擇其中一種影片檔案上傳!!');
    } else {
      if ($("input[name='publish']:checked").val() === undefined) {
        alert('請勾選是否發佈');
        $('#raio_group').css('color', 'red');
      } else {
        if (form_changed === false) {
          alert('表單內容沒有更動,無法送出修改內容')
        } else {
          $.ajax({
            type:'POST',
            url:'../ajax/edit_work.php',
            data:{
              'work_id':'<?= $_GET['work_id']; ?>',
              'title':$('#title').val(),
              'intro':$('#intro').val(),
              'video_path':$('#video_path').val(),
              'youtube_link':$('#youtube_link').val(),
              'publish':$("input[name='publish']:checked").val()
            },
            dataType:'html'
          }).done(function(data) {
            if (data === 'yes') {
              alert('編輯成功');
              window.location.href='work_list.php';
            } else {
              alert('編輯失敗,請確認網路是否穩定,若仍無法新增,請找工程人員檢查');
            }
          }).fail(function(jqXHR,textStatus,errorthrown) {
            alert('有錯誤產生,請查看console log');
            console.log(jqXHR.responseText);
          });
        }
      }
    }
    return false;
  });
});
</script>
</html>
