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
    .row div{
        float:left;

    }
</style>



<table class="" id="" style="padding:5px 0px;;text-align:center;">
    <tr>
        <td style="font-size:26px;lne-height:50px;" colspan="6"><?=$_SESSION['year']?>學年度英語聽力測驗<?=$_SESSION['ladder']?>考試新北一考區試務人員簽到表</td>
    </tr>
    <tr>
        <td colspan="5" class="row">
            <div class="col-xs-4" style="width:33%;text-align:left;">分區：<?=$area?></div>
            <div class="col-xs-4" style="width:33%;text-align:center;"><?=$school['area_name']?></div>
            <div class="col-xs-4" style="width:34%;text-align:right;"></div>
        </td>
        <!-- <td colspan="1" style="font-size:20px;text-align:left;padding:20px 0px"></td>
        <td colspan="2" style="font-size:20px;text-align:right;padding:20px 0px"></td>
        <td colspan="2" style="font-size:20px;text-align:right;padding:20px 0px"></td> -->
    </tr>
    <tr>
        <td style="border:1px solid #999" width="15%">職務</td>
        <td style="border:1px solid #999" width="15%">姓名</td>
        <td style="border:1px solid #999" width="15%">單位別</td>
        <td style="border:1px solid #999" width="30%">簽名</td>
        <td style="border:1px solid #999" width="15%">備註(工作分配)</td>
    </tr>
    <?php foreach ($part as $kc => $vc): ?>
    <tr>
        <td style="border:1px solid #999;height: 100px;"><?=$vc['job']?></td>
        <td style="border:1px solid #999;height: 100px;"><?=$vc['name']?></td>
        <td style="border:1px solid #999;height: 100px;"><?=$vc['member_unit']?></td>
        <td style="border:1px solid #999;height: 100px;"></td>
        <td style="border:1px solid #999;height: 100px;"><?=$vc['note']?></td>
    </tr>
    <?php endforeach; ?>
    <tr>
        <td colspan="7" style="font-size:16px;text-align:left;">共計：<?=count($part)?>人</td>
    </tr>
</table>

