<style>
    table {
        width: 780px;
        border: 1px solid #999999;
    }

    td {
        border: 1px solid #999999;
    }

    th {
        border: 1px solid #999999;
        text-align: center;
    }
</style>

<h2 style="text-align:center">監試人員一覽表</h2>
<h2>
    <?=$area?>
</h2>

<table class="" id="" style="width:510px;padding:4px 0px 4px 0px;text-align:center;">
    <thead>
        <tr>
            <th rowspan="2">試場</th>
            <th colspan="2" class="bb">監考</th>
            <th colspan="2" class="bb">監試人員(1)</th>
            <th colspan="2" class="bb">監試人員(2)</th>
        </tr>
        <tr>
            <td>監考日期</td>
            <td>監考節數</td>
            <td>姓名</td>
            <td>單位別＆聯絡電話</td>
            <td>姓名</td>
            <td>單位別＆聯絡電話</td>
        </tr>
    </thead>
    <?php foreach ($part as $k => $v): ?>
    <tr>
        <td>
            <?=$v['field']?>
        </td>
        <td>
            <?=$v['do_date']?>
        </td>
        <td>
            <?=$v['test_section']?>
        </td>
        <td>
            <?=$v['supervisor_1']?>
        </td>
        <td>
            <?=$v['supervisor_1_unit']?>
            <?=$v['supervisor_1_phone']?>
        </td>
        <td>
            <?=$v['supervisor_2']?>
        </td>
        <td>
            <?=$v['supervisor_2_unit']?>
            <?=$v['supervisor_2_phone']?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<p>共
    <?=count($part)*2?>人</p>