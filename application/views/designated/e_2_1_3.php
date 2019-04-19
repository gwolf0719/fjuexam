<style>
.bb {
    border: 1px solid #999999;
}

table {
    text-align: center;
    border-spacing: 0px;
    width: 100%;
}

td {
    padding: 5px 0px;
    font-size: 16px;
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

/* table td {
        word-break: break-all;
    }     */
.W50 {
    width: 50%;
    float: left;
}
</style>

<?php foreach ($part as $k => $v) : ?>

<table class="" id="" style="padding:5px 0px;;text-align:center;">
    <tr>
        <td style="font-size:26px;lne-height:50px;" colspan="6"><?= $_SESSION['year'] ?>學年度指定科目考試新北一考區試務人員簽到表</td>
    </tr>
    <tr>
        <td colspan="2" style="font-size:22px;text-align:left;padding:20px 0px">分區：<?= $area ?></td>
        <td colspan="2" style="font-size:22px;text-align:center;padding:20px 0px"><?= $school ?></td>
        <td colspan="2" style="font-size:22px;text-align:right;padding:20px 0px">簽到日期：<?= $k ?></td>
    </tr>
    <tr>
        <td style="border:1px solid #999" width="15%">職務</td>
        <td style="border:1px solid #999" width="15%">姓名</td>
        <td style="border:1px solid #999" width="15%">單位別</td>
        <td style="border:1px solid #999" colspan="2" width="30%">簽名</td>
        <td style="border:1px solid #999" width="15%">備註(工作分配)</td>
    </tr>
    <?php foreach ($v as $kc => $vc) : ?>
    <tr>
        <td style="border:1px solid #999"><?= $vc['job'] ?></td>
        <td style="border:1px solid #999"><?= $vc['name'] ?><br><span style="color:#ff0000"><?= $vc['meal'] ?></span>
        </td>
        <td style="border:1px solid #999"><?= $vc['member_unit'] ?></td>
        <td style="border:1px solid #999" colspan="2"></td>
        <td style="border:1px solid #999"><?= $vc['note'] ?></td>
    </tr>
    <?php endforeach; ?>
    <?php
    $own_count = 0;
    for ($i = 0; $i < count($v); $i++) {
            # code...
        if ($v[$i]['meal'] == '自備') {
            $own_count += 1;
        }
    }
    $veg_count = 0;
    for ($i = 0; $i < count($v); $i++) {
            # code...
        if ($v[$i]['meal'] == '素') {
            $veg_count += 1;
        }
    }
    $meat_count = 0;
    for ($i = 0; $i < count($v); $i++) {
            # code...
        if ($v[$i]['meal'] == '葷') {
            $meat_count += 1;
        }
    }
    ?>
    <tr>
        <td colspan="7" style="font-size:16px;text-align:left;">
            共計：<?= count($v) ?>人、自備：<?= $own_count ?>人、素食：<?= $veg_count ?>人、葷食：<?= $meat_count ?>人</td>
    </tr>
</table>
<?php endforeach; ?>