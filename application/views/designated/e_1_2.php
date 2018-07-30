<style>
    table {
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

<h1 style="text-align:center">請公假名單</h1>
<h3 style="text-align:right">印表日期：
    <?=date('20y-m-d')?>
</h3>

<table class="" id="" style="width:510px;padding:5px 0px 5px 0px;text-align:center;">
    <thead>
        <tr style="background:#FFE4E7">
            <th width="5%">序號</th>
            <th width="15%">職員代碼</th>
            <th width="15%">姓名</th>
            <th width="15%">單位</th>
            <th width="15%">職稱</th>
            <th width="35%">執勤日期</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($list as $k => $v): ?>
        <tr>
            <td width="5%">
                <?=$k + 1?>
            </td>
            <td width="15%">
                <?=$v['job_code']?>
            </td>
            <td width="15%">
                <?=$v['name']; ?>
            </td>
            <td width="15%">
                <?=$v['member_unit']; ?>
            </td>
            <td width="15%">
                <?=$v['job_title']; ?>
            </td>
            <td width="35%">
                <?=$v['do_date']; ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>