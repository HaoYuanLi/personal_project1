<?php
/**
 * 阻擋特定字串
 * @author Hao-Yuang Li
 * @version 1.02
 */
function filter($string, //待過濾字串
                $text //指定的文本
) {
    //去除空白
    $string = trim($string);
    //讀取關鍵字文字
    $keyword = file_get_contents('../files/'.$text.'.txt');
    //轉換成陣列
    $keyword_array = explode("、", $keyword);
    $filtered_string = ''; //存取過濾出的詞彙
    for ($i = 0; $i < count($keyword_array); $i++)
    {
        // 如果此陣列元素為空則跳過此次迴圈
        if ($keyword_array[$i] === '')
        {
            continue;
        }
        //不分大小寫,如果檢測到關鍵字,則返回匹配的關鍵字,並終止執行
        if (stripos($string, $keyword_array[$i]) !== FALSE)
        {
            $filtered_string = $filtered_string.$keyword_array[$i].' ';
        }
    }
    //如果沒有檢測到關鍵字則返回false
    if ($filtered_string === '')
    {
        return FALSE;
    }
    else
    {
        return $filtered_string;
    }
}
$result = filter($_POST['string'], $_POST['text']);
if ($result === FALSE)
{
    echo 'yes';
}
else
{
    echo "留言中有敏感字詞 : $result\n請先修正過後,再重新發送留言";
}
?>
