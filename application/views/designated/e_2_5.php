<style>
    table {
        width: 780px;
        border: 1px solid #999999;
        margin: 30px auto;
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
    <h2 style="text-align:center">開會通知簽收表</h2>
</div>


<h3 style="text-align:left">分區：
    <?=$area?>
</h3>
<h3 style="text-align:left">考場：板橋高中</h3>
<h3 style="text-align:left">簽到日期：
    <?=date('20y-m-d')?>
</h3>


<table class="" id="" style="width:510px;padding:10px 4px 10px 4px;text-align:center;">
    <thead>
        <tr style="background:#FFE4E7">
            <th>編號</th>
            <th>職務</th>
            <th>姓名</th>
            <th>職稱</th>
            <th>單位別</th>
            <th>簽名</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($part as $k => $v): ?>
        <tr>
            <td>
                <?=$v['job_code']?>
            </td>
            <td>
                <?=$v['job']?>
            </td>
            <td>
                <?=$v['name']; ?>
            </td>
            <td>
                <?=$v['job_title']; ?>
            </td>
            <td>
                <?=$v['member_unit']; ?>
            </td>
            <td></td>
            <td></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>