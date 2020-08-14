<?php
require_once('../function/common_function.php');
$common_function_object = new Common_function();
if ($common_function_object->add_user($_POST['email_address'], $_POST['username'], $_POST['password'], $_POST['nickname'], $_POST['management']))
{
    echo 'yes';
}
else
{
    echo 'no';
}
?>
