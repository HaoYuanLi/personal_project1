<!DOCTYPE html5>
<?php
require_once('./setting.php');
require_once('function/common_function.php');
require_once('function/time_lag.php');
$common_function_object = new Common_function();
$single_work_array = $common_function_object->get_designated_publish_work($_GET['work_id']);
$url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
?>
<html lang="zh-TW" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title><?php echo $single_work_array['title']; ?></title>
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
        <div class="card">
        <?php if ($single_work_array !== FALSE): ?>
          <div class="card-body">
            <h2><?php echo $single_work_array['title']; ?></h2>
            <div id="share" name="share">
              <div id="fb-root"></div>
              <script async defer crossorigin="anonymous" src="https://connect.facebook.net/zh_TW/sdk.js#xfbml=1&version=v5.0"></script>
              <div class="fb-share-button" data-href="<?php echo $url; ?>" data-layout="button_count" data-size="small" style="position:relative;">
                <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">分享</a>
              </div>
              <div class="line-it-button" data-lang="zh_Hant" data-type="share-a" data-ver="3" data-url="<?php echo $url; ?>" data-color="default" data-size="small" data-count="true" style="display: none;position:relative;margin-left:95px;margin-top:-20px;"></div>
              <script src="https://d.line-scdn.net/r/web/social-plugin/js/thirdparty/loader.min.js" async="async" defer="defer"></script>
            </div><hr>
            <p class="badge badge-danger"><?php time_lag(($single_work_array['edit_count'] === 0) ? $single_work_array['create_datetime'] : $single_work_array['modify_datetime'], $single_work_array['edit_count']); ?></p>
            <?php if ($single_work_array['video_path'] !== NULL): ?>
            <?php $path = $single_work_array['video_path']; ?>
            <div class="embed-responsive embed-responsive-16by9">
              <iframe class="embed-responsive-item" src="<?php echo $path;?>" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
            <?php elseif ($single_work_array['youtube_link'] !== NULL): ?>
            <?php $path = $single_work_array['youtube_link']; ?>
            <div class="embed-responsive embed-responsive-16by9">
              <iframe class="embed-responsive-item" src="<?php echo $path;?>" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
            <?php endif; ?>
            <p class="card-text"><?php echo $single_work_array['intro']; ?></p>
          </div>
        <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
<?php require_once('./footer.php'); ?>
</html>
