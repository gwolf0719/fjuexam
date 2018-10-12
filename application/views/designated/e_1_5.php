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
        padding: 15px 0px;
        font-size:14px;
    }
    th{
        padding: 15px 0px;
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

<table class="" id="" style="padding:4px 0px;text-align:center;">
    <thead>
        <tr>
            <td colspan="7" style="font-size:22px;"><?=$_SESSION['year']?>學年度指定科目考試新北一考區<?=$area?>監試人員午餐一覽表</td>
        </tr>    
        <tr>
            <th class="bb" rowspan="2">試場</th>
            <th class="bb" colspan="3" class="bb">監試委員(1)</th>
            <th class="bb" colspan="3" class="bb">監試委員(2)</th>
        </tr>
        <tr>
            <td class="bb">姓名</td>
            <td class="bb">人員代碼</td>
            <td class="bb">餐別</td>
            <td class="bb">姓名</td>
            <td class="bb">人員代碼</td>
            <td class="bb">餐別</td>
        </tr>
    </thead>
    <?php foreach ($part as $k => $v): ?>
    <tr>
        <td class="bb">
            <?=$v['field']?>
        </td>
        <td class="bb">
            <?=$v['supervisor_1']?>
        </td>
        <td class="bb">
            <?=mb_substr($v['trial_staff_code_1'], 1, 4, 'utf-8'); ?>
        </td>
        <td class="bb">
            <?=$v['order_meal_1']?>
        </td>
        <td class="bb">
            <?=$v['supervisor_2']?>
        </td>
        <td class="bb">
            <?=mb_substr($v['trial_staff_code_2'], 1, 4, 'utf-8'); ?>
        </td>
        <td class="bb">
            <?=$v['order_meal_2']?>
        </td>
    </tr>
    <?php endforeach; ?>
    <tr>
        <?php 
            if(!empty($count)){
                $count_member = (count($count)*2);
            }else{
                $count_member = 0;
            }
        ?>        
        <td colspan="7" style="text-align:left;font-size:14px;">共計：<?=$count_member?>人、自備：<?=$own?>人、素食：<?=$veg?>人、葷食：<?=$meat?>人</td>
    </tr>
</table>