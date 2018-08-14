<style>
    .bb {
        border: 1px solid #999999;
        vertical-align: middle;
    }
</style>

<table class="" id="" style="padding:4px0 px;text-align:center;">
    <thead>
        <tr>
            <td colspan="7" style="font-size:18px;"><?=$_SESSION['year']?>學年度指定科目考試新北一考區<?=$area?>監試人員午餐一覽表</td>
        </tr>    
        <tr>
            <th class="bb" rowspan="2">試場</th>
            <th class="bb" colspan="3" class="bb">監試委員(1)</th>
            <th class="bb" colspan="3" class="bb">監試委員(2)</th>
        </tr>
        <tr>
            <td class="bb">姓名</td>
            <td class="bb">人員代碼</td>
            <td class="bb">餐別</td>
            <td class="bb">姓名</td>
            <td class="bb">人員代碼</td>
            <td class="bb">餐別</td>
        </tr>
    </thead>
    <?php foreach ($part as $k => $v): ?>
    <tr>
        <td class="bb">
            <?=$v['field']?>
        </td>
        <td class="bb">
            <?=$v['supervisor_1']?>
        </td>
        <td class="bb">
            <?=mb_substr($v['trial_staff_code_1'], 1, 4, 'utf-8'); ?>
        </td>
        <td class="bb">
            <?=$v['order_meal_1']?>
        </td>
        <td class="bb">
            <?=$v['supervisor_2']?>
        </td>
        <td class="bb">
            <?=mb_substr($v['trial_staff_code_2'], 1, 4, 'utf-8'); ?>
        </td>
        <td class="bb">
            <?=$v['order_meal_2']?>
        </td>
    </tr>
    <?php endforeach; ?>
    <tr>
        <td colspan="7" style="text-align:left;font-size:16px;">共計：<?=count($part)*2?>人</td>
    </tr>
</table>