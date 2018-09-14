<style>
    .bb {
        border: 1px solid #999999;
    }
   table{
        text-align: center;
        border-spacing: 0px;
        width:100%;
    }
    td{
        padding: 5px 0px;
        font-size:18px;
    }
    * {
        overflow: visible !important;
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

<table class="" id="" style="padding:4px;text-align:center;">
    <thead>
        <tr>
            <th colspan="10" style="font-size:18px;"><?=$_SESSION['year']?>學年度指定科目考試新北一考區</th>
        </tr>
        <tr>
            <th colspan="10" style="font-size:18px;">管卷人員印領清冊</th>
        </tr>        
        <tr>
            <th colspan="3" style="font-size:18px;text-align:left;"> 分區：<?=$area?></th>
            <th colspan="4" style="font-size:18px;text-align:center;">考場：<?=$school?></th>
            <th colspan="3" style="font-size:18px;text-align:right;"> 印表日期<?=date('Y/m/d')?></th>
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
        <td class="bb"><?=number_format($v['salary_total'])?>
        </td>
        <td class="bb"><?=number_format($v['lunch_total'])?></td>
        <td class="bb"><?=number_format($v['total'])?></td>
        <td colspan="2" style="line-height:20px;" class="bb"></td>
        <td colspan="2" class="bb"></td>
    </tr>
    <?php endforeach; ?>
    <tr>
        <?php 
            if(!empty($count)){
                $count = count($count);
            }else{
                $count = 0;
            }
        ?>    
        <td colspan="12" style="text-align:left;font-size:18px;">共計:<?=$count?>人 實發監考費：<?=number_format($salary)?> - 餐費： <?=number_format($lunch)?> = 總支出費用<?=number_format($salary-$lunch)?></td>
    </tr>
</table>