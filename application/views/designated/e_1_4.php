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



    <table class="" id="" style="padding:4px;text-align:center;">

        <thead>
        <tr>
            <td colspan="22" style="font-size:16px"><?=$_SESSION['year']?>學年度定科目考試新北一考區缺考人數統計表</td>
        </tr>      
        <tr>
            <td colspan="22" style="font-size:14px;"><?=$area?><?=$school?></td>
        </tr>
        <tr>
            <td colspan="2">日期</td>
            <td colspan="6" class="bb" style="font-size:16px">
                <?=mb_substr($datetime_info['day_1'], 5, 8, 'utf-8'); ?>
            </td>
            <td colspan="8" class="bb" style="font-size:16px">
                <?=mb_substr($datetime_info['day_2'], 5, 8, 'utf-8'); ?>
            </td>
            <td colspan="6" class="bb" style="font-size:16px">
                <?=mb_substr($datetime_info['day_3'], 5, 8, 'utf-8'); ?>
            </td>
        </tr>
        <tr>
            <td colspan="2">科目</td>
            <td colspan="2">第1節
                <br>物理</td>
            <td colspan="2">第2節
                <br>化學</td>
            <td colspan="2">第3節
                <br>生物</td>
            <td colspan="2">第1節
                <br>數學乙</td>
            <td colspan="2">第2節
                <br>國文</td>
            <td colspan="2">第3節
                <br>英文</td>
            <td colspan="2">第4節
                <br>數學甲</td>
            <td colspan="2">第1節
                <br>歷史</td>
            <td colspan="2">第2節
                <br>地理</td>
            <td colspan="2">第3節
                <br>公民與社會</td>
        </tr>
        <tr>
            <td colspan="2">試場</td>
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
    <tbody>
    <?php foreach ($list as $k => $v): ?>
    <tr>
        <td colspan="2">
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
    <tr>
        <td colspan="2">共計</td>
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
    </tbody>
    
</table>