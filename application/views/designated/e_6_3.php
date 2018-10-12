<style>
    @font-face{
        font-family: serif,cursive;
    }
    .bb {
        border: 1px solid #999999;
    }
   table{
        text-align: center;
        border-spacing: 0px;
        width:100%;
        font-family: serif,cursive;
    }
    td{
        padding: 15px 0px;
        font-size:14px;
        font-family: serif,cursive;
    }
    th{
        padding: 15px 0px;
        font-size:14px;
    }    
    * {
        overflow: visible !important;
        font-family: serif;
    }
    table, tr, td, th, tbody, thead, tfoot {
        page-break-inside: avoid !important;
    }    
    .W50{
        width:50%;
        float:left;
    }    
</style>


<!-- <h3 style="text-align:center;">監試人員印領清冊</h3>

<h3>
   
</h3> -->

<table class="" id="" style="padding:15px;text-align:center;">
    <thead>
        <tr>
            <td colspan="10" style="font-size:22px;"><?=$_SESSION['year']?>學年度指定科目考試新北一考區</td>
        </tr>
        <tr>
            <td colspan="3" style="font-size:18px;text-align:left;"> </td>
            <td colspan="4" style="font-size:18px;">試務人員印領清冊</td>
            <td colspan="3" style="font-size:18px;text-align:left;"> </td>
        </tr>        
        <tr>
            <td colspan="3" style="font-size:18px;text-align:left;"> 分區：<?=$area?></td>
            <td colspan="4" style="font-size:18px;text-align:center;">考場：<?=$school?></td>
            <td colspan="3" style="font-size:18px;text-align:right;"> 印表日期<?=date('Y/m/d')?></td>
        </tr>
        <tr>
            <td class="bb">姓名</td>
            <td colspan="2"class="bb">職務</td>
            <td class="bb">工作費</td>
            <td class="bb">餐費</td>
            <td class="bb">實領費用</td>
            <td colspan="2" class="bb">簽名或蓋章</td>
            <td colspan="2"  class="bb">備註</th>
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
        <td colspan="2" class="bb"></td>
        <td colspan="2" class="bb"></td>
    </tr>
    <?php endforeach; ?>
    <tr>
        <?php 
            if(!empty($part)){
                $count = count($part);
            }else{
                $count = 0;
            }
        ?>
        <td colspan="12" style="text-align:left;font-size:14px;">共計:<?=$count?>人 實發監考費：<?=number_format($salary)?> + 餐費： <?=number_format($lunch)?> = 總支出費用<?=number_format($salary+$lunch)?> </td>
    </tr>
</table>