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
        padding: 8px 0px;
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
    <thead>
        <tr>
            <td style="font-size:26px;lne-height:50px;" colspan="9"><?=$_SESSION['year']?>學年度英語能力測驗<?=$_SESSION['ladder']?>考試新北一考區監試人員簽到表</td>
        </tr>
        <tr>
            <td colspan="3" style="font-size:22px;padding:20px 0px">分區：<?=$area?></td>
            <td colspan="3" style="font-size:22px;padding:20px 0px"><?=$school['area_name']?></td>
            <td colspan="3" style="font-size:22px;padding:20px 0px">簽到日期：<?=$k?></td>
        </tr>
        <tr>
            <td style="border:1px solid #999" rowspan="2" width="10%">試場</td>
            <td style="border:1px solid #999" colspan="2" width="10%" class="bb">監試人員(1)</td>
            <td style="border:1px solid #999" rowspan="2" width="20%" colspan="2">簽名</td>
            <td style="border:1px solid #999" colspan="2" width="10%" class="bb">監試人員(2)</td>
            <td style="border:1px solid #999" rowspan="2" width="20%" colspan="2">簽名</td>
        </tr>

        <tr>
            <td style="border:1px solid #999" width="11%">姓名</td>
            <td style="border:1px solid #999" width="10%">單位別</td>
            <td style="border:1px solid #999" width="10%">姓名</td>
            <td style="border:1px solid #999" width="10%">單位別</td>
        </tr>
    </thead>
    <?php foreach ($v as $kc => $vc): ?>
    <tr>
        <td style="border:1px solid #999"><?=$vc['field']?></td>
        <td style="border:1px solid #999"><?=$vc['supervisor_1']?></td>
        <td style="border:1px solid #999"><?=$vc['supervisor_1_unit']?></td>
        <td style="border:1px solid #999" colspan="2"></td>
        <td style="border:1px solid #999"><?=$vc['supervisor_2']?></td>
        <td style="border:1px solid #999"><?=$vc['supervisor_2_unit']?></td>
        <td style="border:1px solid #999" colspan="2"></td>
    </tr>
    <?php endforeach;?>
    <tr>
        <td colspan="9" style="font-size:16px;text-align:left;">共計：<?=(count($v)*2)?>人</td>
    </tr>
</table>
<?php endforeach;?>
