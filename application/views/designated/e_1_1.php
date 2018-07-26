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
    <h2 style="text-align:center">各單位名稱一覽表</h2>

    <div style="width:50%;float:left;">單位：行政單位</div>
    <div style="width:50%;float:left;">印表日期：
        <?=date('20y-m-d')?>
    </div>
</div>
</div>
<table class="" id="" style="width:510px;padding:10px 4px 10px 4px;text-align:center;">
    <thead>
        <tr style="background:#FFE4E7">
            <th>序號</th>
            <th>部別</th>
            <th>代碼</th>
            <th>單位名稱</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($list as $k => $v): ?>
        <tr>
            <td>
                <?=$k + 1; ?>
            </td>
            <td>
                <?=$v['department']; ?>
            </td>
            <td>
                <?=$v['code']; ?>
            </td>
            <td>
                <?=$v['company_name_02']; ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>