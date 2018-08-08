<style>

    .bb {
        border: 1px solid #999999;
    }
</style>

<table class="" id="" style="padding:4px;text-align:center;">
    <tr>
        <td colspan="8"><?=$_SESSION['year']?>學年度定科目考試新北一考區</td>
    </tr>
    <tr>
        <td colspan="8">分區：<?=$area?></td>
    </tr>
    <tr style="background:#FFE4E7">
        <th class="bb">試場</th>
        <th class="bb">考試節數</th>
        <th class="bb" colspan="2">考生起訖號碼</th>
        <th class="bb">樓層別</th>
        <th class="bb">監試人員</th>
        <th class="bb">監試人員</th>
        <th class="bb">試務人員</th>
    </tr>
    <?php foreach ($part as $k => $v): ?>
    <tr>
        <td class="bb">
            <?=$v['field']?>
        </td>
        <td class="bb">
            <?=$v['test_section']; ?>
        </td>
        <td class="bb" colspan="2">
            <?=$v['start']; ?>~<?=$v['end']; ?>
        </td>
        <td class="bb">
            <?=$v['floor']; ?>
        </td>
        <td class="bb">
            <?=$v['supervisor_1']?>
        </td>
        <td class="bb">
            <?=$v['supervisor_2']?>
        </td>
        <td class="bb">
            <?=$v['patrol']?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>