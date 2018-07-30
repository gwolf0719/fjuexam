<style>
    table {
        width: 780px;
        border: 1px solid #999999;
    }

    td {
        border: 1px solid #999999;
        vertical-align: middle;
    }

    th {
        border: 1px solid #999999;
        text-align: center;
    }
</style>

<h2 style="text-align:center">各分區午餐名單</h2>

<h2>
    <?=$area?>
</h2>

<table class="" id="" style="width:510px;padding:10px 4px 10px 4px;text-align:center;">
    <thead>
        <tr>
            <th>試場</th>
            <th colspan="3" class="bb">監試委員(1)</th>
            <th colspan="3" class="bb">監試委員(2)</th>
        </tr>
        <tr>
            <td></td>
            <td>姓名</td>
            <td>識別號</td>
            <td>餐別</td>
            <td>姓名</td>
            <td>識別號</td>
            <td>餐別</td>
        </tr>
    </thead>
    <?php foreach ($part as $k => $v): ?>
    <tr>
        <td>
            <?=$v['field']?>
        </td>
        <td>
            <?=$v['supervisor_1']?>
        </td>
        <td>
            <?=$v['supervisor_1_code']?>
        </td>
        <td>
            <?=$v['order_meal_1']?>
        </td>
        <td>
            <?=$v['supervisor_2']?>
        </td>
        <td>
            <?=$v['supervisor_2_code']?>
        </td>
        <td>
            <?=$v['order_meal_2']?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>