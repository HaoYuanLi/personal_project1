<?php
require_once('../function/common_function.php');
$common_function_object = new Common_function();
if ($common_function_object->verify_nickname($_POST['nickname']))
{
    echo 'yes';
}
else
{
    echo 'no';
}
?>
