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
        padding: 15px 0px;
        font-size:16px;
    }
    th{
        padding: 15px 0px;
        font-size:16px;
    }
    * {
        overflow: visible !important;
    }
    table, tr, td, th, tbody, thead, tfoot {
        page-break-before: always;
        page-break-inside: avoid;
    }
    .W50{
        width:50%;
        float:left;
    }
</style>

<table class="" id="" style="padding: 15px 0px;text-align:center;">

    <tr>
        <td width="100%" colspan="7" style="font-size:26px;text-align:center;"><?=$_SESSION['year']?>學年度高中英語能力測驗新北一考區</td>
    </tr>
    <tr>
        <td width="100%" colspan="7" style="font-size:22px;text-align:center;"><?=$area?><?=$school['ladder']?>試場工作人員分配表 (<?=$date?>)</td>
    </tr>
    <tr style="background:#FFE4E7">
        <th class="bb">試場</th>
        <th class="bb">節次</th>
        <th class="bb">考生起訖號碼</th>
        <th class="bb">樓層別</th>
        <th class="bb">監試人員</th>
        <th class="bb">監試人員</th>
        <th class="bb">試務人員</th>
    </tr>
    <?php foreach ($part as $k => $v): ?>
    <tr>
        <td class="bb"><?=trim($v['field'])?></td>
        <td class="bb"><?=$v['test_section']?></td>
        <td class="bb"><?=trim($v['start']) ?>~<?=trim($v['end']) ?></td>
        <td class="bb"><?=trim($v['floor']) ?></td>
        <td class="bb"><?=trim($v['supervisor_1'])?></td>
        <td class="bb"><?=trim($v['supervisor_2'])?></td>
        <td class="bb"><?=trim($v['allocation_code'])?>&emsp;<?=trim($v['voucher'])?></td>
    </tr>
    <?php endforeach; ?>
    <tr>
        <td style="text-align:left;font-size:16px;">共計：<?=count($trial_count)*2+$patrol_count?>人</td>
    </tr>
</table>
