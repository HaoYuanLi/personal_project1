<?php
@session_start();
$current_time = time();
if (isset($_SESSION['time_out']) && $current_time >= $_SESSION['time_out'] && isset($_SESSION['login_user']) && $_SESSION['login_user']['stat'] === TRUE)
{
    unset($_SESSION['time_out']);
    unset($_SESSION['login_user']);
    header('Location:http://localhost/news/index.php?msg=閒置超過30分鐘,已自動登出!!');
}
elseif(isset($_SESSION['login_user']) && $_SESSION['login_user']['stat'] === TRUE)
{
    $_SESSION['time_out'] = $current_time + 3600;
}
?>
