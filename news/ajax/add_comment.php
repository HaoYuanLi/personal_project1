<?php
require_once('../function/common_function.php');
$common_function_object = new Common_function();
if ($common_function_object->add_comment($_POST['comment'], $_POST['id'], $_POST['source']))
{
    echo 'yes';
}
else
{
    echo 'no';
}
?>
