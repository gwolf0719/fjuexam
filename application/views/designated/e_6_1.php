<style>
    .bb{

        border: 1px solid #999999;
        text-align:center;
    }
</style>


<!-- <h3 style="text-align:center;">監試人員印領清冊</h3>

<h3>
   
</h3> -->

<table class="" id="" style="padding:4px;text-align:center;">
    <thead>
        <tr>
            <th colspan="12" style="font-size:18px;"><?=$_SESSION['year']?>學年度指定科目考試新北一考區</th>
        </tr>
        <tr>
            <th colspan="12" style="font-size:16px;">監試人員印領清冊</th>
        </tr>        
        <tr>
            <th colspan="4" style="font-size:13px;"> 分區：<?=$area?></th>
            <th colspan="4" style="font-size:13px;">考場：<?=$school?></th>
            <th colspan="4" style="font-size:13px;"> 印表日期<?=date('Y/m/d')?></th>
        </tr>
        <tr>
            <th rowspan="2" class="bb">試場</th>
            <th colspan="4" class="bb">監試人員(1)</th>
            <th rowspan="2" colspan="2" class="bb">簽名或蓋章</th>
            <th colspan="3" class="bb">監試人員(2)</th>
            <th rowspan="2" colspan="2" class="bb">簽名或蓋章</th>
        </tr>
        <tr>
            <td class="bb">監考費</td>
            <td class="bb">姓名</td>
            <td class="bb">餐費</td>
            <td class="bb">應領費用</td>
            <td class="bb">姓名</td>
            <td class="bb">餐費</td>
            <td class="bb">應領費用</td>
        </tr>
    </thead>
    <?php foreach ($part as $k => $v): ?>
    <tr>
        <td class="bb"><?=$v['field']?>
        </td>
        <td class="bb"><?=number_format($v['first_member_salary_section'])?>
        </td>
        <td class="bb"><?=$v['supervisor_1']?>
        </td>
        <td class="bb">
            <?php
            if ($v['order_meal1'] == "N") {
                echo 0;
            } else {
                echo number_format(abs($v['first_member_section_lunch_total']));
            }
            ?>
        </td>
        <td class="bb">
            <?php
            if ($v['order_meal1'] == "N") {
                echo number_format($v['first_member_section_salary_total'] - 0);
            } else {
                echo number_format($v['first_member_section_salary_total'] - abs($v['first_member_section_lunch_total']));
            }
            ?>
        </td>
        <td colspan="2" class="bb" style="line-height:30px;"></td>

        <td class="bb"><?=$v['supervisor_2']?>
        </td>
        <td class="bb">
            <?php
            if ($v['order_meal2'] == "N") {
                echo 0;
            } else {
                echo number_format(abs($v['second_member_section_lunch_total']));
            }
            ?>
        </td>
        <td class="bb">
            <?php
            if ($v['order_meal2'] == "N") {
                echo number_format($v['second_member_section_salary_total'] - 0);
            } else {
                echo number_format($v['second_member_section_salary_total'] - abs($v['second_member_section_lunch_total']));
            }
            ?>
        </td>
        <td colspan="2" class="bb"></td>
    </tr>
    <?php endforeach; ?>
    <tr>
        <td colspan="12" style="text-align:left;font-size:14px;">共計:<?=count($part)*2?>人</td>
    </tr>
</table>