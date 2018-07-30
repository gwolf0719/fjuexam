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
    <div style="width:50%;float:right;">印表日期：
        <?=date('20y-m-d')?>
    </div>
</div>
<table class="" id="" style="width:510px;padding:5px 2px 5px 2px;text-align:center;">
    <thead>
        <tr style="background:#FFE4E7">
            <th width="10%">序號</th>
            <th width="25%">部別</th>
            <th width="25%">代碼</th>
            <th width="45%">單位名稱</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($list as $k => $v): ?>
        <tr>
            <td width="10%">
                <?=$k + 1; ?>
            </td>
            <td width="25%">
                <?=$v['department']; ?>
            </td>
            <td width="25%">
                <?=$v['code']; ?>
            </td>
            <td width="45%">
                <?=$v['company_name_02']; ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>