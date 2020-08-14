<?php
require_once('../function/common_function.php');
$common_function_object = new Common_function();
if ($common_function_object->verify_username($_POST['username']))
{
    echo 'yes';
}
else
{
    echo 'no';
}
?>
