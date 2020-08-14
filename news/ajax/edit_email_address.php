<?php
require_once('../function/common_function.php');
$common_function_object = new Common_function();
if ($common_function_object->edit_email_address($_POST['nickname'], $_POST['email_address']))
{
    echo 'yes';
}
else
{
    echo 'no';
}
?>
