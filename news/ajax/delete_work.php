<?php
require_once('../function/common_function.php');
$common_function_object = new Common_function();
if ($common_function_object->delete_work($_POST['work_id']))
{
    echo 'yes';
}
else
{
    echo 'no';
}
?>
