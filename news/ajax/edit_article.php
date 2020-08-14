<?php
require_once('../function/common_function.php');
$common_function_object = new Common_function();
if ($common_function_object->edit_article($_POST['id'], $_POST['title'], $_POST['category'], $_POST['content'], $_POST['publish']))
{
    echo 'yes';
}
else
{
    echo 'no';
}
?>
