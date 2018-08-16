<style>

    .bb {
        border: 1px solid #999999;
    }


</style>

<?php foreach ($part as $k => $v): ?>
<table style="padding:2px 0px;text-align:center;">
    <thead>
        <tr>
            <td colspan="5" style="font-size:16px;text-align:center;"><?=$_SESSION['year']?>學年度指定科目考試新北一考區</td>
        </tr>
        <tr>
            <td colspan="5" style="font-size:16px;text-align:center;"><?=$_GET['area']?><?=$school?>試題本、答案券收發記錄單</td>
        </tr>        
        <tr>
            <td colspan="5" style="font-size:13px;text-align:left;">管券人員：<?=$k?></td>
        </tr>    
        <tr>
            <td class="bb" colspan="2">日期 科目</td>
            <td class="bb" colspan="3"><?=mb_substr($datetime_info['day_3'], 5, 8, 'utf-8'); ?></td>
        </tr>
        <tr>
            <td class="bb">試場</td>
            <td class="bb">監試人員</td>
            <td class="bb">第1節<br>歷史</td>
            <td class="bb">第2節<br>地理</td>
            <td class="bb">第3節<br>公民與社會</td>        
        </tr>      
    </thead>
    <?php foreach ($v as $kc => $vc): ?>
    <tr>
        <td class="bb" rowspan="2"><?=$vc['field']?></td>
        <td class="bb"><?=$v['supervisor_1']?></td>
        <td class="bb">            
        <?php
            switch ($vc['subject_08']) {
                case '0':
                    echo 'X';
                    break;
                default:
                    echo '';
            }
        ?>
        </td>
        <td class="bb">            
        <?php
            switch ($vc['subject_09']) {
                case '0':
                    echo 'X';
                    break;
                default:
                    echo '';
            }
        ?>
        </td>
        <td class="bb">            
        <?php
            switch ($vc['subject_10']) {
                case '0':
                    echo 'X';
                    break;
                default:
                    echo '';
            }
        ?>
        </td>            
    </tr>
    <tr>
        <td class="bb"><?=$vc['supervisor_2']?></td>
        <td class="bb">           
        <?php
            switch ($vc['subject_08']) {
                case '0':
                    echo 'X';
                    break;
                default:
                    echo '';
            }
        ?>
        </td>            
        <td class="bb">           
        <?php
            switch ($vc['subject_09']) {
                case '0':
                    echo 'X';
                    break;
                default:
                    echo '';
            }
        ?>
        </td>
        <td class="bb">
        <?php
            switch ($vc['subject_10']) {
                case '0':
                    echo 'X';
                    break;
                default:
                    echo '';
            }
        ?>
        </td>
    </tr>    
    <tr>
        <td class="bb" colspan="2">管券人員簽收記錄表</td>
        <td class="bb">           
        <?php
            switch ($vc['subject_08']) {
                case '0':
                    echo 'X';
                    break;
                default:
                    echo '';
            }
        ?>
        </td>            
        <td class="bb">           
        <?php
            switch ($vc['subject_09']) {
                case '0':
                    echo 'X';
                    break;
                default:
                    echo '';
            }
        ?>
        </td>
        <td class="bb">
        <?php
            switch ($vc['subject_10']) {
                case '0':
                    echo 'X';
                    break;
                default:
                    echo '';
            }
        ?>
        </td>
    </tr>         
    <?php endforeach;?>      
</table>
<?php endforeach;?>
