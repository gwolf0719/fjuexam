<style>
.bb {
    border: 1px solid #999999;
}

table {
    text-align: center;
    border-spacing: 0px;
    width: 100%;
    font-family: serif, cursive;
}

td {
    font-size: 16px;
    padding: 5px 0px;
    font-family: serif, cursive;
}

* {
    overflow: visible !important;
}

table,
tr,
td,
th,
tbody,
thead,
tfoot {
    page-break-before: always;
    page-break-inside: avoid;
}

.W50 {
    width: 50%;
    float: left;
}
</style>


<!-- <h3 style="text-align:center;">監試人員'subject_ability_layout'</h3>
<h3>
</h3> -->

<table class="" id="" style="text-align:center;">
    <thead>
        <tr>
            <td colspan="11" style="font-size:26px;font-family: serif,cursive;"><?= $_SESSION['year'] ?>學年度指定科目考試新北一考區
            </td>
        </tr>
        <tr>
            <td colspan="11" style="font-size:22px;">監試人員印領清冊</td>
        </tr>
        <tr>
            <td colspan="4" style="font-size:22px;padding: 20px 0px;"> 分區：<?= $area ?></td>
            <td colspan="4" style="font-size:22px;padding: 20px 0px;">考場：<?= $school ?></td>
            <td colspan="4" style="font-size:22px;padding: 20px 0px;"> 印表日期：<?= date('Y/m/d') ?></td>
        </tr>
        <tr>
            <td rowspan="2" class="bb" style="width:5%">試場</td>
            <td colspan="4" class="bb">監試人員(1)</td>
            <td rowspan="2" class="bb" style="width:145">簽名或蓋章</td>
            <td colspan="4" class="bb">監試人員(2)</td>
            <td rowspan="2" class="bb" style="width:145">簽名或蓋章</td>
        </tr>
        <tr>
            <td class="bb">監考費</td>
            <td class="bb">姓名</td>
            <td class="bb">餐費</td>
            <td class="bb" style="width: 8%;">實領費用</td>
            <td class="bb">監考費</td>
            <td class="bb">姓名</td>
            <td class="bb">餐費</td>
            <td class="bb" style="width: 8%;">實領費用</td>
        </tr>
    </thead>
    <?php 
    $a1 = 0;
    $a2 = 0;
    $a3 = 0;

    ?>
    <?php foreach ($part as $k => $v) : ?>

    <?php 

    $a1 = $a1 + $v['first_member_salary_section'];
    $a1 = $a1 + $v['second_member_salary_section'];

    $a2 = $a2 + $v['first_member_section_lunch_total'];
    $a2 = $a2 + $v['second_member_section_lunch_total'];

    if ($v['supervisor_1'] != '') {
        $a3 = $a3 + 1;
    }
    if ($v['supervisor_2'] != '') {
        $a3 = $a3 + 1;
    }




    ?>






    <tr>
        <td class="bb" style="width:8%;font-size:18px;font-weight:bold;">
            <?= trim($v['field']) ?>
        </td>
        <td class="bb" style="width:8%;font-size:18px;font-weight:bold;">
            <?= number_format($v['first_member_salary_section']) ?>
        </td>
        <td class="bb" style="width:8%"><?= trim($v['supervisor_1']) ?>
        </td>
        <td class="bb" style="width:8%;font-size:18px;font-weight:bold;">
            <?php
            if ($v['order_meal1'] == "N") {
                echo 0;
            } else {
                echo abs($v['first_member_section_lunch_total']);
            }
            ?>
        </td>
        <td class="bb" style="width:8%;font-size:18px;font-weight:bold;">
            <?php
            if ($v['order_meal1'] == "N") {
                echo trim(number_format($v['first_member_section_salary_total'] - 0));
            } else {
                echo number_format($v['first_member_section_salary_total'] - abs($v['first_member_section_lunch_total']));
            }
            ?>
        </td>
        <td class="bb" style="padding: 30px 0px;"></td>
        <td class="bb" style="width:8%;font-size:18px;font-weight:bold;">
            <?= number_format($v['second_member_salary_section']) ?>
        </td>
        <td class="bb" style="width:8%"><?= trim($v['supervisor_2']) ?>
        </td>
        <td class="bb" style="width:8%;font-size:18px;font-weight:bold;">
            <?php
            if ($v['order_meal2'] == "N") {
                echo 0;
            } else {
                echo trim(number_format(abs($v['second_member_section_lunch_total'])));
            }
            ?>
        </td>
        <td class="bb" style="width:8%;font-size:18px;font-weight:bold;">
            <?php
            if ($v['order_meal2'] == "N") {
                echo number_format($v['second_member_section_salary_total'] - 0);
            } else {
                echo number_format($v['second_member_section_salary_total'] - abs($v['second_member_section_lunch_total']));
            }
            ?>
        </td>
        <td class="bb" style="padding: 30px 0px;"></td>
    </tr>
    <?php endforeach; ?>
    <tr>
        <?php
        if (!empty($count)) {
            $count_member = (count($count) * 2);
        } else {
            $count_member = 0;
        }
        ?>
        <td colspan="11" style="text-align:left;font-size:18px;font-weight:bold">共計:<?= $a3 ?>人
            實發監考費：<?= number_format($a1 - $a2) ?> + 餐費： <?= number_format($a2) ?> =
            總支出費用<?= number_format($a1) ?> </td>

    </tr>
</table>