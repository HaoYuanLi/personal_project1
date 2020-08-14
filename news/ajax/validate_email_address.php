<?php
require_once('../function/common_function.php');
$common_function_object = new Common_function();
$result = $common_function_object->validate_email_address($_POST['email_address'], $_POST['validation_code']);
if ($result === 1)
{
    echo 'no_1';
}
elseif ($result === 2)
{
    echo 'no_2';
}
else
{
    echo 'yes';
}
?>
