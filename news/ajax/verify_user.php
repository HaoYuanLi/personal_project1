<?php
require_once('../function/common_function.php');
$common_function_object = new Common_function();
$result = $common_function_object->verify_user($_POST['username'], $_POST['password']);
if ($result === TRUE)
{
    echo json_encode('yes');
}
elseif ($result === FALSE)
{
    echo json_encode('no');
}
else
{
    echo json_encode($result);
}
?>
