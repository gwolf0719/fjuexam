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
        padding: 5px 0px;
        font-size:16px;
        font-family: serif,cursive;
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
            <td colspan="10" style="font-size:26px;"><?=$_SESSION['year']?>學年度指定科目考試新北一考區</td>
        </tr>
        <tr>
            <td colspan="10" style="font-size:22px;padding: 20px 0px;">試務人員印領清冊</td>
        </tr>
        <tr>
            <td colspan="3" style="font-size:22px;text-align:left;padding:20px 0px"> 分區：<?=$area?></td>
            <td colspan="4" style="font-size:22px;text-align:center;padding:20px 0px">考場：<?=$school?></td>
            <td colspan="3" style="font-size:22px;text-align:right;padding:20px 0px"> 印表日期：<?=date('Y/m/d')?></td>
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

    <?php 
        // 計算統計值
        
        $lunch_total = 0;
        $salary = 0;
        
    ?>
    <?php foreach ($part as $k => $v): ?>

    <?php 
        
        $lunch_total = $lunch_total + $v['lunch_total'];
        $salary = $salary + $v['one_day_salary'];
        
    ?>
    <tr>
        <td class="bb"><?=$v['name']?>
        </td>
        <td colspan="2" class="bb"><?=$v['job']?>
        </td>
        <td class="bb" style="font-size:18px;font-weight:bold;"><?=$v['one_day_salary']?>
        </td>
        <td class="bb" style="font-size:18px;font-weight:bold;"><?=$v['lunch_total']?></td>
        <td class="bb" style="font-size:18px;font-weight:bold;"><?=$v['one_day_salary']-$v['lunch_total']?></td>
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
        
        
        <td colspan="12" style="text-align:left;font-size:18px;font-weight:bold;">共計:<?= $count ?>人
            實發監考費：<?= $salary - $lunch_total?> + 餐費： <?= $lunch_total ?> =
            總支出費用：<?= $salary ?></td>
    </tr>
</table>
