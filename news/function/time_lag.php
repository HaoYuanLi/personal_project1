<?php
/**
 * 時間差計算
 * @author Hao-Yuang Li
 * @version 1.02
 */
//
function time_lag($create_time, //建立日期
                  $edit_count //編輯次數
) {
    $current_time = date('Y-m-d H:i:s');
    if ($edit_count > 0)
    {
        $string = '最後編輯於';
    }
    else
    {
        $string = '發表於';
    }
    $time_lag = (strtotime($current_time) - strtotime($create_time)) / (24 * 60 * 60 * 365.242199);
    if ($time_lag >= 1)
    {
        echo $string.floor($time_lag).'年前';
    }
    else
    {
        $time_lag = $time_lag * 365.242199 / 30.43685;
        if ($time_lag >= 1)
        {
            echo $string.floor($time_lag).'個月前';
        }
        else
        {
            $time_lag = $time_lag * 30.43685;
            if ($time_lag >= 1)
            {
                echo $string.floor($time_lag).'天前';
            }
            else
            {
                $time_lag = $time_lag * 24;
                if ($time_lag >= 1)
                {
                    echo $string.floor($time_lag).'小時前';
                }
                else
                {
                    $time_lag = $time_lag * 60;
                    if ($time_lag >= 1)
                    {
                        echo $string.floor($time_lag).'分前';
                    }
                    else
                    {
                        $time_lag = $time_lag * 60;
                        echo $string.floor($time_lag).'秒前';
                    }
                }
            }
        }
    }
}
?>
