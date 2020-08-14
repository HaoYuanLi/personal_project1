<!DOCTYPE html5>
<?php
require_once('./setting.php');
require_once('function/common_function.php');
$common_function_object = new Common_function();
$work_list_array = $common_function_object->get_publish_work();
?>
<html lang="zh-TW" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>所有影片</title>
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
      <?php if ($work_list_array !== FALSE): ?>
      <?php foreach ($work_list_array as $work_list_array_val) : ?>
      <div class="col col-sm-4 col-xs-12">
        <div class="card "style="max-width: 18rem;">
          <?php if ($work_list_array_val['video_path'] !== NULL): ?>
          <?php $path = $work_list_array_val['video_path']; ?>
          <video src='<?php echo $path;?>' class='img-thumbnail' controls></video>
          <?php elseif ($work_list_array_val['youtube_link'] !== NULL): ?>
          <?php $path = $work_list_array_val['youtube_link']; ?>
          <div class="embed-responsive embed-responsive-16by9">
            <iframe class="embed-responsive-item" src="<?php echo $path; ?>" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
          </div>
          <?php endif; ?>
          <?php $intro = mb_substr($work_list_array_val['intro'], 0, 50); ?>
          <div class="card-body">
            <h5 class="card-title">
              <a href="work.php?work_id=<?php echo $work_list_array_val['id']; ?>"><?php echo $work_list_array_val['title']; ?></a>
            </h5>
            <p class="card-text"><?php echo $intro; ?></p>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
      <?php else: ?>
      <p>沒有作品</p>
      <?php endif; ?>
    </div>
  </div>
</div>
</body>
<?php require_once('./footer.php'); ?>
</html>
