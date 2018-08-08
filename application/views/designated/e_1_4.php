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

<table class="" id="" style="width:510px;padding:5px 2px 5px 2px;text-align:center;">
    <thead>
        <tr>
            <th>日期</th>
            <th colspan="6" class="bb" style="font-size:18px">
                <?=mb_substr($datetime_info['day_1'], 5, 8, 'utf-8'); ?>
            </th>
            <th colspan="8" class="bb" style="font-size:18px">
                <?=mb_substr($datetime_info['day_2'], 5, 8, 'utf-8'); ?>
            </th>
            <th colspan="6" class="bb" style="font-size:18px">
                <?=mb_substr($datetime_info['day_3'], 5, 8, 'utf-8'); ?>
            </th>
        </tr>
        <tr>
            <td>科目</td>
            <td colspan="2">第一節
                <br>物理</td>
            <td colspan="2">第二節
                <br>化學</td>
            <td colspan="2">第三節
                <br>生物</td>
            <td colspan="2">第一節
                <br>數學乙</td>
            <td colspan="2">第二節
                <br>國文</td>
            <td colspan="2">第三節
                <br>英文</td>
            <td colspan="2">第四節
                <br>數學甲</td>
            <td colspan="2">第一節
                <br>歷史</td>
            <td colspan="2">第二節
                <br>地理</td>
            <td colspan="2">第三節
                <br>公民與社會</td>
        </tr>
        <tr>
            <td>試場</td>
            <td>考生
                <br>人數</td>
            <td>缺考
                <br>人數</td>
            <td>考生
                <br>人數</td>
            <td>缺考
                <br>人數</td>
            <td>考生
                <br>人數</td>
            <td>缺考
                <br>人數</td>
            <td>考生
                <br>人數</td>
            <td>缺考
                <br>人數</td>
            <td>考生
                <br>人數</td>
            <td>缺考
                <br>人數</td>
            <td>考生
                <br>人數</td>
            <td>缺考
                <br>人數</td>
            <td>考生
                <br>人數</td>
            <td>缺考
                <br>人數</td>
            <td>考生
                <br>人數</td>
            <td>缺考
                <br>人數</td>
            <td>考生
                <br>人數</td>
            <td>缺考
                <br>人數</td>
            <td>考生
                <br>人數</td>
            <td>缺考
                <br>人數</td>
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
<table class="" id="" style="width:510px;padding:5px 2px 5px 2px;text-align:center;">
    <tr>
        <td>共計</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
</table>