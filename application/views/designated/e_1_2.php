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

<div>
    <h2 style="text-align:center">請公假名單</h2>
</div>
</div>
<table class="" id="" style="width:510px;padding:10px 4px 10px 4px;text-align:center;">
    <thead>
        <tr style="background:#FFE4E7">
            <th>職員代碼</th>
            <th>姓名</th>
            <th>單位</th>
            <th>職稱</th>
            <th>執勤日期</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($list as $k => $v): ?>
        <tr>
            <td>
                <?=$v['job_code']?>
            </td>
            <td>
                <?=$v['name']; ?>
            </td>
            <td>
                <?=$v['member_unit']; ?>
            </td>
            <td>
                <?=$v['job_title']; ?>
            </td>
            <td>
                <?=$v['do_date']; ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>