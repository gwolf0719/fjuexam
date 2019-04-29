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

<?php foreach ($data_list as $key => $value) :?>
<?php if(isset($value['end_field'])):?>
<table class="" id="" style="padding: 15px 0px;text-align:center;">

    <tr>
        <td width="100%" colspan="7" style="font-size:30px;text-align:center;"><?=$_SESSION['year']?>學年度英語聽力測驗<?=$_SESSION['ladder']?>考試新北一考區</td>
    </tr>
    <tr>
        <td width="100%" colspan="7" style="font-size:26px;text-align:left;">測驗日期：<?=$date['day']?> ( <?=$block_name?> ) </td>
    </tr>

    <tr>
        <th class="bb" style="background:#FFE4E7;font-size:21px;">地點</th>
        <th  class="bb" ><?=$value['area_name']?></th>
        <th  class="bb" style="font-size:21px;" rowspan="2" style="background:#FFE4E7;font-size:20px;">起訖座號</th>
        <th  class="bb" style="font-size:21px;" rowspan="2" colspan='2'><?=$value['start']?>-<?=$value['end']?></th>
        <th  class="bb" style="background:#FFE4E7;font-size:21px;">本分區人數</th>
        <th  class="bb" style="background:#FFE4E7;font-size:21px;">試場數</th>
    </tr>
    <tr>
        <th style="background:#FFE4E7;font-size:21px;"  class="bb" >起訖試場</th>
        <th  class="bb" style="font-size:21px;"><?=$value['start_field']?>-<?=$value['end_field']?></th>
       
        <td  class="bb" style="font-size:21px;"><?=$value['part_man_count']?></td>
        <th  class="bb" style="font-size:21px;"><?=$value['field_count']?></th>
    </tr>

    <tr style="background:#FFE4E7">
        <th class="bb" style="font-size:21px;">試場編號</th>
        <th class="bb" style="font-size:21px;" colspan='2'>座位起訖號碼</th>
        <th class="bb" style="font-size:21px;">考生人數</th>
        <th class="bb" style="font-size:21px;" colspan='3'>試場大樓</th>
    </tr>

    <?php foreach($value['field'] as $k2=>$v2):?>
    <tr>
        <td class="bb" style="font-size:21px;font-weight:bold;"><?=$v2['field']?></td>
        <td class="bb" style="font-size:21px;" colspan='2'><?=$v2['start']?>  <b style="font-size:20px;"> ~ </b> <?=$v2['end']?></td>
        <td class="bb" style="font-size:21px;"><?=$v2['count_num']?></td>
        <td class="bb" style="font-size:21px;" colspan='3'><?=$v2['floor']?></td>
    </tr>
    <?php endforeach;?>


    
</table>
<?php endif;?>
<?php endforeach;?>