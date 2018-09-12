<style>
    .bb {
        border: 1px solid #999999;
    }
</style>

<table class="" id="" style="padding: 4px 0px;text-align:center">
    <tr>
        <td colspan="9" style="font-size:18px;"><?=$_SESSION['year']?>學年度指定科目考試新北一考區</td>
    </tr>
    <tr>
        <td colspan="9" style="font-size:16px;"><?=$area?><?=$school?>試場工作人員分配表 (<?=$date?>)</td>
    </tr>
    <tr style="background:#FFE4E7">
        <th class="bb">試場</th>
        <th class="bb" colspan="2">考生起訖號碼</th>
        <th class="bb" colspan="2">樓層別</th>
        <th class="bb">監試人員</th>
        <th class="bb">監試人員</th>
        <th class="bb" colspan="2">試務人員</th>
    </tr>
    <?php foreach ($part as $k => $v): ?>
    <tr>
        <td class="bb"><?=trim($v['field'])?></td>
        <td class="bb" colspan="2"><?=trim($v['start']) ?>~<?=trim($v['end']) ?></td>
        <td class="bb" colspan="2"><?=trim($v['floor']) ?></td>
        <td class="bb"><?=trim($v['supervisor_1'])?></td>
        <td class="bb"><?=trim($v['supervisor_2'])?></td>
        <td class="bb" colspan="2"><?=trim($v['allocation_code'])?> <?=trim($v['voucher'])?></td>
    </tr>
    <?php endforeach; ?>
    <tr>
        <td colspan="9" style="text-align:left;">共計：<?=count($trial_count)*2?>人</td>
    </tr>
</table>