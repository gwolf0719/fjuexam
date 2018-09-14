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
        font-size:18px;
    }
    * {
        overflow: visible !important;
    }
    table, tr, td, th, tbody, thead, tfoot {
        page-break-inside: avoid !important;
        page-break-after:always;
    }    
    .W50{
        width:50%;
        float:left;
    }    
</style>

<table class="" id="" style="padding: 4px 0px;text-align:center">

    <tr>
        <td width="100%" colspan="6" style="font-size:21px;text-align:center;"><?=$_SESSION['year']?>學年度指定科目考試新北一考區</td>
    </tr>
    <tr>
        <td width="100%" colspan="6" style="font-size:18px;text-align:center;"><?=$area?><?=$school?>試場工作人員分配表 (<?=$date?>)</td>
    </tr>
    <tr style="background:#FFE4E7">
        <td class="bb">試場</th>
        <td class="bb" width="20%">考生起訖號碼</th>
        <td class="bb" width="35%">樓層別</th>
        <td class="bb">監試人員</th>
        <td class="bb">監試人員</th>
        <td class="bb">試務人員</th>
    </tr>
    <?php foreach ($part as $k => $v): ?>
    <tr>
        <td class="bb"><?=trim($v['field'])?></td>
        <td class="bb"><?=trim($v['start']) ?>~<?=trim($v['end']) ?></td>
        <td class="bb"><?=trim($v['floor']) ?></td>
        <td class="bb"><?=trim($v['supervisor_1'])?></td>
        <td class="bb"><?=trim($v['supervisor_2'])?></td>
        <td class="bb"><?=trim($v['allocation_code'])?>&emsp;<?=trim($v['voucher'])?></td>
    </tr>
    <?php endforeach; ?>
    <tr>
        <td style="text-align:left;">共計：<?=count($trial_count)*2+$patrol_count?>人</td>
    </tr>
</table>