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
        font-size:21px;
    }
    * {
        overflow: visible !important;
    }
    table, tr, td, th, tbody, thead, tfoot {
        page-break-inside: avoid !important;
    }    
    .W50{
        width:50%;
        float:left;
    }   
</style>


<!-- <h3 style="text-align:center;">監試人員印領清冊</h3>

<h3>
   
</h3> -->

<table class="" id="" style="padding:4px 0px;text-align:center;">
    <thead>
        <tr>
            <th colspan="13" style="font-size:36px;"><?=$_SESSION['year']?>學年度指定科目考試新北一考區</th>
        </tr>
        <tr>
            <th colspan="13" style="font-size:21px;">身障生試場監試人員印領清冊</th>
        </tr>        
        <tr>
            <th colspan="4" style="font-size:21px;"> 分區：<?=$area?>(身障)</th>
            <th colspan="4" style="font-size:21px;">考場：<?=$school?></th>
            <th colspan="4" style="font-size:21px;"> 印表日期<?=date('Y/m/d')?></th>
        </tr>
        <tr>
            <th rowspan="2" class="bb">試場</th>
            <th colspan="4" class="bb">監試人員(1)</th>
            <th rowspan="2" colspan="2" class="bb">簽名或蓋章</th>
            <th colspan="4" class="bb">監試人員(2)</th>
            <th rowspan="2" colspan="2" class="bb">簽名或蓋章</th>
        </tr>
        <tr>
            <td class="bb">監考費</td>
            <td class="bb">姓名</td>
            <td class="bb">餐費</td>
            <td class="bb">應領費用</td>
            <td class="bb">監考費</td>
            <td class="bb">姓名</td>
            <td class="bb">餐費</td>
            <td class="bb">應領費用</td>
        </tr>
    </thead>
    <?php foreach ($part as $k => $v): ?>
    <tr>
        <td class="bb"><?=trim($v['field'])?></td>
        <td class="bb">
            <?=trim(number_format($v['first_member_section_salary_total']))?>
        </td>
        <td class="bb"><?=trim($v['supervisor_1'])?></td>
        <td class="bb">
            <?php
            if ($v['order_meal1'] == "N") {
                echo 0;
            } else {
                echo 0 - number_format(abs($v['first_member_section_lunch_total']));
            }
            ?>
        </td>
        <td class="bb">
            <?php
            if ($v['order_meal1'] == "N") {
                echo trim(number_format($v['first_member_section_salary_total'] - 0));
            } else {
                echo trim(number_format($v['first_member_section_salary_total'] - abs($v['first_member_section_lunch_total'])));
            }
            ?>
        </td>
        <td colspan="2" class="bb" style="line-height:30px;"></td>
        <td class="bb">
            <?=trim(number_format($v['second_member_section_salary_total']))?>
        </td>
        <td class="bb"><?=trim($v['supervisor_2'])?></td>
        <td class="bb">
            <?php
            if ($v['order_meal2'] == "N") {
                echo 0;
            } else {
                echo 0 - trim(number_format(abs($v['second_member_section_lunch_total'])));
            }
            ?>
        </td>
        <td class="bb">
            <?php
            if ($v['order_meal2'] == "N") {
                echo trim(number_format($v['second_member_section_salary_total'] - 0));
            } else {
                echo trim(number_format($v['second_member_section_salary_total'] - abs($v['second_member_section_lunch_total'])));
            }
            ?>
        </td>
        <td colspan="2" class="bb"></td>
    </tr>
    <?php endforeach; ?>
    <tr>
        <?php 
            if(!empty($count)){
                $count = (count($count)*2);
            }else{
                $count = 0;
            }
        ?>        
        <td colspan="12" style="text-align:left;font-size:21px;">共計:<?=$count?>人 實發監考費：<?=number_format($salary)?> + 餐費： <?=number_format($lunch)?> = 總支出費用<?=number_format($salary+$lunch)?> </td>
    </tr>
</table>