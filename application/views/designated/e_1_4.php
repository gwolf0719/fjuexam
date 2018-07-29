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

<h1 style="text-align:center">
    <?=$_SESSION['year']?>學年度定科目考試新北一考區缺考人數統計表</h1>

<table class="" id="" style="width:510px;padding:10px 4px 10px 4px;text-align:center;">
    <thead>
        <tr>
            <th>日期</th>
            <th colspan="6" class="bb">7月1號</th>
            <th colspan="8" class="bb">7月2號</th>
            <th colspan="6" class="bb">7月3號</th>
        </tr>
        <tr>
            <td>科目</td>
            <td colspan="2">第一節物理</td>
            <td colspan="2">第二節化學</td>
            <td colspan="2">第三節生物</td>
            <td colspan="2">第一節數學乙</td>
            <td colspan="2">第二節國文</td>
            <td colspan="2">第三節英文</td>
            <td colspan="2">第四節數學甲</td>
            <td colspan="2">第一節歷史</td>
            <td colspan="2">第二節地理</td>
            <td colspan="2">第三節公民與社會</td>
        </tr>
        <tr>
            <td>試場</td>
            <td>考生人數</td>
            <td>缺考人數</td>
            <td>考生人數</td>
            <td>缺考人數</td>
            <td>考生人數</td>
            <td>缺考人數</td>
            <td>考生人數</td>
            <td>缺考人數</td>
            <td>考生人數</td>
            <td>缺考人數</td>
            <td>考生人數</td>
            <td>缺考人數</td>
            <td>考生人數</td>
            <td>缺考人數</td>
            <td>考生人數</td>
            <td>缺考人數</td>
            <td>考生人數</td>
            <td>缺考人數</td>
            <td>考生人數</td>
            <td>缺考人數</td>
        </tr>
    </thead>
    <?php foreach ($list as $k => $v): ?>
    <tr>
        <td>
            <?=$v['field']?>
        </td>
        <td>
            <?=$v['subject_01']?>
        </td>
        <td></td>
        <td>
            <?=$v['subject_02']?>
        </td>
        <td></td>
        <td>
            <?=$v['subject_03']?>
        </td>
        <td></td>
        <td>
            <?=$v['subject_04']?>
        </td>
        <td></td>
        <td>
            <?=$v['subject_05']?>
        </td>
        <td></td>
        <td>
            <?=$v['subject_06']?>
        </td>
        <td></td>
        <td>
            <?=$v['subject_07']?>
        </td>
        <td></td>
        <td>
            <?=$v['subject_08']?>
        </td>
        <td></td>
        <td>
            <?=$v['subject_09']?>
        </td>
        <td></td>
        <td>
            <?=$v['subject_10']?>
        </td>
        <td></td>

    </tr>
    <?php endforeach; ?>

</table>