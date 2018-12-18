<style>
    .bb {
        border: 1px solid #999999;
    }
    table{
        text-align: center;
        border-spacing: 0px;
        margin: 0 auto;
    }
    td{
        padding: 5px 0px;
    }
    * {
        overflow: visible !important;
    }
    table, tr, td, th, tbody, thead, tfoot {
        page-break-inside: avoid !important;
    }
</style>



<table class="" id="">

    <thead>
        <tr>
            <td colspan="22" style="font-size:26px;"><?=$_SESSION['year']?>學年度高中英語能力測驗新北一考區缺考人數統計表</td>
        </tr>
        <tr>
            <td colspan="22" style="font-size:22px;"><?=$area?><?=$school?></td>
        </tr>
        <tr>
            <td class="bb" colspan="2">日期</td>
            <td class="bb" colspan="6" class="bb">
                <?=mb_substr($datetime_info['day_1'], 5, 8, 'utf-8'); ?>
            </td>
            <td class="bb" colspan="8" class="bb">
                <?=mb_substr($datetime_info['day_2'], 5, 8, 'utf-8'); ?>
            </td>
            <td class="bb" colspan="6" class="bb">
                <?=mb_substr($datetime_info['day_3'], 5, 8, 'utf-8'); ?>
            </td>
        </tr>
        <tr>
            <td class="bb" colspan="2">科目</td>
            <td class="bb" colspan="2">第1節
                <br>物理</td>
            <td class="bb" colspan="2">第2節
                <br>化學</td>
            <td class="bb" colspan="2">第3節
                <br>生物</td>
            <td class="bb" colspan="2">第1節
                <br>數學乙</td>
            <td class="bb" colspan="2">第2節
                <br>國文</td>
            <td class="bb" colspan="2">第3節
                <br>英文</td>
            <td class="bb" colspan="2">第4節
                <br>數學甲</td>
            <td class="bb" colspan="2">第1節
                <br>歷史</td>
            <td class="bb" colspan="2">第2節
                <br>地理</td>
            <td class="bb" colspan="2">第3節
                <br>公民與社會</td>
        </tr>
        <tr>
            <td class="bb" colspan="2">試場</td>
            <td class="bb">考生
                <br>人數</td>
            <td class="bb">缺考
                <br>人數</td>
            <td class="bb">考生
                <br>人數</td>
            <td class="bb">缺考
                <br>人數</td>
            <td class="bb">考生
                <br>人數</td>
            <td class="bb">缺考
                <br>人數</td>
            <td class="bb">考生
                <br>人數</td>
            <td class="bb">缺考
                <br>人數</td>
            <td class="bb">考生
                <br>人數</td>
            <td class="bb">缺考
                <br>人數</td>
            <td class="bb">考生
                <br>人數</td>
            <td class="bb">缺考
                <br>人數</td>
            <td class="bb">考生
                <br>人數</td>
            <td class="bb">缺考
                <br>人數</td>
            <td class="bb">考生
                <br>人數</td>
            <td class="bb">缺考
                <br>人數</td>
            <td class="bb">考生
                <br>人數</td>
            <td class="bb">缺考
                <br>人數</td>
            <td class="bb">考生
                <br>人數</td>
            <td class="bb">缺考
                <br>人數</td>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($list as $k => $v): ?>
    <tr>
        <td class="bb" colspan="2" style="font-size:16px;">
            <?=$v['field']?>
        </td>
        <td class="bb">
            <?=$v['subject_01']?>
        </td>
        <td class="bb"></td>
        <td class="bb">
            <?=$v['subject_02']?>
        </td>
        <td class="bb"></td>
        <td class="bb">
            <?=$v['subject_03']?>
        </td>
        <td class="bb"></td>
        <td class="bb">
            <?=$v['subject_04']?>
        </td>
        <td class="bb"></td>
        <td class="bb">
            <?=$v['subject_05']?>
        </td>
        <td class="bb"></td>
        <td class="bb">
            <?=$v['subject_06']?>
        </td>
        <td class="bb"></td>
        <td class="bb">
            <?=$v['subject_07']?>
        </td>
        <td class="bb"></td>
        <td class="bb">
            <?=$v['subject_08']?>
        </td>
        <td class="bb"></td>
        <td class="bb">
            <?=$v['subject_09']?>
        </td>
        <td class="bb"></td>
        <td class="bb">
            <?=$v['subject_10']?>
        </td>
        <td class="bb"></td>

    </tr>
    <?php endforeach; ?>
    <tr>
        <td class="bb" colspan="2">共計</td>
        <td class="bb"><?=$count['number1']?></td>
        <td class="bb"></td>
        <td class="bb"><?=$count['number2']?></td>
        <td class="bb"></td>
        <td class="bb"><?=$count['number3']?></td>
        <td class="bb"></td>
        <td class="bb"><?=$count['number4']?></td>
        <td class="bb"></td>
        <td class="bb"><?=$count['number5']?></td>
        <td class="bb"></td>
        <td class="bb"><?=$count['number6']?></td>
        <td class="bb"></td>
        <td class="bb"><?=$count['number7']?></td>
        <td class="bb"></td>
        <td class="bb"><?=$count['number8']?></td>
        <td class="bb"></td>
        <td class="bb"><?=$count['number9']?></td>
        <td class="bb"></td>
        <td class="bb"><?=$count['number10']?></td>
        <td class="bb"></td>
    </tr>
    </tbody>

</table>
