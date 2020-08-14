<?php
/**
 * 頁數陣列
 * @author Hao-Yuang Li
 * @version 1.02
 */
function pages_switch($data_nums, //資料總比數
                      $pages, //總頁數
                      $site //指定頁面網址
) {
    if ($pages >= 1)
    {
        echo '共'.$data_nums.'筆&nbsp';
        for ($i = 1; $i <= $pages; $i++)
        {
            echo "<li class='page-item'><a class='page-link' href='".$site.'?page='.$i."'>".$i.'</a></li>';
        }
        echo '&nbsp共'.$pages.'頁';
    }
    else
    {
        die('總頁數小於1');
    }
}
?>
