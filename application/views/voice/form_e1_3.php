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
        padding: 15px 0px;
        font-size:16px;
    }
    th{
        padding: 15px 0px;
        font-size:16px;
    }
    * {
        overflow: visible !important;
    }
    table, tr, td, th, tbody, thead, tfoot {
        page-break-before: always;
        page-break-inside: avoid;
    }
    .W50{
        width:50%;
        float:left;
    }
</style>
<table class="" id="" style="padding:5px 0px;text-align:center;">
    <thead>
        <tr>
            <td colspan="9" style="font-size:26px;"><?=$_SESSION['year']?>學年度英語聽力測驗<?=$_SESSION['ladder']?>考試新北一考區監試人員一覽表</td>
        </tr>
        <tr>
            <td colspan="1" style="font-size:20px;padding:20px 0px;">分區：<?=$area?></td>
            <td colspan="3" style="font-size:20px;padding:20px 0px;">考場：<?=$school['area_name']?></td>
            <td colspan="3" style="font-size:20px;padding:20px 0px;">印表日期：<?=(date("Y") - 1911).date("/m/d")?></td>
        </tr>
        <tr>
            <td class="bb" rowspan="2">試場</td>
            <!-- <td class="bb" colspan="2" rowspan="1" class="bb"> </td> -->
            <td class="bb" colspan="3" class="bb">監試人員(1)</td>
            <td class="bb" colspan="3" class="bb">監試人員(2)</td>
        </tr>
        <tr>
            <!-- <td class="bb" colspan="2" rowspan="1" >監考節數</td> -->
            <td class="bb" colspan="1" width="10%">姓名</td>
            <td class="bb" colspan="2" width="20%">單位別＆聯絡電話</td>
            <td class="bb" colspan="1" width="10%">姓名</td>
            <td class="bb" colspan="2" width="20%">單位別＆聯絡電話</td>
        </tr>
    </thead>
    <?php  $count=0;?>
    <?php foreach ($part as $k => $v): ?>
    <?php 
        if($v['trial_staff_code_1']!=''){
            $count=$count+1;
        }

    ?>
    <tr>
        <td class="bb">
            <?=$v['field']?>
        </td>
        <!-- <td class="bb" colspan="2" nowrap="nowrap">
            <?=$v['do_date']?><br><?=$v['class']?>節
        </td> -->
        <td class="bb">
            <?=$v['supervisor_1']?></br>
            <?=$v['trial_staff_code_1']?>
        </td>
        <td class="bb" colspan="2" nowrap="nowrap">
            <?=$v['supervisor_1_unit']?><br>
            <?=$v['supervisor_1_phone']?>
        </td>
        <td class="bb">
            <?=$v['supervisor_2']?></br>
            <?=$v['trial_staff_code_2']?>
        </td>
        <td class="bb" colspan="2" nowrap="nowrap">
            <?=$v['supervisor_2_unit']?><br>
            <?=$v['supervisor_2_phone']?>
        </td>
    </tr>
    <?php endforeach; ?>
    <tr>
        <td colspan="9" style="font-size:16px;text-align:left"> 共計：<?=$count*2?>人</td>
    </tr>
</table>
