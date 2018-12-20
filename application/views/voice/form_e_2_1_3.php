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
        font-size:16px;
    }
    * {
        overflow: visible !important;
    }
    table, tr, td, th, tbody, thead, tfoot {
        page-break-before: always;
        page-break-inside: avoid;
    }

    /* table td {
        word-break: break-all;
    }     */
    .W50{
        width:50%;
        float:left;
    }
</style>

<?php foreach ($part as $k => $v): ?>

<table class="" id="" style="padding:5px 0px;;text-align:center;">
    <tr>
        <td style="font-size:26px;lne-height:50px;" colspan="6"><?=$_SESSION['year']?>學年度英語聽力測驗<?=$_SESSION['ladder']?>考試新北一考區試務人員簽到表</td>
    </tr>
    <tr>
        <td colspan="2" style="font-size:20px;text-align:left;padding:20px 0px">分區：<?=$area?></td>
        <td colspan="2" style="font-size:20px;text-align:center;padding:20px 0px"><?=$school['area_name']?></td>
        <td colspan="2" style="font-size:20px;text-align:right;padding:20px 0px">簽到日期：<?=$k?></td>
    </tr>
    <tr>
        <td style="border:1px solid #999" width="15%">職務</td>
        <td style="border:1px solid #999" width="15%">姓名</td>
        <td style="border:1px solid #999" width="15%">單位別</td>
        <td style="border:1px solid #999" width="30%">簽名</td>
        <td style="border:1px solid #999" width="15%">備註(工作分配)</td>
    </tr>
    <?php foreach ($v as $kc => $vc): ?>
    <tr>
        <td style="border:1px solid #999"><?=$vc['job']?></td>
        <td style="border:1px solid #999"><?=$vc['name']?></td>
        <td style="border:1px solid #999"><?=$vc['member_unit']?></td>
        <td style="border:1px solid #999"></td>
        <td style="border:1px solid #999"><?=$vc['note']?></td>
    </tr>
    <?php endforeach; ?>
    <tr>
        <td colspan="7" style="font-size:16px;text-align:left;">共計：<?=count($v)?>人</td>
    </tr>
</table>
<?php endforeach; ?>
