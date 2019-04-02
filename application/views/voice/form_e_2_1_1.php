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
    .item{
        height:80px;
    }
</style>



<table class="" id="" style="padding:5px 0px;;text-align:center;">
    <tr>
        <td style="font-size:30px;lne-height:50px;" colspan="9"><?=$_SESSION['year']?>學年度英語聽力測驗<?=$_SESSION['ladder']?>考試新北一考區試務人員簽到表</td>
    </tr>
    <tr>
        <td colspan="2" style="font-size:22px;text-align:left;padding:20px 0px">分區：<?= $this->config->item('partition')[$area] ?></td>
        <td colspan="3" style="font-size:22px;text-align:center;padding:20px 0px"><?=$school['area_name']?></td>
        <!-- <td colspan="2" style="font-size:22px;text-align:right;padding:20px 0px"></td> -->
    </tr>
    <tr>
        <td style="border:1px solid #999" width="15%">職務</td>
        <td style="border:1px solid #999" width="10%">姓名</td>
        <td style="border:1px solid #999" width="15%">職稱</td>
        <td style="border:1px solid #999" width="15%">單位別</td>
        <td style="border:1px solid #999" colspan="2" width="22%">簽名</td>
        <td style="border:1px solid #999" width="22%">備註(工作分配)</td>
    </tr>
    <?php foreach ($part as $kc => $vc): ?>
    <tr class="item">
        <td style="border:1px solid #999;height:100px;font-size:20px;text-align:left;padding:5px" nowrap="nowrap"><?=$vc['job']?></td>
        <td style="border:1px solid #999;height:100px;font-size:20px;padding:5px" nowrap="nowrap"><?=$vc['name']?></td>
        <td style="border:1px solid #999;height:100px;font-size:20px;padding:5px;" nowrap="nowrap"><?=$vc['job_title']?></td>
        <td style="border:1px solid #999;height:100px;font-size:20px;text-align:left;padding:5px;" nowrap="nowrap"><?=$vc['member_unit']?></td>
        <td style="border:1px solid #999;height:100px;font-size:20px;text-align:left;padding:5px" nowrap="nowrap" colspan="2"></td>
        <td style="border:1px solid #999;height:100px;font-size:20px;text-align:left;padding:5px" nowrap="nowrap"><?=$vc['note']?></td>
    </tr>
    <?php endforeach; ?>
    <tr>
        <td colspan="7" style="font-size:20px;text-align:left;">共計：<?=count($part)?>人</td>
    </tr>
</table>

