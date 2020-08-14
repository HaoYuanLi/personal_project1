<?php
/**
 * 檔案上傳
 * @author Hao-Yuang Li
 * @version 1.02
 */
//file_exists是判別該檔案是否存在於server上
if (file_exists($_FILES['file']['tmp_name']))
{
    $target_folder = $_POST['save_path'];
    $file_name = $_FILES['file']['name'];
    if (move_uploaded_file($_FILES['file']['tmp_name'], '../'.$target_folder.$file_name))
    {
        echo 'yes';
    }
    else
    {
        echo "檔案搬移失敗,請確認{$_POST['save_path']}資料夾是否可寫入";
    }
}
else
{
    echo '暫存檔不存在,上傳失敗';
}
?>
