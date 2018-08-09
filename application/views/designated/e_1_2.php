<style>

    .bb {
        border: 1px solid #999999;
    }

</style>


<table class="" id="" style="width:510px;padding:5px 0px 5px 0px;text-align:center;">
    <thead>
        <tr>
            <td colspan="5" style="font-size:18px;">請公假名單</td>
        </tr>
        <tr>
            <td colspan="5" style="text-align:right;font-size:14px;">印表日期：<?=(date("Y") - 1911).date("/m/d")?></td>
        </tr>
        <tr style="background:#FFE4E7">
            <th class="bb" width="5%">序號</th>
            <th class="bb" width="15%">職員代碼</th>
            <th class="bb" width="15%">姓名</th>
            <th class="bb" width="15%">單位</th>
            <th class="bb" width="15%">職稱</th>
            <th class="bb" width="35%">執勤日期</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($list as $k => $v): ?>
        <tr>
            <td class="bb" width="5%">
                <?=$k + 1?>
            </td>
            <td class="bb" width="15%">
                <?=$v['job_code']?>
            </td>
            <td class="bb" width="15%">
                <?=$v['name']; ?>
            </td>
            <td class="bb" width="15%">
                <?=$v['member_unit']; ?>
            </td>
            <td class="bb" width="15%">
                <?=$v['job_title']; ?>
            </td>
            <td class="bb" width="35%">
                <?=$v['do_date']; ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>