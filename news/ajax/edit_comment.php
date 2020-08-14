<?php
require_once('../function/common_function.php');
$common_function_object = new Common_function();
if ($common_function_object->edit_comment($_POST['comment_id'], $_POST['comment_content']))
{
    echo 'yes';
}
else
{
    echo 'no';
}
?>
