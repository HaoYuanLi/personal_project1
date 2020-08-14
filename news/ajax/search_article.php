<?php
require_once('../function/common_function.php');
$common_function_object = new Common_function();
if ($common_function_object->search_article($_POST['keyword']))
{
    echo 'yes';
}
else
{
    echo 'no';
}
?>
