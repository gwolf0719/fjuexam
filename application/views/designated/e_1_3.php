<style>

    .bb {
        border: 1px solid #999999;
    }
</style>
<table class="" id="" style="padding:5px 0px;text-align:center;">
    <thead>
        <tr>
            <th colspan="9" style="font-size:18px;"><?=$_SESSION['year']?>學年度指定科目考試新北一考區監試人員一覽表</th>
        </tr>
        <tr>
            <th colspan="3" style="font-size:14px;">分區：<?=$area?></th>
            <th colspan="3" style="font-size:14px;"><?=$school?></th>
            <th colspan="3" style="font-size:14px;">印表日期:<?=(date("Y") - 1911).date("/m/d")?></th>
        </tr>        
        <tr>
            <th class="bb" rowspan="2">試場</th>
            <th class="bb" colspan="2" rowspan="1" class="bb">監考日期</th>
            <th class="bb" colspan="3" class="bb">監試人員(1)</th>
            <th class="bb" colspan="3" class="bb">監試人員(2)</th>
        </tr>
        <tr>
            <td class="bb" colspan="2" rowspan="1" >監考節數</td>
            <td class="bb" colspan="1">姓名</td>
            <td class="bb" colspan="2">單位別＆聯絡電話</td>
            <td class="bb" colspan="1">姓名</td>
            <td class="bb" colspan="2">單位別＆聯絡電話</td>
        </tr>
    </thead>
    <?php foreach ($part as $k => $v): ?>
    <tr>
        <td class="bb">
            <?=$v['field']?>
        </td>
        <td class="bb" colspan="2">
            <?=$v['do_date']?><br><?=$v['test_section']?>節
        </td>
        <td class="bb">
            <?=$v['supervisor_1']?>
        </td>
        <td class="bb" colspan="2">
            <?=$v['supervisor_1_unit']?>
            <?=$v['supervisor_1_phone']?>
        </td>
        <td class="bb">
            <?=$v['supervisor_2']?>
        </td>
        <td class="bb" colspan="2">
            <?=$v['supervisor_2_unit']?>
            <?=$v['supervisor_2_phone']?>
        </td>
    </tr>
    <?php endforeach; ?>
    <tr>
        <td colspan="9" style="font-size:14px;text-align:left"> 共計：<?=count($part)*2?>人</td>
    </tr>
</table>