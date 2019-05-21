<style>
@font-face {
    font-family: serif, cursive;
}

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
    padding: 5px 0px;
    font-size: 16px;
    font-family: serif, cursive;
}

* {
    overflow: visible !important;
    font-family: serif;
}

table,
tr,
td,
th,
tbody,
thead,
tfoot {
    page-break-inside: avoid !important;
}

.W50 {
    width: 50%;
    float: left;
}
</style>


<!-- <h3 style="text-align:center;">監試人員印領清冊</h3>

<h3>

</h3> -->

<table class="" id="" style="padding:15px;text-align:center;">
    <thead>
        <tr>
            <td colspan="10" style="font-size:30px;"><?= $_SESSION['year'] ?>學年度英語聽力測驗<?= $_SESSION['ladder'] ?>考試新北一考區
            </td>
        </tr>
        <tr>
            <td colspan="10" style="font-size:26px;padding: 20px 0px;">試務人員印領清冊</td>
        </tr>
        <tr>
            <td colspan="2" style="font-size:26px;text-align:left;padding:20px 0px">
                分區：<?= $this->config->item('partition')[$test_partition] ?></td>
            <td colspan="4" style="font-size:26px;text-align:center;padding:20px 0px;position: relative;">
                考場：<?= $school['area_name'] ?></td>
            <td colspan="3" style="font-size:26px;text-align:right;padding:20px 0px"> 印表日期：<?= date('Y/m/d') ?></td>
        </tr>
        <tr>
            <td class="bb" style="font-size:22px;">姓名</td>
            <td colspan="2" class="bb" style="font-size:22px;">職務</td>

            <td colspan="2" class="bb" style="font-size:22px;">應領費用</td>
            <td colspan="2" class="bb" style="font-size:22px;">簽名或蓋章</td>
            <td colspan="2" class="bb" style="font-size:22px;weight:10px;">備註</th>
        </tr>
    </thead>
    <?php foreach ($part as $k => $v) : ?>
    <tr style="height: 30px;">
        <td class="bb" style="font-size:22px;width: 10%;"><?= $v['name'] ?>
        </td>
        <td colspan="2" class="bb" style="font-size:22px;width: 20%;"><?= $v['job'] ?>
        </td>
        <!-- <td class="bb" style="font-size:18px;font-weight:bold;"><?= number_format($v['one_day_salary']) ?>
        </td> -->
        <td colspan="2" class="bb" style="font-size:22px;font-weight:bold;width: 15%;"><?= number_format($v['total']) ?>
        </td>
        <td colspan="2" class="bb" style="width: 15%;"></td>
        <td colspan="2" class="bb" style="width: 15%;"><?= $v['note'] ?></td>
    </tr>
    <?php endforeach; ?>
    <tr>
        <?php
        if (!empty($part)) {
            $count = count($part);
        } else {
            $count = 0;
        }
        ?>
        <td colspan="12" style="text-align:left;font-size:18px;font-weight:bold;">共計:<?= $count ?>人
            實發監考費：<?= number_format($salary) ?> = 總支出費用<?= number_format($salary) ?> </td>
    </tr>
</table>