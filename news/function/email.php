<?php
/**
 * 系統自動寄信
 * @author Hao-Yuang Li
 * @version 1.01
 */
require_once('../files/phpMailer/PHPMailer.php');
require_once('../files/phpMailer/SMTP.php');
function email($nickname, //暱稱
               $email_address, //電子郵件地址
               $validation_code //認證碼
) {
    $datetime_of_resend = date("Y-m-d H:i:s", strtotime('+10 minute'));
    $validation_code_validity_period = date("Y-m-d H:i:s", strtotime('+2 hours'));
    $link = "http://localhost/news/validate.php?nickname=".$nickname.'&email_address='.$email_address.'&validation_code='.$validation_code;
    $mail = new PHPMailer\PHPMailer\PHPMailer();
    $mail->SMTPSecure = "ssl";
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 465;
    $mail->CharSet = "utf-8"; //信件編碼
    $mail->Username = "hippoli1995@gmail.com"; //帳號
    $mail->Password = "hippoli1028"; //密碼
    $mail->IsSMTP();
    $mail->SMTPAuth = true;
    //$mail->SMTPDebug  = 1; //顯示phpMailer debug資料
    $mail->Encoding = "base64";
    $mail->IsHTML(true); //內容HTML格式
    $mail->From = "hippoli1995@gmail.com"; //寄件者信箱
    $mail->FromName = "News新聞網"; //寄信者姓名
    $mail->Subject = "您的 News新聞網 認證碼是 ".$validation_code; //信件主旨
    $mail->Body = '<div style = text-align:center;><p>'.$nickname.' 先生/女士,您好'.'</p>'.'<p>請前往認證頁面並輸入下方的認證碼,已完成認證</p><p>若您沒有申請註冊本網站的帳號,卻收到此信件,可以直接回覆該信件,之後會有系統人員幫您處理'.'</p><h2>'.$validation_code.'</h2><a style="margin-top:15px;" href="'.$link.'">前往認證頁面</a><p>認證碼將於兩小時後失效</p>'; //信件內容
    $mail->AddAddress($email_address); //收件者信箱
    if ( ! $mail->Send())
    {
        echo 'Mailer Error : ' . $mail->ErrorInfo;
    }
    else
    {
        setcookie("validation_code_validity_period", $validation_code_validity_period, time() + 7200, "/");
        setcookie("datetime_of_resend", $datetime_of_resend, time() + 600, "/");
    }
}
?>
