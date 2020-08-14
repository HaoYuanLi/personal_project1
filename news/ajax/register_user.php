<?php
require_once('../function/common_function.php');
require_once('../function/email.php');
$common_function_object = new Common_function();
$validation_code = $common_function_object->register_user($_POST['gender'], $_POST['birthday'], $_POST['contact_number'], $_POST['email_address'], $_POST['username'], $_POST['password'], $_POST['nickname']);
if ($validation_code !== FALSE)
{
    email($_POST['nickname'], $_POST['email_address'], $validation_code);
    echo json_encode(array('username' => $_POST['username'], 'nickname' => $_POST['nickname'],'email_address' => $_POST['email_address']));
}
else
{
    echo json_encode('no');
}
?>
