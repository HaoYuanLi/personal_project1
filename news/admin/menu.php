<?php
if (!isset($_SESSION['login_user']) OR @$_SESSION['login_user']['manager'] === 0 OR @$_SESSION['login_user']['stat'] === FALSE)
{
    header("Location:../index.php?msg=您無訪問後台的權限!!");
}
$sites_path = $_SERVER['PHP_SELF'];
$files_path = basename($sites_path, ".php");
switch ($files_path)
{
    case 'article_list':
    case 'article_add':
    case 'article_edit':
    $page_index = 1;
    break;

    case 'work_list':
    case 'work_add':
    case 'work_edit':
    $page_index = 2;
    break;

    case 'user_list':
    case 'user_add':
    case 'user_edit':
    $page_index = 3;
    break;

    case 'comment_list':
    $page_index = 4;
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
  <link rel="stylesheet" type="text/css" href="../css/style.css">
  <link rel="stylesheet" type="text/css" href="../css/lock_scrollbar.css">
</head>
<body>
<div class="jumbotron alert-warning">
  <div class="top">
    <h1 class="text-center">news新聞網(後台)</h1>
    <div class="container">
      <div class="row">
        <div class="col">
          <ul class="nav nav-pills nav-fill menu_bar alert-warning justify-content-center">
            <li class="nav-item">
              <a class="nav-link" href="http://localhost/news/index.php">前台首頁</a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php echo ($page_index === 0) ? 'bg-warning text-white' : ''; ?>" href="http://localhost/news/admin/index.php">後台首頁</a>
            </li>
            <li class="nav-item">
              <a class="nav-link  <?php echo ($page_index === 1) ? 'bg-warning text-white' : ''; ?>" href="http://localhost/news/admin/article_list.php">文章管理</a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php echo ($page_index === 2) ? 'bg-warning text-white' : ''; ?>" href="http://localhost/news/admin/work_list.php">影片管理</a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php echo ($page_index === 3) ? 'bg-warning text-white' : ''; ?>" href="http://localhost/news/admin/user_list.php">使用者管理</a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php echo ($page_index === 4) ? 'bg-warning text-white' : ''; ?>" href="http://localhost/news/admin/comment_list.php">留言管理</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="http://localhost/news/function/logout.php">登出</a>
            </li>
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
