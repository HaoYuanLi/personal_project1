<?php
require_once('../function/common_function.php');
$common_function_object = new Common_function();
if ($common_function_object->edit_account_setting($_POST['password'], $_POST['gender'], $_POST['birthday'], $_POST['contact_number']))
{
    echo 'yes';
}
else
{
    echo 'no';
}
?>
