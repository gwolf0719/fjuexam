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
    <h2 style="text-align:center">
        <?=$_SESSION['year']?>學年度高中英語能力測驗新北一考區試務人員簽到表</h2>
</div>


<h3 style="text-align:left">分區：
    <?=$area?>
</h3>
<h3 style="text-align:left">考場：板橋高中</h3>
<h3 style="text-align:left">簽到日期：
    <?=date('20y-m-d')?>
</h3>


<table class="" id="" style="width:510px;padding:5px 4px 5px 4px;text-align:center;">
    <thead>
        <tr style="background:#FFE4E7">
            <th>職務</th>
            <th>姓名</th>
            <th>職稱</th>
            <th>單位別</th>
            <th>簽名</th>
            <th>備註(工作分配)</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($part as $k => $v): ?>
        <tr>
            <td>
                <?=$v['job']?>
            </td>
            <td>
                <?=$v['name']; ?>&
                <?=$v['meal']?>
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