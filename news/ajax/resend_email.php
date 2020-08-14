<?php
require_once('../function/common_function.php');
require_once('../function/email.php');
$common_function_object = new Common_function();
$validation_code = $common_function_object->recreate_validation_code($_POST['email_address']);
if ($validation_code !== FALSE)
{
    email($_POST['nickname'], $_POST['email_address'], $validation_code);
    echo 'yes';
}
else
{
   echo 'no';
}
?>
