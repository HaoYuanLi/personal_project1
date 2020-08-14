<?php
@session_start();
unset($_SESSION['time_out']);
unset($_SESSION['login_user']);
header("Location:../index.php?msg=登出成功,返回首頁");
?>
