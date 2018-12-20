<style>
    .bb {
        border: 1px solid #999999;
    }
   table{
        text-align: center;
        border-spacing: 0px;
        width:100%;
        font-family: serif,cursive;
    }
    td{
        font-size:16px;
        padding:5px 0px;
        font-family: serif,cursive;
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


<!-- <h3 style="text-align:center;">監試人員印領清冊</h3>

<h3>

</h3> -->

<table class="" id="" style="text-align:center;">
    <thead>
        <tr>
            <td colspan="11" style="font-size:26px;font-family: serif,cursive;"><?=$_SESSION['year']?>學年度英語聽力測驗<?=$_SESSION['ladder']?>考試新北一考區</td>
        </tr>
        <tr>
            <td colspan="11" style="font-size:22px;">監試人員印領清冊</td>
        </tr>
        <tr>
            <td colspan="4" style="font-size:22px;padding: 20px 0px;"> 分區：<?=$area?></td>
            <td colspan="4" style="font-size:22px;padding: 20px 0px;">考場：<?=$school?></td>
            <td colspan="4" style="font-size:22px;padding: 20px 0px;"> 印表日期：<?=date('Y/m/d')?></td>
        </tr>
        <tr>
            <td rowspan="2" class="bb" style="width:5%">試場</td>
            <td colspan="3" class="bb">監試人員(1)</td>
            <td rowspan="2" class="bb" style="width:145">簽名或蓋章</td>
            <td colspan="3" class="bb">監試人員(2)</td>
            <td rowspan="2" class="bb" style="width:145">簽名或蓋章</td>
        </tr>
        <tr>
            <td class="bb">監考費</td>
            <td class="bb">姓名</td>
            <td class="bb" style="width: 8%;">實領費用</td>
            <td class="bb">監考費</td>
            <td class="bb">姓名</td>
            <td class="bb" style="width: 8%;">實領費用</td>
        </tr>
    </thead>
    <?php foreach ($part as $k => $v): ?>
    <tr>
        <td class="bb"  style="width:8%;font-size:18px;font-weight:bold;">
            <?=trim($v['field'])?>
        </td>
        <td class="bb" style="width:8%;font-size:18px;font-weight:bold;" >
            <?=trim(number_format($v['first_member_salary_section']))?>
        </td>
        <td class="bb" style="width:8%"><?=trim($v['supervisor_1'])?>
        </td>
        <td class="bb" style="width:8%;font-size:18px;font-weight:bold;" >
            <?=$v['first_member_section_salary_total'];?>
        </td>
        <td class="bb" style="padding: 30px 0px;"></td>
        <td class="bb" style="width:8%;font-size:18px;font-weight:bold;" >
            <?=trim(number_format($v['second_member_salary_section']))?>
        </td>
        <td class="bb" style="width:8%"><?=trim($v['supervisor_2'])?>
        </td>
        <td class="bb" style="width:8%;font-size:18px;font-weight:bold;" >
            <?= $v['second_member_section_salary_total'];?>
        </td>
        <!-- <td class="bb" style="width:8%;font-size:18px;font-weight:bold;" >
            <?php
            if ($v['order_meal2'] == "N") {
                echo number_format($v['second_member_section_salary_total'] - 0);
            } else {
                echo number_format($v['second_member_section_salary_total'] - abs($v['second_member_section_lunch_total']));
            }
            ?>
        </td> -->
        <td class="bb" style="padding: 30px 0px;"></td>
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
        <td colspan="11" style="text-align:left;font-size:18px;font-weight:bold">共計:<?=$count_member?>人 實發監考費：<?=number_format($salary)?> + 餐費： <?=number_format($lunch)?> = 總支出費用<?=number_format($salary+$lunch)?> </td>
    </tr>
</table>
