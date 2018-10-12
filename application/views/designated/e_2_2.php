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
            <td style="font-size:22px;lne-height:50px;" colspan="9"><?=$_SESSION['year']?>學年度指定科目考試新北一考區監試人員簽到表</td>
        </tr>
        <tr>
            <td colspan="3" style="font-size:18px;">分區：<?=$area?></td>
            <td colspan="3" style="font-size:18px;"><?=$school?></td>
            <td colspan="3" style="font-size:18px;">簽到日期：<?=$k?></td>
        </tr>
        <tr>
            <td style="border:1px solid #999" rowspan="2">試場</td>
            <td style="border:1px solid #999" colspan="2" class="bb">監試人員(1)</td>
            <td style="border:1px solid #999" rowspan="2" colspan="2">簽名</td>
            <td style="border:1px solid #999" colspan="2" class="bb">監試人員(2)</td>
            <td style="border:1px solid #999" rowspan="2" colspan="2">簽名</td>
        </tr>

        <tr>
            <td style="border:1px solid #999">姓名</td>
            <td style="border:1px solid #999">單位別</td>
            <td style="border:1px solid #999">姓名</td>
            <td style="border:1px solid #999">單位別</td>
        </tr>
    </thead>     
    <?php foreach ($v as $kc => $vc): ?>
    <tr>
        <td style="border:1px solid #999"><?=$vc['field']?></td>
        <td style="border:1px solid #999"><?=$vc['supervisor_1']?><br><span style="color:#ff0000"><?=$vc['meal1']?></span></td>
        <td style="border:1px solid #999"><?=$vc['supervisor_1_unit']?></td>
        <td style="border:1px solid #999" colspan="2"></td>
        <td style="border:1px solid #999"><?=$vc['supervisor_2']?><br><span style="color:#ff0000"><?=$vc['meal2']?></span></td>
        <td style="border:1px solid #999"><?=$vc['supervisor_2_unit']?></td>
        <td style="border:1px solid #999" colspan="2"></td>
    </tr>
    <?php endforeach;?>
    <tr>
        <td colspan="9" style="font-size:14px;text-align:left;">共計：<?=(count($v)*2)?>人、自備:<?=$data['own']?>人、素食：<?=$data['veg']?>人、葷食：<?=$data['meat']?>人</td>
    </tr>
</table>
<?php endforeach;?>