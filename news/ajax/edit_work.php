<?php
require_once('../function/common_function.php');
$common_function_object = new Common_function();
if ($common_function_object->edit_work($_POST['work_id'], $_POST['title'], $_POST['intro'], $_POST['video_path'], $_POST['youtube_link'], $_POST['publish']))
{
    echo 'yes';
}
else
{
    echo 'no';
}
?>
