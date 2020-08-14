<?php
require_once('../function/common_function.php');
$common_function_object = new Common_function();
if ($common_function_object->delete_article($_POST['article_id']))
{
    echo 'yes';
}
else
{
    echo 'no';
}
?>
