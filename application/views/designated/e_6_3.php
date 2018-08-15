<style>
    .bb{

        border: 1px solid #999999;
        text-align:center;
    }
</style>


<!-- <h3 style="text-align:center;">監試人員印領清冊</h3>

<h3>
   
</h3> -->

<table class="" id="" style="padding:4px;text-align:center;">
    <thead>
        <tr>
            <th colspan="10" style="font-size:18px;"><?=$_SESSION['year']?>學年度指定科目考試新北一考區</th>
        </tr>
        <tr>
            <th colspan="10" style="font-size:16px;">試務人員印領清冊</th>
        </tr>        
        <tr>
            <th colspan="3" style="font-size:12px;text-align:left;"> 分區：<?=$area?></th>
            <th colspan="4" style="font-size:12px;text-align:center;">考場：<?=$school?></th>
            <th colspan="3" style="font-size:12px;text-align:right;"> 印表日期<?=date('Y/m/d')?></th>
        </tr>
        <tr>
            <th class="bb">姓名</th>
            <th colspan="2"class="bb">職務</th>
            <th class="bb">工作費</th>
            <th class="bb">餐費</th>
            <th class="bb">應領費用</th>
            <th colspan="2" class="bb">簽名或蓋章</th>
            <th colspan="2"  class="bb">備註</th>
        </tr>
    </thead>
    <?php foreach ($part as $k => $v): ?>
    <tr>
        <td class="bb"><?=$v['name']?>
        </td>
        <td colspan="2" class="bb"><?=$v['job']?>
        </td>
        <td class="bb"><?=number_format($v['one_day_salary'])?>
        </td>
        <td class="bb"><?=number_format($v['lunch_total'])?></td>
        <td class="bb"><?=number_format($v['total'])?></td>
        <td colspan="2" style="line-height:20px;" class="bb"></td>
        <td colspan="2" class="bb"></td>
    </tr>
    <?php endforeach; ?>
    <tr>
        <td colspan="12" style="text-align:left;font-size:14px;">共計:<?=count($part)?>人</td>
    </tr>
</table>