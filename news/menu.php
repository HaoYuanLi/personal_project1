<?php
if (!isset($_SESSION['login_user']))
{
    @$_SESSION['login_user']['manager'] = 0;
    @$_SESSION['login_user']['stat'] = FALSE;
}
$sites_path = $_SERVER['PHP_SELF'];
$files_path = basename($sites_path, ".php");
switch ($files_path)
{
    case 'article_list':
    case 'article':
    case 'designated_article_list':
    $page_index = 1;
    break;

    case 'work_list':
    case 'work':
    $page_index = 2;
    break;

    case 'about':
    $page_index = 3;
    break;

    case 'register':
    case 'validate':
    case 'change_email_address':
    $page_index = 4;
    break;

    case 'change_account_setting':
    $page_index = 5;
    break;

    default:
    $page_index = 0;
    break;
}
?>
<head>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="css/lock_scrollbar.css">
</head>
<body>
<div class="jumbotron alert-success">
  <div class="top">
    <h1 class="text-center">News新聞網</h1>
    <div class="container">
      <div class="row">
        <div class="col">
          <ul class="nav nav-pills nav-fill menu_bar  alert-success justify-content-center">
            <li class="nav-item">
              <a class="nav-link <?php echo ($page_index === 0) ? 'bg-info text-white' : ''; ?>" href="http://localhost/news/index.php">首頁</a>
            </li>
            <?php if (isset($_SESSION['login_user']) && $_SESSION['login_user']['manager'] === 1) : ?>
            <li class="nav-item">
              <a class="nav-link"  href="http://localhost/news/admin/index.php">後台首頁</a>
            </li>
            <?php endif; ?>
            <li class="nav-item">
              <a class="nav-link <?php echo ($page_index === 1) ? 'bg-info text-white' : ''; ?>" href="http://localhost/news/article_list.php">所有文章</a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php echo ($page_index === 2) ? 'bg-info text-white' : '';  ?>" href="http://localhost/news/work_list.php">所有影片</a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php echo ($page_index === 3) ? 'bg-info text-white' : ''; ?>" href="http://localhost/news/about.php">關於我們</a>
            </li>
            <?php if (isset($_SESSION['login_user']) && $_SESSION['login_user']['stat'] === TRUE) : ?>
            <li class="nav-item">
              <a class="nav-link <?php echo ($page_index === 5) ? 'bg-info text-white' : ''; ?>"  href="http://localhost/news/change_account_setting.php">變更帳戶設定</a>
            </li>
            <?php endif; ?>
            <?php if (!isset($_SESSION['login_user']) OR @$_SESSION['login_user']['stat'] === FALSE) :  ?>
            <li class="nav-item">
              <a class="nav-link <?php echo ($page_index === 4) ? 'bg-info text-white' : ''; ?>" href="http://localhost/news/register.php">註冊</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="http://localhost/news/login.php">登入</a>
            </li>
            <?php endif; ?>
            <?php if (isset($_SESSION['login_user']) && $_SESSION['login_user']['stat'] === TRUE) :  ?>
            <li class="nav-item">
              <a class="nav-link"  href="http://localhost/news/function/logout.php">登出</a>
            </li>
            <?php endif; ?>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
<script type="text/javascript">
$(function() {
  $(window).scroll(function() {
    if ($(this).scrollTop() > 145) {          /* 要滑動到選單的距離 */
      $('.menu_bar').addClass('navFixed');   /* 幫選單加上固定效果 */
    } else {
      $('.menu_bar').removeClass('navFixed'); /* 移除選單固定效果 */
    }
  });
});
</script>
