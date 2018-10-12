<style>
    .bb {
        border: 1px solid #999999;
    }
    table{
        text-align: center;
        border-spacing: 0px;
        width:100%;
    }
    td{
        padding: 5px 0px;
        font-size:14px;
    }
    * {
        overflow: visible !important;
    }
    table, tr, td, th, tbody, thead, tfoot {
        page-break-before: always;
        page-break-inside: avoid;
    }    
    .W50{
        width:50%;
        float:left;
    }
</style>

<?php foreach ($part as $k => $v): ?>
<table style="padding:2px 0px;text-align:center;">
    <thead>
        <tr>
            <td colspan="5" style="font-size:22px;text-align:center;"><?=$_SESSION['year']?>學年度指定科目考試新北一考區</td>
        </tr>
        <tr>
            <td colspan="5" style="font-size:18px;text-align:center;"><?=$_GET['area']?><?=$school?>試題本、答案卷卡收發記錄單</td>
        </tr>        
        <tr>
            <td colspan="5" style="font-size:18px;text-align:left;font-weight:bold;">管卷人員：<?=$k?></td>
        </tr>    
        <tr>
            <td class="bb" colspan="2">日期 科目</td>
            <td class="bb" colspan="3"><?=mb_substr($datetime_info['day_3'], 5, 8, 'utf-8'); ?></td>
        </tr>
        <tr>
            <td class="bb" style="width: 15%;">試場</td>
            <td class="bb" style="width: 15%;">監試人員</td>
            <td class="bb">第1節<br>歷史</td>
            <td class="bb">第2節<br>地理</td>
            <td class="bb">第3節<br>公民與社會</td>        
        </tr>      
    </thead>
    <?php foreach ($v as $kc => $vc): ?>
    <tr>
        <td class="bb" rowspan="2" style="font-size:18px;"><?=$vc['field']?></td>
        <td class="bb"><?=$v['supervisor_1']?></td>
        <td class="bb" style="font-weight:bold;font-size:18px;">            
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
        <td class="bb" style="font-weight:bold;font-size:18px;">            
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
        <td class="bb" style="font-weight:bold;font-size:18px;">            
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
        <td class="bb" style="font-weight:bold;font-size:18px;">           
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
        <td class="bb" colspan="2" style="font-weight:bold;font-size:26px;">管卷人員簽收記錄表</td>
        <td class="bb" style="font-weight:bold;font-size:18px;">           
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
        <td class="bb" style="font-weight:bold;font-size:18px;">           
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
        <td class="bb" style="font-weight:bold;font-size:18px;">
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
