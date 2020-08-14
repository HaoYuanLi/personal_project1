<?php
require_once('../function/common_function.php');
$common_function_object = new Common_function();
if ($common_function_object->add_work($_POST['title'], $_POST['intro'], $_POST['video_path'], $_POST['youtube_link'], $_POST['publish']))
{
    echo 'yes';
}
else
{
    echo 'no';
}
?>
