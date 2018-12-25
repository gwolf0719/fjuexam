<style>
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
        font-size:16px;
        padding:5px 0px;
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

<table class="" id="" style="text-align:center;">

    <thead>
        <tr>
            <td colspan="7" style="font-size:26px;"><?=$_SESSION['year']?>學年度英語聽力測驗<?=$_SESSION['ladder']?>考試新北一考區</td>
        </tr>
        <tr>
            <td colspan="7" style="font-size:22px;">身障生試場監試人員印領清冊</td>
        </tr>
        <tr>
            <td colspan="3" style="font-size:18px;padding: 20px 0px; text-align:left;">分區：<?=$area?>(身障)</td>
            <td colspan="3" style="font-size:18px;padding: 20px 0px;">考場：<?=$school['area_name']?></td>
            <td colspan="1" style="font-size:18px;padding: 20px 0px; text-align:right;"> 印表日期：<?=date('Y/m/d')?></td>
        </tr>
        <tr>
            <td rowspan="2" class="bb" style="">試場</td>
            <td  nowrap="nowrap" class="bb">監試人員(1)</td>
            <td rowspan="2" class="bb">監考費</td>
            <td rowspan="2" class="bb" style="width:20%;">簽名或蓋章</td>
            <td nowrap="nowrap"  class="bb">監試人員(2)</td>
            <td rowspan="2" class="bb">監考費</td>
            <td rowspan="2" class="bb" style="width:20%;">簽名或蓋章</td>
        </tr>
        <tr>
            <td class="bb">姓名</td>
            <td class="bb">姓名</td>
        </tr>
    </thead>
    <?php
        $member_count = 0;
        $money_count = 0;
    ?>
    <?php foreach ($part as $k => $v): ?>
        <?php 
        if($v['supervisor_1'] != ""){
            $member_count = $member_count+1;
        }
        if($v['supervisor_2'] != ""){
            $member_count = $member_count+1;
        }
        $money_count = $money_count+$v['first_member_salary_section']+$v['second_member_salary_section']
        ?>
    <tr>
        <td class="bb"  style="width:8%;font-size:18px;font-weight:bold;">
            <?=trim($v['field'])?>
        </td>
        <td class="bb" style="width:8%"><?=trim($v['supervisor_1'])?>
        </td>
        <td class="bb" style="width:8%;font-size:18px;font-weight:bold;" >
            <?=trim(number_format($v['first_member_salary_section']))?>
        </td>
     
        <td class="bb" style="padding: 30px 0px;"></td>
        <td class="bb" style="width:8%"><?=trim($v['supervisor_2'])?>
        </td>
        <td class="bb" style="width:8%;font-size:18px;font-weight:bold;" >
            <?=trim(number_format($v['second_member_salary_section']))?>
        </td>
      
        <td class="bb" style="padding: 30px 0px;"></td>
    </tr>
    <?php endforeach; ?>
    <tr>
        
         <td colspan="11" style="text-align:left;font-size:18px;font-weight:bold">共計:<?=$member_count?>人 實發監考費：<?=number_format($money_count)?> = 總支出費用<?=number_format($money_count)?> </td>
    </tr>
</table>
