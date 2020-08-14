<?php
require_once('../function/common_function.php');
$common_function_object = new Common_function();
if ($common_function_object->edit_user($_POST['id'], $_POST['password'], $_POST['management']))
{
    echo 'yes';
}
else
{
    echo 'no';
}
?>
