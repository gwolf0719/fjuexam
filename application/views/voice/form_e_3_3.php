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
<?php foreach($data_list as $k=>$v):?>
<table class="" id="" style="padding: 15px 0px;text-align:center;">

    <tr>
        <td width="100%" colspan="7" style="font-size:26px;text-align:center;"><?=$_SESSION['year']?>學年度英語聽力測驗<?=$_SESSION['ladder']?>考試新北一考區</td>
    </tr>
    <tr>
        <td width="100%" colspan="7" style="font-size:22px;text-align:left;">測驗日期：10月27日</td>
    </tr>

    <tr>
        <th class="bb" style="background:#FFE4E7">地點</th>
        <th  class="bb" ><?=$v['area_name']?></th>
        <th  class="bb" rowspan="2" style="background:#FFE4E7">起訖座號</th>
        <th  class="bb" rowspan="2" colspan='2'><?=$v['start']?>-<?=$v['end']?></th>
        <th  class="bb" style="background:#FFE4E7">本分區人數</th>
        <th  class="bb" style="background:#FFE4E7">試場數</th>
    </tr>
    <tr>
        <th style="background:#FFE4E7"  class="bb" >起訖試場</th>
        <th  class="bb" ><?=$v['start_field']?>-<?=$v['end_field']?></th>
       
        <td  class="bb" ><?=$v['part_man_count']?></td>
        <th  class="bb" ><?=$v['field_count']?></th>
    </tr>

    <tr style="background:#FFE4E7">
        <th class="bb">試場編號</th>
        <th class="bb" colspan='2'>座位起訖號碼</th>
        <th class="bb">考生人數</th>
        <th class="bb" colspan='3'>試場大樓</th>
    </tr>
    <?php foreach($v['field'] as $k2=>$v2):?>
    <tr>
        <td class="bb"><?=$v2['field']?></td>
        <td class="bb" colspan='2'><?=$v2['start']?> - <?=$v2['end']?></td>
        <td class="bb"><?=$v2['count_num']?></td>
        <td class="bb" colspan='3'><?=$v2['floor']?></td>
    </tr>
    <?php endforeach;?>


    
</table>
<?php endforeach;?>